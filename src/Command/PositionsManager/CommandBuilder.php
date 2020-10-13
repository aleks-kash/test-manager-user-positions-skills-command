<?php

namespace App\Command\PositionsManager;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CommandBuilder
 *
 * @package App\Command\PositionsManager
 */
class CommandBuilder extends Command
{
    /**
     * the name of the command (the part after "bin/console")
     *
     * @var string
     */
    protected static $defaultName = '';

    /**
     * @var callable
     */
    private $callableExecute;

    /**
     * CommandBuilder constructor.
     *
     * @param string $commandName
     * @param callable $callableExecute
     * @param string|null $description
     * @param string|null $help
     */
    public function __construct(string $commandName,
        callable $callableExecute,
        string $description = null,
        string $help = null
    )
    {
        $this->callableExecute = $callableExecute;

        $this
            ->setName(static::$defaultName = $commandName)

            // the short description shown while running "php bin/console list"
            ->setDescription($description)

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp($help)
        ;

        parent::__construct();
    }

    /**
     * @return void
     */
    protected function configure()
    {

    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $callableExecute = $this->callableExecute;
        $callableExecute($input, $output);
    }
}
