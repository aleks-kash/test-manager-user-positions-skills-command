<?php

namespace App\Model\Attributes;

/**
 * Trait NameAttribute
 *
 * @package App\Model\Attributes
 */
trait NameAttribute
{
    /**
     * @var string
     */
    private $name;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;


        return $this;
    }
}
