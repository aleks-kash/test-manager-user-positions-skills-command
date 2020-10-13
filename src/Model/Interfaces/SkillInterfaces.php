<?php

namespace App\Model\Interfaces;

/**
 * Interface SkillInterfaces
 *
 * @package App\Model\Interfaces
 */
interface SkillInterfaces
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
}
