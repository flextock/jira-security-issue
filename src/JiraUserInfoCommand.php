<?php

declare(strict_types=1);

namespace Reload;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class JiraUserInfoCommand extends Command
{
    /**
     * Name of the command.
     *
     * @var string
     */
    protected static $defaultName = 'user-info';

    /**
     * {@inheritDoc}
     */
    protected function configure(): void
    {
        $this
            ->setDescription('Get user info')
            ->setHelp('Lookup an email address and dump user data.')
            ->addArgument('email', InputArgument::REQUIRED, 'Email to lookup');
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $issue = new JiraSecurityIssue();

        $data = $issue->userDataByEmail($input->getArgument('email'));

        $output->writeln(print_r($data, true));

        return 0;
    }
}
