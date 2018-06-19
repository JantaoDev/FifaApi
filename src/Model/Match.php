<?php
/**
 * User: jantaodev
 * Date: 18.06.18
 * Time: 13:57
 */

namespace JantaoDev\FifaApi\Model;

/**
 * Match class
 * @package JantaoDev\FifaApi\Model
 */
class Match
{

    const STATUS_PLAYED = 0;
    const STATUS_FUTURE = 1;
    const STATUS_LIVE = 3;
    const STATUS_LINE_UPS = 12;
    const STATUS_ABANDONED = 4;
    const STATUS_POSTPONED = 7;
    const STATUS_CANCELLED = 8;
    const STATUS_SUSPENDED = 99;

    const PERIOD_UNKNOWN = 0;
    const PERIOD_SCHEDULED = 1;
    const PERIOD_PRE_MATCH = 2;
    const PERIOD_FIRST_HALF = 3;
    const PERIOD_HALF_TIME = 4;
    const PERIOD_SECOND_HALF = 5;
    const PERIOD_EXTRA_TIME = 6;
    const PERIOD_EXTRA_FIRST_HALF = 7;
    const PERIOD_EXTRA_HALF_TIME = 8;
    const PERIOD_EXTRA_SECOND_HALF = 9;
    const PERIOD_FULL_TIME = 10;
    const PERIOD_PENALTY_SHOOTOUT = 11;
    const PERIOD_POST_MATCH = 12;
    const PERIOD_ABANDONED = 13;

    /**
     * @var int Competititon ID
     */
    protected $competitionId;

    /**
     * @var int Season ID
     */
    protected $seasonId;

    /**
     * @var int Stage ID
     */
    protected $stageId;

    /**
     * @var int Match ID
     */
    protected $id;

    /**
     * @var \DateTime Match date
     */
    protected $date;

    /**
     * @var \DateTime Match date (locally)
     */
    protected $localDate;

    /**
     * @var string|array Stadium name
     */
    protected $stadium;

    /**
     * @var Team Home team
     */
    protected $homeTeam;

    /**
     * @var Team Away team
     */
    protected $awayTeam;

    /**
     * @var int Match status
     */
    protected $status;

    /**
     * @var int Home team score
     */
    protected $homeTeamScore;

    /**
     * @var int Away team score
     */
    protected $awayTeamScore;

    /**
     * @var array Players
     */
    protected $players;

    /**
     * @var array Events
     */
    protected $events;

    /**
     * @var int Current match period
     */
    protected $period;

    /**
     * @var string Current match time
     */
    protected $matchTime;


    /**
     * @return int
     */
    public function getCompetitionId()
    {
        return $this->competitionId;
    }

    /**
     * @param int $competitionId
     * @return Match
     */
    public function setCompetitionId($competitionId)
    {
        $this->competitionId = $competitionId;
        return $this;
    }

    /**
     * @return int
     */
    public function getSeasonId()
    {
        return $this->seasonId;
    }

    /**
     * @param int $seasonId
     * @return Match
     */
    public function setSeasonId($seasonId)
    {
        $this->seasonId = $seasonId;
        return $this;
    }

    /**
     * @return int
     */
    public function getStageId()
    {
        return $this->stageId;
    }

    /**
     * @param int $stageId
     * @return Match
     */
    public function setStageId($stageId)
    {
        $this->stageId = $stageId;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Match
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return Match
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLocalDate()
    {
        return $this->localDate;
    }

    /**
     * @param \DateTime $localDate
     * @return Match
     */
    public function setLocalDate($localDate)
    {
        $this->localDate = $localDate;
        return $this;
    }

    /**
     * @return array|string
     */
    public function getStadium()
    {
        return $this->stadium;
    }

    /**
     * @param array|string $stadium
     * @return Match
     */
    public function setStadium($stadium)
    {
        $this->stadium = $stadium;
        return $this;
    }

    /**
     * @return Team
     */
    public function getHomeTeam()
    {
        return $this->homeTeam;
    }

    /**
     * @param Team $homeTeam
     * @return Match
     */
    public function setHomeTeam($homeTeam)
    {
        $this->homeTeam = $homeTeam;
        return $this;
    }

    /**
     * @return Team
     */
    public function getAwayTeam()
    {
        return $this->awayTeam;
    }

    /**
     * @param Team $awayTeam
     * @return Match
     */
    public function setAwayTeam($awayTeam)
    {
        $this->awayTeam = $awayTeam;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return Match
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return int
     */
    public function getHomeTeamScore()
    {
        return $this->homeTeamScore;
    }

    /**
     * @param int $homeTeamScore
     * @return Match
     */
    public function setHomeTeamScore($homeTeamScore)
    {
        $this->homeTeamScore = $homeTeamScore;
        return $this;
    }

    /**
     * @return int
     */
    public function getAwayTeamScore()
    {
        return $this->awayTeamScore;
    }

    /**
     * @param int $awayTeamScore
     * @return Match
     */
    public function setAwayTeamScore($awayTeamScore)
    {
        $this->awayTeamScore = $awayTeamScore;
        return $this;
    }

    /**
     * @return array
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * @param array $players
     * @return Match
     */
    public function setPlayers($players)
    {
        $this->players = $players;
        return $this;
    }

    /**
     * @return array
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param array $events
     * @return Match
     */
    public function setEvents($events)
    {
        $this->events = $events;
        return $this;
    }

    /**
     * @return int
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @param int $period
     * @return Match
     */
    public function setPeriod($period)
    {
        $this->period = $period;
        return $this;
    }

    /**
     * @return string
     */
    public function getMatchTime()
    {
        return $this->matchTime;
    }

    /**
     * @param string $matchTime
     * @return Match
     */
    public function setMatchTime($matchTime)
    {
        $this->matchTime = $matchTime;
        return $this;
    }

}