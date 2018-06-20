<?php
/**
 * User: jantaodev
 * Date: 18.06.18
 * Time: 13:59
 */

namespace JantaoDev\FifaApi;

use GuzzleHttp\Client;
use JantaoDev\FifaApi\Model\Competition;
use JantaoDev\FifaApi\Model\Event\Booking;
use JantaoDev\FifaApi\Model\Event\Event;
use JantaoDev\FifaApi\Model\Event\Goal;
use JantaoDev\FifaApi\Model\Event\Substitution;
use JantaoDev\FifaApi\Model\Match;
use JantaoDev\FifaApi\Model\MatchSchedule;
use JantaoDev\FifaApi\Model\Player;
use JantaoDev\FifaApi\Model\Team;

/**
 * API implementation class
 */
class FifaApi
{

    protected $baseApiUrl = 'https://api.fifa.com/api/v1/';

    protected $client;
    protected $competitionId;
    protected $seasonId;
    protected $language;

    /**
     * FifaApi constructor.
     * @param int $competitionId Competition ID
     * @param int $seasonId Season ID
     * @param string $language Language for localized strings (or 'all')
     * @param Client|null $client Http client
     */
    public function __construct($competitionId, $seasonId, $language = 'all', Client $client = null)
    {
        if ($client) {
            $this->client = $client;
        } else {
            $this->client = new Client();
        }
        $this->competitionId = $competitionId;
        $this->seasonId = $seasonId;
        $this->language = $language;
    }

    /**
     * @param string $url Requested URL
     * @return \stdClass|null Response object
     */
    protected function request($url)
    {
        $response = $this->client->get($url);
        if ($response->getStatusCode() !== 200) {
            return null;
        }
        return json_decode($response->getBody());
    }

    /**
     * @param mixed $locStr Localized string
     * @return array|string|null Output string or array
     */
    protected function extractLocalizedString($locStr)
    {
        $result = null;
        if (is_array($locStr)) {
            if (count($locStr) == 1) {
                $locStrItem = reset($locStr);
                $result = $locStrItem->Description;
            } elseif (count($locStr) > 1) {
                $result = [];
                foreach ($locStr as $locStrItem) {
                    $result[$locStrItem->Locale] = $locStrItem->Description;
                }
            }
        }
        return $result;
    }

    /**
     * Get competition info
     * @return Competition Competition info
     */
    public function getCompetition()
    {
        $competitionInfo = $this->request("{$this->baseApiUrl}competitions/{$this->competitionId}?language={$this->language}");
        $seasonInfo = $this->request("{$this->baseApiUrl}seasons/{$this->competitionId}/{$this->seasonId}?language={$this->language}");
        $competition = new Competition();
        $competition
            ->setId($this->competitionId)
            ->setName($this->extractLocalizedString($competitionInfo->Name))
            ->setSeasonId($this->seasonId)
            ->setSeasonName($this->extractLocalizedString($seasonInfo->Name))
            ;
        return $competition;
    }

    /**
     * @param \stdClass|null $teamInfo Response team info
     * @return Team|null Team object
     */
    protected function extractTeam(\stdClass $teamInfo = null)
    {
        if (!$teamInfo) {
            return null;
        }
        $team = new Team();
        $team
            ->setId(intval($teamInfo->IdTeam))
            ->setName($this->extractLocalizedString($teamInfo->TeamName))
            ->setCountryCode($teamInfo->IdCountry)
            ;
        return $team;
    }

    /**
     * @param \stdClass $matchInfo Match schedule info
     * @return MatchSchedule Match schedule object
     */
    protected function extractMatchSchedule(\stdClass $matchInfo)
    {
        $matchSchedule = new MatchSchedule();
        $matchSchedule
            ->setId(intval($matchInfo->IdMatch))
            ->setSeasonId(intval($matchInfo->IdSeason))
            ->setStageId(intval($matchInfo->IdStage))
            ->setCompetitionId(intval($matchInfo->IdCompetition))
            ->setAwayTeam($this->extractTeam($matchInfo->Away))
            ->setAwayTeamScore(intval($matchInfo->AwayTeamScore))
            ->setHomeTeam($this->extractTeam($matchInfo->Home))
            ->setHomeTeamScore(intval($matchInfo->HomeTeamScore))
            ->setDate(new \DateTime($matchInfo->Date))
            ->setLocalDate(new \DateTime($matchInfo->LocalDate))
            ->setStadium($this->extractLocalizedString($matchInfo->Stadium->Name))
            ->setStatus(intval($matchInfo->MatchStatus))
            ;
        return $matchSchedule;
    }

    /**
     * Get matches schedule
     * @return array|null Match schedule array
     */
    public function getSchedule()
    {
        $result = [];
        $scheduleInfo = $this->request("{$this->baseApiUrl}calendar/matches?idCompetition={$this->competitionId}&idSeason={$this->seasonId}&count=500&language={$this->language}");
        if (!$scheduleInfo || !isset($scheduleInfo->Results) || !is_array($scheduleInfo->Results)) {
            return null;
        }
        foreach ($scheduleInfo->Results as $scheduleInfoItem) {
            $result[] = $this->extractMatchSchedule($scheduleInfoItem);
        }
        return $result;
    }

    /**
     * @param \stdClass $playerInfo Player info
     * @param Team $team Player team object
     * @return Player Player object
     */
    protected function extractPlayer(\stdClass $playerInfo, Team $team)
    {
        $player = new Player();
        $player
            ->setName($this->extractLocalizedString($playerInfo->PlayerName))
            ->setId(intval($playerInfo->IdPlayer))
            ->setShirtNumber(intval($playerInfo->ShirtNumber))
            ->setTeam($team)
            ;
        return $player;
    }

    /**
     * @param \stdClass $bookingInfo Booking info
     * @param array $players All players objects (key is id)
     * @return Booking Booking event object
     */
    protected function extractBookingEvent(\stdClass $bookingInfo, array $players)
    {
        $booking = new Booking();
        $booking
            ->setId($bookingInfo->IdEvent)
            ->setMatchTime($bookingInfo->Minute)
            ->setCard(intval($bookingInfo->Card))
            ->setPlayer($players[intval($bookingInfo->IdPlayer)] ?? null)
            ;
        return $booking;
    }

    /**
     * @param \stdClass $substitutionInfo Substitution info
     * @param array $players All players objects (key is id)
     * @return Substitution Substitution event object
     */
    protected function extractSubstitutionEvent(\stdClass $substitutionInfo, array $players)
    {
        $substitution = new Substitution();
        $substitution
            ->setId($substitutionInfo->IdEvent)
            ->setMatchTime($substitutionInfo->Minute)
            ->setPlayer($players[intval($substitutionInfo->IdPlayerOn)] ?? null)
            ->setPlayerOff($players[intval($substitutionInfo->IdPlayerOff)] ?? null)
            ->setReason(intval($substitutionInfo->Reason))
        ;
        return $substitution;
    }

    /**
     * @param \stdClass $goalInfo Goal info
     * @param array $players All players objects (key is id)
     * @return Goal Goal event object
     */
    protected function extractGoalEvent(\stdClass $goalInfo, array $players)
    {
        $goal = new Goal();
        $goal
            ->setId($goalInfo->IdGoal)
            ->setMatchTime($goalInfo->Minute)
            ->setPlayer($players[intval($goalInfo->IdPlayer)] ?? null)
            ->setGoal(intval($goalInfo->Type))
        ;
        return $goal;
    }

    /**
     * @param array $events Events array
     */
    protected function sortEvents(array &$events)
    {
        uasort($events, function (Event $a, Event $b) {
            $aa = array_map('intval', explode('+', preg_replace('[^0-9\+]', '', $a->getMatchTime())));
            $bb = array_map('intval', explode('+', preg_replace('[^0-9\+]', '', $b->getMatchTime())));
            if ($aa[0] == $bb[0]) {
                $aa[1] = $aa[1] ?? 0;
                $bb[1] = $bb[1] ?? 0;
                if ($aa[1] == $bb[1]) {
                    return 0;
                }
                return ($aa[1] < $bb[1] ? -1 : 1);
            }
            return ($aa[0] < $bb[0] ? -1 : 1);
        });
    }

    /**
     * @param \stdClass $matchInfo Match info
     * @return Match Match object
     */
    protected function extractMatch(\stdClass $matchInfo)
    {
        $match = new Match();

        $homeTeam = $this->extractTeam($matchInfo->HomeTeam);
        $awayTeam = $this->extractTeam($matchInfo->AwayTeam);

        $players = [];
        foreach ($matchInfo->HomeTeam->Players as $playerInfo) {
            $player = $this->extractPlayer($playerInfo, $homeTeam);
            $players[$player->getId()] = $player;
        }
        foreach ($matchInfo->AwayTeam->Players as $playerInfo) {
            $player = $this->extractPlayer($playerInfo, $awayTeam);
            $players[$player->getId()] = $player;
        }

        $events = [];
        foreach (array_merge($matchInfo->HomeTeam->Bookings, $matchInfo->AwayTeam->Bookings) as $bookingInfo) {
            $events[] = $this->extractBookingEvent($bookingInfo, $players);
        }
        foreach (array_merge($matchInfo->HomeTeam->Substitutions, $matchInfo->AwayTeam->Substitutions) as $substitutionInfo) {
            $events[] = $this->extractSubstitutionEvent($substitutionInfo, $players);
        }
        foreach (array_merge($matchInfo->HomeTeam->Goals, $matchInfo->AwayTeam->Goals) as $goalInfo) {
            $events[] = $this->extractGoalEvent($goalInfo, $players);
        }
        $this->sortEvents($events);

        $match
            ->setId(intval($matchInfo->IdMatch))
            ->setSeasonId(intval($matchInfo->IdSeason))
            ->setStageId(intval($matchInfo->IdStage))
            ->setCompetitionId(intval($matchInfo->IdCompetition))
            ->setAwayTeam($awayTeam)
            ->setAwayTeamScore(intval($matchInfo->AggregateAwayTeamScore))
            ->setHomeTeam($homeTeam)
            ->setHomeTeamScore(intval($matchInfo->AggregateHomeTeamScore))
            ->setDate(new \DateTime($matchInfo->Date))
            ->setLocalDate(new \DateTime($matchInfo->LocalDate))
            ->setStadium($this->extractLocalizedString($matchInfo->Stadium->Name))
            ->setStatus(intval($matchInfo->MatchStatus))
            ->setEvents($events)
            ->setMatchTime($matchInfo->MatchTime)
            ->setPeriod(intval($matchInfo->Period))
            ->setPlayers($players)
        ;
        return $match;
    }

    /**
     * Get match by match schedule
     * @param MatchSchedule $matchSchedule Match schedule object
     * @return Match Match object
     */
    public function getMatch(MatchSchedule $matchSchedule)
    {
        $matchInfo = $this->request("{$this->baseApiUrl}live/football/{$matchSchedule->getCompetitionId()}/{$matchSchedule->getSeasonId()}/{$matchSchedule->getStageId()}/{$matchSchedule->getId()}?language={$this->language}");
        return $this->extractMatch($matchInfo);
    }

    /**
     * Update match object
     * @param Match $match Match object
     * @return array New events
     */
    public function updateMatch(Match $match)
    {
        $matchInfo = $this->request("{$this->baseApiUrl}live/football/{$match->getCompetitionId()}/{$match->getSeasonId()}/{$match->getStageId()}/{$match->getId()}?language={$this->language}");

        $eventHashes = [];
        foreach ($match->getEvents() as $event) {
            /* @var Event $event */
            $eventHashes[] = get_class($event).$event->getId().($event->getPlayer() ? $event->getPlayer()->getId() : null).$event->getMatchTime();
        }

        $newEvents = [];
        foreach (array_merge($matchInfo->HomeTeam->Bookings, $matchInfo->AwayTeam->Bookings) as $bookingInfo) {
            $hash = "JantaoDev\\FifaApi\\Model\\Event\\Booking{$bookingInfo->IdEvent}{$bookingInfo->IdPlayer}{$bookingInfo->Minute}";
            if (in_array($hash, $eventHashes)) {
                continue;
            }
            $newEvents[] = $this->extractBookingEvent($bookingInfo, $match->getPlayers());
        }
        foreach (array_merge($matchInfo->HomeTeam->Substitutions, $matchInfo->AwayTeam->Substitutions) as $substitutionInfo) {
            $hash = "JantaoDev\\FifaApi\\Model\\Event\\Substitution{$substitutionInfo->IdEvent}{$substitutionInfo->IdPlayerOn}{$substitutionInfo->Minute}";
            if (in_array($hash, $eventHashes)) {
                continue;
            }
            $newEvents[] = $this->extractSubstitutionEvent($substitutionInfo, $match->getPlayers());
        }
        foreach (array_merge($matchInfo->HomeTeam->Goals, $matchInfo->AwayTeam->Goals) as $goalInfo) {
            $hash = "JantaoDev\\FifaApi\\Model\\Event\\Goal{$goalInfo->IdGoal}{$goalInfo->IdPlayer}{$goalInfo->Minute}";
            if (in_array($hash, $eventHashes)) {
                continue;
            }
            $newEvents[] = $this->extractGoalEvent($goalInfo, $match->getPlayers());
        }
        $this->sortEvents($newEvents);

        $events = array_merge($match->getEvents(), $newEvents);
        $this->sortEvents($events);

        $match
            ->setAwayTeamScore(intval($matchInfo->AggregateAwayTeamScore))
            ->setHomeTeamScore(intval($matchInfo->AggregateHomeTeamScore))
            ->setStatus(intval($matchInfo->MatchStatus))
            ->setEvents($events)
            ->setMatchTime($matchInfo->MatchTime)
            ->setPeriod(intval($matchInfo->Period))
        ;
        return $newEvents;
    }

}
