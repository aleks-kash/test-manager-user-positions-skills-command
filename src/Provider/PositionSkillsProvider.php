<?php

namespace App\Provider;

use App\Entity\UserPosition;
use App\Entity\UserPositionSkill;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class PositionSkillsProvider
 *
 * @package App\Provider
 */
class PositionSkillsProvider
{
    /**
     * @var ArrayCollection
     */
    private $userPositions;

    /**
     * PositionSkillsProvider constructor.
     *
     * @param array $positions
     */
    public function __construct(array $positions)
    {
        $this->userPositions = new ArrayCollection();
        $this->makePositions($positions);
    }

    /**
     * @return ArrayCollection
     */
    public function getUserPositions(): ArrayCollection
    {
        return $this->userPositions;
    }

    /**
     * @param array $positionSkills
     */
    private function makePositions(array $positionSkills): void
    {
        foreach ($positionSkills as $positionName => $skills) {

            $userPosition = $this->prepareUserPosition($positionName);

            foreach ($skills as $skillName) {
                $userPositionSkill = $this->prepareUserPositionSkill($skillName);
                $userPosition->addSkill($userPositionSkill);
            }

            $this->userPositions->add($userPosition);
        }
    }

    /**
     * @param string $positionName
     *
     * @return UserPosition
     */
    private function prepareUserPosition(string $positionName): ? UserPosition
    {
        $userPosition = new UserPosition();
        $userPosition
            ->setIndexKey($this->prepareIndexKey($positionName))
            ->setName($positionName)
        ;

        return $userPosition;
    }

    /**
     * @param string $skillName
     *
     * @return UserPositionSkill
     */
    private function prepareUserPositionSkill(string $skillName): UserPositionSkill
    {
        static $skill = [];

        $indexKey = $this->prepareIndexKey($skillName);

        if (isset($skill[$indexKey])) {
            return $skill[$indexKey];
        }

        $userPositionSkill = new UserPositionSkill();
        $userPositionSkill
            ->setIndexKey($indexKey)
            ->setName($skillName)
        ;

        return $userPositionSkill;
    }

    /**
     * @param string $indexKey
     *
     * @return string
     */
    private function prepareIndexKey(string $indexKey): string
    {
        $indexKey = ucwords($indexKey,' ');
        $indexKey = lcfirst($indexKey);

        return str_replace(' ', '', $indexKey);
    }
}
