<?php

namespace app\models;

use app\components\Model;

/**
 * Class UserGroups
 * @package app\models
 */
class UserGroups extends Model
{
    /**
     * @var string
     */
    public static $table = 'api_user_groups';

    /**
     * @var null|array
     */
    private $list = null;

    /**
     * @return string
     */
    public static function tableName()
    {
        return self::$table;
    }

    /**
     * @return $this
     */
    public function getAll()
    {
        $this->list = $this->getDb()
            ->select('*')
            ->from(self::tableName())
            ->all();

        return $this;
    }

    /**
     * @return array
     */
    public function toSelect()
    {
        $list = [];
        foreach ($this->getList() as $value) {
            $list[$value['id']] = $value['name'];
        }

        return $list;
    }

    /**
     * @return array
     */
    public function getList()
    {
        if ($this->list === null) {
            $this->getAll();
        }

        return $this->list;
    }

    /**
     * @param $groupId
     * @return string|null
     */
    public function getGroupName($groupId)
    {
        $data = $this->getDb()
            ->select('name')
            ->from(self::tableName())
            ->where(['id' => $groupId])
            ->limit(1)
            ->one();

        return isset($data['name']) ? $data['name'] : null;
    }
}
