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
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class PositionInfoCommand
 *
 * @package App\Command
 */
class PositionInfoCommand extends Command
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

        static::$defaultName = "user:{$userPosition->getIndexKey()}";

        parent::__construct();
    }

    /**
     * @return void
     */
    protected function configure()
    {
        $description = "{$this->userPosition->getName()} position";
        $help = " - Get all skill`s for position '{$this->userPosition->getName()}'";

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
        $output->writeln([
            " - User {$this->userPosition->getName()} can:",
            '',
        ]);

        /** @var UserPositionSkill $skill */
        foreach ($this->userPosition->getSkills() as $skill){
            $output->writeln(" - {$skill->getName()}");
        }
    }
}
