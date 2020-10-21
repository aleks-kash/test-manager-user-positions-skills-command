<?php

namespace App\Entity;

/**
 * Class UserPositionSkill
 *
 * @package App\Entity
 */
class UserPositionSkill
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
}
