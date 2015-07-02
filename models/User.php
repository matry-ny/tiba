<?php

namespace app\models;

use app\components\Model;
use app\helpers\ModelHelper;
use app\helpers\StringHelper;

/**
 * Class User
 * @package app\models
 */
class User extends Model
{
    /**
     * @var string
     */
    public static $table = 'api_users';

    /**
     * @return string
     */
    public static function tableName()
    {
        return self::$table;
    }

    /**
     * @param int $id
     * @return array|bool
     */
    public function getById($id)
    {
        return $this->getDb()
            ->select('*')
            ->from(self::tableName())
            ->where(['id' => $id])
            ->limit(1)
            ->one();
    }

    /**
     * @param string $email
     * @return array|bool
     */
    public function getByEmail($email)
    {
        return $this->getDb()
            ->select('*')
            ->from(self::tableName())
            ->where(['email' => $email])
            ->limit(1)
            ->one();
    }

    /**
     * @return array
     */
    public function getAll()
    {
        $data = $this->getDb()
            ->select('*')
            ->from(self::tableName())
            ->all();

        $result = [];
        foreach ($data as $value) {
            $value['group_name'] = (new UserGroups())->getGroupName($value['group']);
            $result[] = ModelHelper::populateModel('\app\populate\User', $value);
        }

        return $result;
    }

    /**
     * @param $email
     * @param $password
     * @return bool|mixed
     * @throws \yii\db\Exception
     */
    public function login($email, $password)
    {
        $userData = $this->getDb()
            ->select('*')
            ->from(self::tableName())
            ->where(['email' => $email, 'password' => $password, 'is_active' => 1])
            ->limit(1)
            ->one();

        if ($userData) {
            $userData['auth_key'] = (new StringHelper())->random();
            $this->getDb()
                ->createCommand()
                ->update(self::tableName(), ['auth_key' => $userData['auth_key']], "id = {$userData['id']}")
                ->execute();

            return ModelHelper::populateModel('\app\populate\User', $userData);
        }

        return false;
    }

    /**
     * @param $data
     * @return string
     */
    public function create($data)
    {
        $data = $this->prepareToBatchInsert($data);
        $query = \Yii::$app->db->getQueryBuilder()->batchInsert(self::tableName(), $data['fields'], $data['rows']);

        return \Yii::$app->db->createCommand($query)->execute();
    }

    /**
     * @param int $userId
     * @param string $hash
     * @return bool
     */
    public function checkHash($userId, $hash)
    {
        $result = $this->getDb()
            ->select('auth_key')
            ->from(self::tableName())
            ->where(['id' => $userId])
            ->limit(1)
            ->one();

        if (isset($result['auth_key'])) {
            return $result['auth_key'] === $hash;
        }

        return false;
    }
}
