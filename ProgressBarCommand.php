<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProgressBarCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:progress_bar_command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $progressBar = new ProgressBar($output, 1000);
        $progressBar->setFormat(
            "<fg=white;bg=cyan> %status:-45s%</>\n%current%/%max% [%bar%] %percent:3s%%\n🏁  %estimated:-21s% %memory:21s%"
        );
        $progressBar->setBarCharacter('<fg=green>⚬</>');
        $progressBar->setEmptyBarCharacter("<fg=red>⚬</>");
        $progressBar->setProgressCharacter("<fg=green>➤</>");
        
        $progressBar->setRedrawFrequency(10);
        $progressBar->start();

        for ($i = 0; $i < 1000; $i++) {
            if ($i < 300) {
                $progressBar->setMessage("Starting...", 'status');
            } elseif ($i < 700) {
                $progressBar->setMessage("All right :)", 'status');
            } else {
                $progressBar->setMessage("Almost there...", 'status');
            }

            $progressBar->advance();
            usleep(1000);
        }

        $progressBar->setMessage("Uff, done :)", 'status');
        $progressBar->finish();
    }
}
