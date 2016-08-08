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
use Symfony\Component\Console\Input\InputArgument;
use AppBundle\Utils\ApiParser;

/**
 * Class ParserCommand
 * Комманда парсинга апи магазина
 * @package AppBundle\Command
 */
class ParserCommand extends Command
{
    /**
     * configure command
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('app:parser')
            ->addArgument('shop', InputArgument::REQUIRED, 'Shop Id')
            ->setDescription('parse')
            ->setHelp("This command parse")
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $container = $this->getApplication()
            ->getKernel()
            ->getContainer();

        $entityManager = $container
            ->get('doctrine')
            ->getEntityManager();

        $shop = $entityManager
            ->getRepository('AppBundle:Shop')
            ->find($input->getArgument('shop'));

        $output->writeln([
            'Start shop parsing - '. $shop->getName(),
            '============',
            '',
        ]);

        // выполнение парсинга
        try{
            $parser = new ApiParser($container, $shop);
            $parser->run();
        } catch(\Exception $e) {
            //todo monolog errors
            echo $e->getMessage();
        }

        $output->writeln([
            'End shop parsing - '. $shop->getName(),
            '============',
            '',
        ]);
    }
}