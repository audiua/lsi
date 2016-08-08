<?php

/**
 * Created by PhpStorm.
 * User: Kostiantyn Tarnashynskyi
 * Email: kostia.tarnashynskyi@gmail.com
 */

namespace AppBundle\Utils;

/**
 * Class CsvParser
 * @package AppBundle\Utils
 */
class CsvParser extends Parser
{
    /**
     * Получение данных из апи и маппинг их с нужными полями из рузльтирующей таблицы для сохранения
     * @return array
     */
    public function getMappingFields()
    {
        $neededFields = [];
        // по строкам
        $csv = str_getcsv($this->rawData, "\n");
        // по полям
        //todo переделать под разделитель из настроек магазина
        $csvTitle = str_getcsv(array_shift($csv), "\t");
        foreach ($csv as &$row) {
            $row = array_combine($csvTitle, str_getcsv($row, "\t"));
        }

        foreach ($csv as $i => $item) {
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
                // на случай если нет такого поля
                try{
                    $neededFields[$i][$field['resultField']] = $item[$shopField];
                } catch (\Exception $e) {
                    // todo monolog add error
                    continue;
                }
            }
        }

        return $neededFields;
    }

    /**
     * Проверка условий для полей магазина
     * @param $item array
     * @return bool
     */
    public function checkConditions($item)
    {
        foreach ($this->conditions as $condition) {
            $leftField = $condition['leftValue'];
            switch ($condition['operator']) {
                case '>':
                    if ($item[$leftField] > $condition['rigthValue']) {
                        return false;
                    }
                    break;

                case '<':
                    if ($item[$leftField] < $condition['rigthValue']) {
                        return false;
                    }
                    break;

                case '=':
                    if ($item[$leftField] != $condition['rigthValue']) {
                        return false;
                    }
                    break;
            }
        }

        return true;
    }
}