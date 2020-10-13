<?php

namespace App;

use App\Service\PositionSkillsCommandService;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Application as ConsoleApplication;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;

/**
 * Class Application
 *
 * @package App
 */
class Application extends ConsoleApplication
{
    /**
     * @var Kernel
     */
    private $kernel;

    /**
     * @var ContainerInterface
     */
    private static $container;

    /**
     * Application constructor.
     *
     * @param Kernel $kernel
     *
     * @throws InvalidArgumentException
     */
    public function __construct(Kernel $kernel)
    {
        $this->kernel = $kernel;

        self::$container = $kernel->getContainer();

        parent::__construct(
            self::$container->hasParameter('application.name')
                ? self::$container->getParameter('application.name')
                : 'UNKNOWN'
            ,
            self::$container->hasParameter('application.version')
                ? self::$container->getParameter('application.version')
                : 'UNKNOWN'
        );

        $this->addConsoleCommands();
    }

    /**
     * @return void
     *
     * @throws InvalidArgumentException
     */
    protected function addConsoleCommands()
    {
        /** @var array $commands */
        if($commands = self::$container->getParameter('application.commands')) {
            foreach ($commands as $command) {
                $this->add(new $command());
            }
        }

        /** @var PositionSkillsCommandService $PositionSkillsCommand */
        $PositionSkillsCommand = self::$container->get('Position.skills.command.service');

        /** @var array $commands */
        if ($commands = $PositionSkillsCommand->makeCommands()) {
            foreach ($commands as $command) {
                $this->add($command);
            }
        }
    }

    /**
     * @param Command $command
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     *
     * @throws \Throwable
     */
    protected function doRunCommand(Command $command, InputInterface $input, OutputInterface $output)
    {
        if ($command instanceof ContainerAwareInterface) {
            $command->setContainer($this->kernel->getContainer());
        }

        return parent::doRunCommand($command, $input, $output);
    }

    /**
     * @param string $parameter
     *
     * @return mixed
     */
    static public function getConfigParameter(string $parameter)
    {
        return self::$container->getParameter($parameter);
    }
}
