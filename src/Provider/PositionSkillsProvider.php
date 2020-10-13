<?php

namespace App\Provider;

use App\Model\Attributes\IndexKeyAttribute;
use App\Model\Attributes\NameAttribute;
use App\Model\Attributes\SkillsAttribute;
use App\Model\Interfaces\SkillInterfaces;
use App\Model\Interfaces\PositionInterfaces;

/**
 * Class PositionSkillsProvider
 *
 * @package App\Provider
 */
class PositionSkillsProvider
{
    private $positions = [];

    /**
     * PositionSkillsProvider constructor.
     *
     * @param array $positions
     */
    public function __construct(array $positions)
    {
        $this->makePositions($positions);
    }

    /**
     * @param array $positionSkills
     */
    private function makePositions(array $positionSkills): void
    {

        array_walk($positionSkills,function(&$value, $indexPositionName) {

            $position = new class($indexPositionName) implements PositionInterfaces {
                use IndexKeyAttribute;
                use NameAttribute;
                use SkillsAttribute;

                public function __construct(string $indexPositionName)
                {
                    $this
                        ->setIndexKey($indexPositionName)
                        ->setName($indexPositionName)
                    ;
                }
            };

            foreach ($value as $skillName) {
                $position->addSkill(new class($skillName) implements SkillInterfaces {
                    use IndexKeyAttribute;
                    use NameAttribute;

                    public function __construct(string $skillName)
                    {
                        $this
                            ->setIndexKey($skillName)
                            ->setName($skillName)
                        ;
                    }
                });
            }

            $value = $position;

        });

        $this->positions = $positionSkills;
    }

    /**
     * @return array|null
     */
    public function getPositions(): ? array
    {
        return $this->positions;
    }

    /**
     * @param string $positionName
     *
     * @return PositionInterfaces|null
     */
    public function getPosition(string $positionName): ? PositionInterfaces
    {
        return @$this->positions[$positionName];
    }
}
