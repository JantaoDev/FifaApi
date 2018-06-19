<?php
/**
 * User: jantaodev
 * Date: 18.06.18
 * Time: 13:58
 */

namespace JantaoDev\FifaApi\Model\Event;

use JantaoDev\FifaApi\Model\Player;

/**
 * Base event class
 */
abstract class Event
{

    /**
     * @var int Event ID
     */
    protected $id;

    /**
     * @var Player Player
     */
    protected $player;

    /**
     * @var string Match time (example: 90`+2` or 4`)
     */
    protected $matchTime;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Player
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @param Player $player
     * @return $this
     */
    public function setPlayer($player)
    {
        $this->player = $player;
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
     * @return $this
     */
    public function setMatchTime($matchTime)
    {
        $this->matchTime = $matchTime;
        return $this;
    }

}