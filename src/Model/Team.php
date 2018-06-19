<?php
/**
 * User: jantaodev
 * Date: 18.06.18
 * Time: 17:23
 */

namespace JantaoDev\FifaApi\Model;


/**
 * Team class
 */
class Team
{

    /**
     * @var int Team ID
     */
    protected $id;

    /**
     * @var string|array Team name
     */
    protected $name;

    /**
     * @var string Country code
     */
    protected $countryCode;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Team
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
     * @return Team
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     * @return Team
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
        return $this;
    }

}