<?php

namespace app\models\users;

use app\models\User;

/**
 * Class LoginUser
 * @package app\models\users
 */
class LoginUser extends User
{
    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $password;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['email', 'filter', 'filter' => function () {
                return mb_convert_case($this->email, MB_CASE_LOWER, "UTF-8");
            }],
            ['password', 'filter', 'filter' => function () {
                return md5($this->password);
            }]
        ];
    }

    public function run()
    {
        return $this->login($this->email, $this->password);
    }
}
