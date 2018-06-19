<?php
/**
 * User: jantaodev
 * Date: 18.06.18
 * Time: 13:58
 */

namespace JantaoDev\FifaApi\Model\Event;

/**
 * Booking event class
 */
class Booking extends Event
{

    const CARD_YELLOW = 1;
    const CARD_RED = 2;
    const CARD_DOUBLE_YELLOW = 3;
    const CARD_ALL = 4;
    const CARD_UNKNOWN = 0;

    /**
     * @var int Card type
     */
    protected $card;


    /**
     * @return int
     */
    public function getCard()
    {
        return $this->card;
    }

    /**
     * @param int $card
     * @return Booking
     */
    public function setCard($card)
    {
        $this->card = $card;
        return $this;
    }

}