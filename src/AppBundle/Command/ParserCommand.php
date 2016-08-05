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

/**
 * Class ParserCommand
 * @package AppBundle\Command
 */
class ParserCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:parser')
            ->setDescription('parse')
            ->setHelp("This command parse")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        return;
    }
}