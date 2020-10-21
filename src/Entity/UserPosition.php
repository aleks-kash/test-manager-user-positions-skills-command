<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class UserPosition
 *
 * @package App\Entity
 */
class UserPosition
{
    /**
     * @var string
     */
    private $indexKey;

    /**
     * @var string
     */
    private $name;

    /**
     * @var ArrayCollection
     */
    private $skills;

    public function __construct()
    {
        $this->skills = new ArrayCollection();
    }

    /**
     * @return null|string
     */
    public function getIndexKey():? string
    {
        return $this->indexKey;
    }

    /**
     * @param string $indexKey
     *
     * @return $this
     */
    public function setIndexKey(string $indexKey): self
    {
        $this->indexKey = $indexKey;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getName():? string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;


        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getSkills(): ArrayCollection
    {
        return $this->skills;
    }

    /**
     * @param UserPositionSkill $skill
     *
     * @return $this
     */
    public function addSkill(UserPositionSkill $skill): self
    {
        $this->skills->add($skill);

        return $this;
    }
}
