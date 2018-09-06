<?php

namespace App;

use Humbug\SelfUpdate\Updater;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateCommand extends Command
{
    /**
     * Configure the command options
     *
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('update')
            ->setDescription('Update to the latest version');
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
        $updater = new Updater(null, false);
        $updater->getStrategy()->setPharUrl('https://jessarcher.github.io/cli-template/myapp.phar');
        $updater->getStrategy()->setVersionUrl('https://jessarcher.github.io/cli-template/myapp.phar.version');
        try {
            $result = $updater->update();
            if ($result) {
                $new = $updater->getNewVersion();
                $old = $updater->getOldVersion();
                $output->writeln(
                    sprintf(
                        'Updated from SHA-1 %s to SHA-1 %s', $old, $new
                    )
                );
            } else {
                $output->writeln('<info>No update needed!</info>');
            }
        } catch (\Exception $e) {
            $output->writeln('<error>Something went wrong</error>');
            exit(1);
        }
    }
}
