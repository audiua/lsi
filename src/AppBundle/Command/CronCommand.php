<?php

/**
 * Created by PhpStorm.
 * User: Kostiantyn Tarnashynskyi
 * Email: kostia.tarnashynskyi@gmail.com
 */
namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CronCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:cron')
            ->setDescription('run cron tasks')
            ->setHelp("This command run cron tasks")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        return;
    }
}