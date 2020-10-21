<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 21.10.2020
 * Time: 20:52
 */

namespace App\Command;

use App\Entity\UserPosition;
use App\Entity\UserPositionSkill;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CommandBuilder
 *
 * @package App\Command
 */
class UserPositionSkillsCommand extends Command
{
    const INFO_POSITION_MOD = 1;
    const CAN_POSITION_MOD = 2;

    /**
     * the name of the command (the part after "bin/console")
     *
     * @var string
     */
    protected static $defaultName = '';

    /**
     * @var UserPosition
     */
    private $userPosition;

    /**
     * @var
     */
    private $commandMod;

    /**
     * CommandBuilder constructor.
     *
     * @param UserPosition $userPosition
     * @param int $commandMod
     */
    public function __construct(UserPosition $userPosition, int $commandMod)
    {
        $this->userPosition = $userPosition;

        $this->commandMod = $commandMod;

        switch ($commandMod) {
            case self::INFO_POSITION_MOD:
                static::$defaultName = "user:{$userPosition->getIndexKey()}";
                break;

            case self::CAN_POSITION_MOD:
                static::$defaultName = "can:{$userPosition->getIndexKey()}";
                break;
        }

        parent::__construct();
    }

    /**
     * @return void
     */
    protected function configure()
    {
        $description = '';
        $help = '';

        switch ($this->commandMod) {
            case self::INFO_POSITION_MOD:
                $description = "{$this->userPosition->getName()} position";
                $help = " - Get all skill`s for position '{$this->userPosition->getName()}'";
                break;

            case self::CAN_POSITION_MOD:
                $description = "Checking skill for position '{$this->userPosition->getName()}'";
                $help = " - Checking whether the position '{$this->userPosition->getName()}' has a skill";
                $this->addArgument('skill', InputArgument::REQUIRED, 'Skill for the position');
                break;
        }

        $this
            ->setName(static::$defaultName)
            ->setDescription($description)
            ->setHelp($help)
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        switch ($this->commandMod) {
            case self::INFO_POSITION_MOD:
                $this->executeInfoPositionMod($output);
                break;

            case self::CAN_POSITION_MOD:
                $this->executeCanPositionMod($input, $output);
                break;
        }
    }

    /**
     * @param OutputInterface $output
     */
    private function executeInfoPositionMod(OutputInterface $output): void
    {
        $output->writeln([
            "-///- User {$this->userPosition->getName()} can:",
            ' /// ',
        ]);

        /** @var UserPositionSkill $skill */
        foreach ($this->userPosition->getSkills() as $skill){
            $output->writeln("-///--- {$skill->getName()}");
        }
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    private function executeCanPositionMod(InputInterface $input, OutputInterface $output): void
    {
        $skill = $input->getArgument('skill');
        $userPositionSkill = $this->userPosition
            ->getSkills()
            ->filter(function(UserPositionSkill $userPositionSkill) use ($skill) {
                return $userPositionSkill->getIndexKey() === $skill;
            })
            ->first()
        ;

        $output->writeln($userPositionSkill ? 'true' : 'false');
    }
}
