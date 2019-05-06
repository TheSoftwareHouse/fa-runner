<?php

declare(strict_types = 1);

namespace Infrastructure\Framework\Command;

use Application\Command\SaveRunnerResult;
use Common\Id;
use Domain\Exception\DomainException;
use League\Tactician\CommandBus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunnerResultCommand extends Command
{
    private $commandBus;

    protected static $defaultName = 'runner:result';

    /**
     * @param $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Save runner\'s result');

        $this->addArgument('runnerId', InputArgument::REQUIRED, 'The id of runner');
        $this->addArgument('runId', InputArgument::REQUIRED, 'The id of run');
        $this->addArgument('time', InputArgument::REQUIRED, 'Runner time');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $runnerId = Id::create($input->getArgument('runnerId'));
        $runId = Id::create($input->getArgument('runId'));
        $time = $input->getArgument('time');
        $command = new SaveRunnerResult($runnerId, $runId, (int)$time);

        try {
            $this->commandBus->handle($command);
            $output->writeln('Runner\'s result saved');
        } catch (DomainException $e) {
            $output->writeln($e->getMessage());
        }
    }
}
