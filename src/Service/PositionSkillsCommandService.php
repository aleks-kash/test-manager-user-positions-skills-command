<?php

namespace App\Service;

use App\Provider\PositionSkillsProvider;
use App\Command\PositionsManager\CommandBuilder;
use App\Model\Interfaces\SkillInterfaces;
use App\Model\Interfaces\PositionInterfaces;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

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

        /** @var PositionInterfaces $position */
        foreach ($this->provider->getPositions() as $position) {

            $positionName = ucfirst($position->getName());

            $commands[] = $this->getUserPositionCommand($position, $positionName);
            $commands[] = $this->getPositionCanCommand($position, $positionName);
        }
        return $commands;
    }

    /**
     * @param PositionInterfaces $position
     * @param $positionName
     *
     * @return CommandBuilder
     */
    private function getUserPositionCommand(PositionInterfaces $position, $positionName): CommandBuilder
    {
        $commandName = "user:{$position->getIndexKey()}";
        $description = "{$positionName} position";
        $help = " - Get all skill`s for position '{$positionName}'";

        $callableExecute = function (InputInterface $input, OutputInterface $output) use ($position, $positionName) {
            $output->writeln([
                "-///- User {$positionName} can:",
                ' /// ',
            ]);

            /** @var SkillInterfaces $skill */
            foreach ($position->getSkills() as $skill){
                $output->writeln("-///--- {$skill->getName()}");
            }
        };

        $command = new CommandBuilder($commandName,
            $callableExecute,
            $description,
            $help
        );

        return $command;
    }

    /**
     * @param PositionInterfaces $position
     * @param $positionName
     *
     * @return CommandBuilder
     */
    private function getPositionCanCommand(PositionInterfaces $position, $positionName): CommandBuilder
    {
        $commandName = "can:{$position->getIndexKey()}";
        $description = "Checking skill for position '{$positionName}'";
        $help = " - Checking whether the position '{$positionName}' has a skill";

        $callableExecute = function (InputInterface $input, OutputInterface $output) use ($position, $positionName) {
            $skill = $input->getArgument('skill');
            $isPositionCan = array_key_exists($skill, $position->getSkills()) ? 'true' : 'false';
            $output->writeln($isPositionCan);
        };

        $command = new class($commandName, $callableExecute, $description, $help) extends CommandBuilder {
            protected function configure()
            {
                parent::configure();

                $this->addArgument('skill', InputArgument::REQUIRED, 'Skill Name for the position');
            }
        };

        return $command;
    }
}
