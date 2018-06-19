<?php
/**
 * User: jantaodev
 * Date: 18.06.18
 * Time: 13:58
 */

namespace JantaoDev\FifaApi\Model\Event;


use JantaoDev\FifaApi\Model\Player;

/**
 * Substitution event class
 */
class Substitution extends Event
{

    const REASON_UNKNOWN = 0;
    const REASON_INJURY = 1;
    const REASON_TACTICAL = 2;

    /**
     * @var Player Player off
     */
    protected $playerOff;

    /**
     * @var int Reason
     */
    protected $reason;


    /**
     * @return Player
     */
    public function getPlayerOff()
    {
        return $this->playerOff;
    }

    /**
     * @param Player $playerOff
     * @return Substitution
     */
    public function setPlayerOff($playerOff)
    {
        $this->playerOff = $playerOff;
        return $this;
    }

    /**
     * @return int
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @param int $reason
     * @return Substitution
     */
    public function setReason($reason)
    {
        $this->reason = $reason;
        return $this;
    }

}