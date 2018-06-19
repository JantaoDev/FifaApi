<?php
/**
 * User jantaodev
 * Date: 18.06.18
 * Time: 13:56
 */

namespace JantaoDev\FifaApi\Model;

/**
 * Competition Info Class
 */
class Competition
{

    /**
     * @var int Competition ID
     */
    protected $id;

    /**
     * @var string|array Competition name
     */
    protected $name;

    /**
     * @var int Season ID
     */
    protected $seasonId;

    /**
     * @var string|array Season name
     */
    protected $seasonName;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Competition
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return Competition
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @return Competition
     */
    public function setSeasonId($seasonId)
    {
        $this->seasonId = $seasonId;
        return $this;
    }

    /**
     * @return array|string
     */
    public function getSeasonName()
    {
        return $this->seasonName;
    }

    /**
     * @param array|string $seasonName
     * @return Competition
     */
    public function setSeasonName($seasonName)
    {
        $this->seasonName = $seasonName;
        return $this;
    }

}