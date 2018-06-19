<?php
/**
 * User: jantaodev
 * Date: 18.06.18
 * Time: 13:57
 */

namespace JantaoDev\FifaApi\Model;

/**
 * Player class
 */
class Player
{

    /**
     * @var int Player ID
     */
    protected $id;

    /**
     * @var Team Player`s team
     */
    protected $team;

    /**
     * @var int Shirt number of player
     */
    protected $shirtNumber;

    /**
     * @var string|array Name
     */
    protected $name;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Player
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return \JantaoDev\FifaApi\Model\Team
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @param \JantaoDev\FifaApi\Model\Team $team
     * @return Player
     */
    public function setTeam($team)
    {
        $this->team = $team;
        return $this;
    }

    /**
     * @return int
     */
    public function getShirtNumber()
    {
        return $this->shirtNumber;
    }

    /**
     * @param int $shirtNumber
     * @return Player
     */
    public function setShirtNumber($shirtNumber)
    {
        $this->shirtNumber = $shirtNumber;
        return $this;
    }

    /**
     * @return array|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param array|string $name
     * @return Player
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

}