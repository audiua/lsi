<?php
/**
 * Created by PhpStorm.
 * User: Kostia Tarnashynskyi
 * Email: kostia.tarnashynskyi@gmail.com
 */

namespace AppBundle\Utils;

class Parser
{
    protected $shop;
    protected $di;
    protected $mappingFields;
    protected $conditions;
    protected $rawData;

    public function __construct($di, $shop)
    {
        $this->di = $di;
        $this->shop = $shop;
        foreach($shop->getFields() as $field){

            $this->mappingFields[] = [
                'shopField' => $field->getShopField(),
                'resultField' => $field->getResultField(),
                'defaultValue' => $field->getDefaultValue(),
            ];
        }


        foreach ($shop->getConditions() as $condition) {
            $this->conditions[] = [
                'leftValue' => $condition->getLeftValue(),
                'operator' => $condition->getOperator(),
                'rigthValue' => $condition->getRigthValue()
            ];
        }

        if(!$this->conditions){
            $this->conditions = [];
        }
    }

    public function setRawData($data)
    {
        $this->rawData = $data;
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
                    if ((string)$item->$leftField > $condition['rigthValue']) {
                        return false;
                    }
                break;

                case '<':
                    if ((string)$item->$leftField < $condition['rigthValue']) {
                        return false;
                    }
                break;

                case '=':
                    if ((string)$item->$leftField != $condition['rigthValue']) {
                        return false;
                    }
                break;
            }
        }
        
        return true;
    }
}