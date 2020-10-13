<?php

namespace App\Model\Attributes;

use App\Model\Interfaces\PositionInterfaces;

/**
 * Trait PositionAttribute
 *
 * @package App\Model\Attributes
 */
trait PositionAttribute
{
    /**
     * @var PositionInterfaces
     */
    private $position;

    /**
     * @return PositionInterfaces
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param PositionInterfaces $position
     *
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }
}
