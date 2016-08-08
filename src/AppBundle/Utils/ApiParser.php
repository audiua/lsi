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

    /**
     * @var
     */
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

    /**
     * Выполнение парсинга ответа магазина
     */
    public function run()
    {
        // todo переделать на проверку заголовков
        if ($shopApiData = $this->getApiData($this->shop->getResponceType())) {
            $this->saveCronExecute();

            // парсинг ответа магазина
            $this->parser->setRawData($shopApiData);
            $neededFields = $this->parser->getMappingFields();
            if ($neededFields) {
                foreach ($neededFields as $fields) {
                    $this->saveResultShopData($fields);
                }
                $this->em->flush();
            }
        }
    }

    /**
     * Выполнение запроса по апи(на даном этапе чтение данных с файлов - var/api_data)
     * @param $type
     * @return mixed
     */
    protected function getApiData($type)
    {
        //todo will do with Guzzle framework
//        return file_get_contents($this->shop->getApiUrl());
        return file_get_contents($this->di->get('kernel')->getRootDir() . "/../var/api_data/data.{$type}");
    }

    /**
     * Сохранение выполнения парсинга по крону для магазина
     * @return vaid
     */
    private function saveCronExecute()
    {
        $cron = new Cron();
        $cron->setShop($this->shop);
        $cron->setCreatedAt(time());
        $this->em->persist($cron);
        $this->em->flush();
    }

    /**
     * @param $fields
     */
    private function saveResultShopData($fields)
    {
        $cron = new Result();
        $cron->setShop($this->shop);
        $cron->setOrderId($fields['orderId']);
        $cron->setStatus($fields['status']);
        $cron->setCurrency($fields['currency']);
        $cron->setTotal($fields['total']);
        $cron->setOrderedAt($fields['orderedAt']);
        $this->em->persist($cron);
    }


}