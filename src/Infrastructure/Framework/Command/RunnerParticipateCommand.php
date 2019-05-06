<?php

declare(strict_types = 1);

namespace Infrastructure\Framework\Command;

use Application\Command\EnrollRunnerToRun;
use Application\Handler\EnrollRunnerToRunHandler;
use Common\Id;
use Domain\Exception\DomainException;
use League\Tactician\CommandBus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunnerParticipateCommand extends Command
{
    private $commandBus;

    protected static $defaultName = 'runner:enroll';

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
        $this->setDescription('Enroll runner to run');

        $this->addArgument('runnerId', InputArgument::REQUIRED, 'The id of runner');
        $this->addArgument('runId', InputArgument::REQUIRED, 'The id of run');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $runnerId = Id::create($input->getArgument('runnerId'));
        $runId = Id::create($input->getArgument('runId'));
        $command = new EnrollRunnerToRun($runnerId, $runId);
        try {
            $this->commandBus->handle($command);
            $output->writeln('Runner enrolled');
        } catch (DomainException $e) {
            $output->writeln($e->getMessage());
        }
    }
}
