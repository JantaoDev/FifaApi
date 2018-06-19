<?php
/**
 * User: jantaodev
 * Date: 18.06.18
 * Time: 15:09
 */

namespace JantaoDev\FifaApi\Model;

/**
 * Match schedule class
 */
class MatchSchedule
{

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
     * @return int
     */
    public function getCompetitionId()
    {
        return $this->competitionId;
    }

    /**
     * @param int $competitionId
     * @return MatchSchedule
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
     * @return MatchSchedule
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
     * @return MatchSchedule
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
     * @return MatchSchedule
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
     * @return MatchSchedule
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
     * @return MatchSchedule
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
     * @return MatchSchedule
     */
    public function setStadium($stadium)
    {
        $this->stadium = $stadium;
        return $this;
    }

    /**
     * @return \JantaoDev\FifaApi\Model\Team
     */
    public function getHomeTeam()
    {
        return $this->homeTeam;
    }

    /**
     * @param \JantaoDev\FifaApi\Model\Team $homeTeam
     * @return MatchSchedule
     */
    public function setHomeTeam($homeTeam)
    {
        $this->homeTeam = $homeTeam;
        return $this;
    }

    /**
     * @return \JantaoDev\FifaApi\Model\Team
     */
    public function getAwayTeam()
    {
        return $this->awayTeam;
    }

    /**
     * @param \JantaoDev\FifaApi\Model\Team $awayTeam
     * @return MatchSchedule
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
     * @return MatchSchedule
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
     * @return MatchSchedule
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
     * @return MatchSchedule
     */
    public function setAwayTeamScore($awayTeamScore)
    {
        $this->awayTeamScore = $awayTeamScore;
        return $this;
    }

}