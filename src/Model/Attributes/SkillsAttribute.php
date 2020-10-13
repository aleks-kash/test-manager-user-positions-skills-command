<?php

namespace App\Model\Attributes;

use App\Model\Interfaces\SkillInterfaces;

/**
 * Trait SkillsAttribute
 *
 * @package App\Model\Attributes
 */
trait SkillsAttribute
{
    /**
     * @var array
     */
    private $skills;

    /**
     * @return array
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * @param array $skills
     *
     * @return $this
     */
    public function setSkills(array $skills)
    {
        $this->skills = $skills;

        return $this;
    }

    /**
     * @param SkillInterfaces $skill
     *
     * @return $this
     */
    public function addSkill(SkillInterfaces $skill)
    {
        $this->skills[$skill->getIndexKey()] = $skill;

        return $this;
    }
}
