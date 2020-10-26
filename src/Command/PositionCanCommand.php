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
 * Class PositionCanCommand
 *
 * @package App\Command
 */
class PositionCanCommand extends Command
{
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
     * CommandBuilder constructor.
     *
     * @param UserPosition $userPosition
     */
    public function __construct(UserPosition $userPosition)
    {
        $this->userPosition = $userPosition;

        static::$defaultName = "can:{$userPosition->getIndexKey()}";

        parent::__construct();
    }

    /**
     * @return void
     */
    protected function configure()
    {
        $description = "Checking skill for position '{$this->userPosition->getName()}'";
        $help = " - Checking whether the position '{$this->userPosition->getName()}' has a skill";

        $this
            ->setName(static::$defaultName)
            ->setDescription($description)
            ->setHelp($help)
            ->addArgument('skill', InputArgument::REQUIRED, 'Skill for the position');
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
