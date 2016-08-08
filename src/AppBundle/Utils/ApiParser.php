<?php
/**
 * Created by PhpStorm.
 * User: Kostiantyn Tarnashynskyi
 * Email: kostia.tarnashynskyi@gmail.com
 */

namespace AppBundle\Utils;

use AppBundle\Entity\Cron;
use AppBundle\Entity\Result;

/**
 * class ApiParser
 * @package AppBundle\Utils
 */
class ApiParser
{
    /**
     * @var
     */
    private $em;

    /**
     * @var
     */
    private $di;

    /**
     * @var
     */
    private $shop;

    private $parser;

    /**
     * ApiParser constructor.
     * @param $em
     * @param $shop
     */
    public function __construct($di, $shop)
    {
        $this->di = $di;
        $this->em = $di->get('doctrine')->getEntityManager();
        $this->shop = $shop;
        $parserName = 'AppBundle\\Utils\\'.ucfirst($shop->getResponceType()) . 'Parser';
        $this->parser = new $parserName($di, $shop);

        $this->run();
    }
    
    public function run()
    {

        // todo переделать на проверку заголовков
        if ($shopApiData = $this->getApiData($this->shop->getResponceType())) {

//            dump($shopApiData);
//            die();

            // получили ответ от магазина, сохранение крон логов
            $cron = new Cron();
            $cron->setShop($this->shop);
            $cron->setCreatedAt(time());
            $this->em->persist($cron);
            $this->em->flush();

            // парсинг ответа магазина
            $this->parser->setRawData($shopApiData);
            $neededFields = $this->parser->getMappingFields();
            if ($neededFields) {
                foreach ($neededFields as $field) {
                    $cron = new Result();
                    $cron->setShop($this->shop);
                    $cron->setOrderId($field['orderId']);
                    $cron->setStatus($field['status']);
                    $cron->setCurrency($field['currency']);
                    $cron->setTotal($field['total']);
                    $cron->setOrderedAt($field['orderedAt']);
                    $this->em->persist($cron);
                }
                $this->em->flush();
            }
        }
    }

    protected function getApiData($type)
    {
        //todo переделать под Guzzle фреймворк
//        return file_get_contents($this->shop->getApiUrl());
        return file_get_contents($this->di->get('kernel')->getRootDir() . "/../var/api_data/data.{$type}");
    }

}