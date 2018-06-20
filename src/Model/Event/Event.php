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
     * @var int|null Event ID
     */
    protected $id;

    /**
     * @var Player|null Player
     */
    protected $player;

    /**
     * @var string Match time (example: 90`+2` or 4`)
     */
    protected $matchTime;


    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Player|null
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @param Player|null $player
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