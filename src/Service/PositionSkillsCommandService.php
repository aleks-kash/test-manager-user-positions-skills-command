<?php

namespace App\Service;

use App\Command\PositionCanCommand;
use App\Command\PositionInfoCommand;
use App\Entity\UserPosition;
use App\Provider\PositionSkillsProvider;

/**
 * Class PositionSkillsCommandService
 *
 * @package App\Service
 */
class PositionSkillsCommandService
{
    /**
     * @var PositionSkillsProvider
     */
    private $provider;

    /**
     * PositionSkillsCommandService constructor.
     *
     * @param PositionSkillsProvider $provider
     */
    public function __construct(PositionSkillsProvider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @return array|null
     */
    public function addCommands(): ? array
    {
        $commands = [];

        /** @var UserPosition $userPosition */
        foreach ($this->provider->getUserPositions() as $userPosition) {

            $commands[] = new PositionInfoCommand($userPosition);
            $commands[] = new PositionCanCommand($userPosition);
        }
        return $commands;
    }
}
