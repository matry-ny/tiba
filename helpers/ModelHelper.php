<?php

namespace app\helpers;

/**
 * Class ModelHelper
 * @package app\helpers
 */
class ModelHelper
{
    /**
     * @param string $modelName
     * @param $data
     * @return mixed
     */
    public static function populateModel($modelName, $data)
    {
        return new $modelName($data);
    }

    /**
     * @param string $modelName
     * @param array $list
     * @return array
     */
    public static function populateModels($modelName, $list)
    {
        $result = [];
        foreach ($list as $item) {
            $result[] = self::populateModel($modelName, $item);
        }
        return $result;
    }
}