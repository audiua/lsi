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
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

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
        $kernel = $this->getApplication()
            ->getKernel();

        $container = $kernel
            ->getContainer();

        $entityManager = $container
            ->get('doctrine')
            ->getEntityManager();

        $shops = $entityManager->getRepository('AppBundle:Cron')->findShops();

        foreach($shops as $shop){

            $output->writeln([
                '============',
                'Start shop parsing - '. $shop->getName(),
                '============',
                ''
            ]);

            // последовательно
//            $parser = new ApiParser($container, $shop);

            // асинхронно
            exec('/usr/bin/php '.$kernel->getRootDir().'/../bin/console app:parser ' . escapeshellcmd($shop->getId()) . ' > /dev/null 2>&1 &');

        }
    }
}