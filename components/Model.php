<?php

namespace app\components;

use yii\db\Query;

/**
 * Class Model
 * @package app\components
 */
class Model extends \yii\Base\Model
{
    /**
     * @var Query
     */
    private $db = null;

    public function __construct()
    {
        $this->setDbDriver();
    }

    /**
     * @return Query
     */
    protected function getDb()
    {
        return $this->db;
    }

    private function setDbDriver()
    {
        if ($this->db === null) {
            $this->db = new Query();
        }
    }

    /**
     * @param array $data
     * @return array
     */
    protected function prepareToBatchInsert($data)
    {
        $fields = [];
        $rows = [];
        $row = [];

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $row = [];
                foreach ($value as $k => $v) {
                    if (!in_array($k, $fields)) {
                        $fields[] = $k;
                    }
                    $row[] = $v;
                }

                $rows[] = $row;
            } else {
                $fields[] = $key;
                $row[] = $value;
            }
        }

        $rows[] = $row;
        return ['fields' => $fields, 'rows' => $rows];
    }
}
