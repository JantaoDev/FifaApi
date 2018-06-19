<?php
/**
 * User: jantaodev
 * Date: 18.06.18
 * Time: 13:58
 */

namespace JantaoDev\FifaApi\Model\Event;

/**
 * Goal event class
 */
class Goal extends Event
{

    const GOAL_UNKNOWN = 0;
    const GOAL_PENALTY = 1;
    const GOAL_REGULAR = 2;
    const GOAL_OWN = 3;

    /**
     * @var int Goal type
     */
    protected $goal;


    /**
     * @return int
     */
    public function getGoal()
    {
        return $this->goal;
    }

    /**
     * @param int $goal
     * @return Goal
     */
    public function setGoal($goal)
    {
        $this->goal = $goal;
        return $this;
    }

}