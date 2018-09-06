<?php

namespace App;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GreetCommand extends Command
{
    /**
     * Configure the command options
     *
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('greet')
            ->setDescription('Greet someone')
            ->addArgument('name', InputArgument::REQUIRED, 'Who shall I greet?')
            ->addOption('greeting', 'g', InputOption::VALUE_OPTIONAL, 'What greeting shall I use?', 'Hello')
            ->addOption('yell', 'y', InputOption::VALUE_NONE, 'Should we yell?');
    }

    /**
     * Execute the command
     *
     * @param  InputInterface $input
     * @param  OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $greeting = sprintf('%s, %s', $input->getOption('greeting'), $input->getArgument('name'));

        if ($input->getOption('yell')) {
            $greeting = strtoupper($greeting) . '!!!';
        } else {
            $greeting .= '.';
        }

        $output->writeln("<info>$greeting</info>");
    }
}
