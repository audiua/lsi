<?php
/**
 * Created by PhpStorm.
 * User: Kostia Tarnashynskyi
 * Email: kostia.tarnashynskyi@gmail.com
 */

namespace AppBundle\Utils;

/**
 * Класс парсинга, включающий общие свойства и методы для отнаследованных персеров
 * Class Parser
 * @package AppBundle\Utils
 */
class Parser
{
    /**
     * @var obj
     */
    protected $shop;

    /**
     * @var obj
     */
    protected $di;

    /**
     * @var array
     */
    protected $mappingFields = [];

    /**
     * @var array
     */
    protected $conditions = [];

    /**
     * @var mixed
     */
    protected $rawData = '';

    /**
     * Parser constructor.
     * @param $di
     * @param $shop
     */
    public function __construct($di, $shop)
    {
        $this->di = $di;
        $this->shop = $shop;
        foreach ($shop->getFields() as $field) {
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
    }

    /**
     * setter
     * @param $data
     */
    public function setRawData($data)
    {
        $this->rawData = $data;
    }

    /**
     * Проверка условий / будет отдельная реализация в дочерних классах
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