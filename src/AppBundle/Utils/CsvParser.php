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
     * @return array
     */
    public function getMappingFields(){
        
        $neededFields = [];
        $csv = str_getcsv($this->rawData, "\n");
        //todo getSeparator from shop
        $csvTitle = str_getcsv(array_shift($csv), "\t");
        foreach ($csv as &$row) {
            $row = array_combine($csvTitle, str_getcsv($row, "\t"));
        }

        $i = 0;
        foreach($csv as $item){

            if(!$this->checkConditions($item)){
                continue;
            }
            
            foreach ($this->mappingFields as $field) {
                // поля с дефолтным значение не парсим
                if ($field['defaultValue']) {
                    $neededFields[$i][$field['resultField']] = $field['defaultValue'];
                    continue;
                }

                $shopField = $field['shopField'];
                try{
                    $neededFields[$i][$field['resultField']] = $item[$shopField];
                } catch (\Exception $e) {
                    // todo monolog add error
                    continue;
                }
            }



            $i++;
        }

        return $neededFields;
    }

    /**
     * @param $item xml obj
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