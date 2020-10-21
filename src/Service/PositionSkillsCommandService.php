<?php

namespace App\Service;

use App\Command\UserPositionSkillsCommand as Command;
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
    public function makeCommands(): ? array
    {
        $commands = [];

        /** @var UserPosition $userPosition */
        foreach ($this->provider->getUserPositions() as $userPosition) {

            $commands[] = new Command($userPosition, Command::INFO_POSITION_MOD);
            $commands[] = new Command($userPosition, Command::CAN_POSITION_MOD);
        }
        return $commands;
    }
}
