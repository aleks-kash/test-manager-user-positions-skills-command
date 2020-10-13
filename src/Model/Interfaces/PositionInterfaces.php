<?php

namespace App\Model\Interfaces;

/**
 * Interface PositionInterfaces
 *
 * @package App\Model\Interfaces
 */
interface PositionInterfaces
{
    /**
     * @return string
     */
    public function getIndexKey();

    /**
     * @param string $indexKey
     *
     * @return $this
     */
    public function setIndexKey(string $indexKey);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name);

    /**
     * @return array
     */
    public function getSkills();

    /**
     * @param array $skills
     *
     * @return $this
     */
    public function setSkills(array $skills);

    /**
     * @param SkillInterfaces $skill
     *
     * @return $this
     */
    public function addSkill(SkillInterfaces $skill);
}
