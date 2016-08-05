<?php
/**
 * Created by PhpStorm.
 * User: Kostiantyn Tarnashynskyi
 * Email: kostia.tarnashynskyi@gmail.com
 */

namespace AppBundle\Utils;

/**
 * interface ParserInterface
 * @package AppBundle\Utils
 */
interface ParserInterface
{
    public function getMappingFields(array $fields);
}