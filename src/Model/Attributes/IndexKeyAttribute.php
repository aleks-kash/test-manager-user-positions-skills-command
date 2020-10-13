<?php

namespace App\Model\Attributes;

/**
 * Trait IndexKeyAttribute
 *
 * @package App\Model\Attributes
 */
trait IndexKeyAttribute
{
    /**
     * @var string
     */
    private $indexKey;

    /**
     * @return string
     */
    public function getIndexKey()
    {
        return $this->indexKey;
    }

    /**
     * @param string $indexKey
     *
     * @return $this
     */
    public function setIndexKey(string $indexKey)
    {
        $indexKey = ucwords($indexKey,' ');
        $indexKey = lcfirst($indexKey);

        $this->indexKey = str_replace(' ', '', $indexKey);

        return $this;
    }
}
