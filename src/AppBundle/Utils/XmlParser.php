<?php

/**
 * Created by PhpStorm.
 * User: Kostiantyn Tarnashynskyi
 * Email: kostia.tarnashynskyi@gmail.com
 */

namespace AppBundle\Utils;

/**
 * Class XmlParser
 * @package AppBundle\Utils
 */
class XmlParser extends Parser
{
    /**
     * Получение данных из апи и маппинг их с нужными полями из рузльтирующей таблицы для сохранения
     * @return array
     */
    public function getMappingFields(){
        $neededFields = [];
        $xml = simplexml_load_string($this->rawData);

        // индекс не числовой
        $i = 0;
        foreach ($xml as $item) {

            if (!$this->checkConditions($item)) {
                continue;
            }

            foreach ($this->mappingFields as $field) {
                // поля с дефолтным значение не парсим
                if ($field['defaultValue']) {
                    $neededFields[$i][$field['resultField']] = $field['defaultValue'];
                    continue;
                }

                $shopField = $field['shopField'];
                // на случай если нет узла
                try{
                    $neededFields[$i][$field['resultField']] = (string)$item->$shopField;
                } catch (\Exception $e) {
                    // todo monolog add error
                    continue;
                }
            }
            $i++;
        }

        return $neededFields;
    }
}