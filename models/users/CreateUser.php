<?php

namespace app\models\users;

use app\models\User;

class CreateUser extends User
{
    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $group;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $compare_password;

    /**
     * @var string
     */
    public $avatar;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['email', 'name', 'group', 'password', 'compare_password', 'avatar'], 'required'],
            [['email', 'name', 'password', 'compare_password', 'avatar'], 'string'],
            ['email', 'email'],
            ['group', 'integer'],

            ['compare_password', 'compare', 'compareAttribute' => 'password'],
            ['password', 'string', 'min' => 5],
            ['password', 'filter', 'filter' => function () {
                return md5($this->password);
            }],

            ['email', 'filter', 'filter' => function () {
                return mb_convert_case($this->email, MB_CASE_LOWER, "UTF-8");
            }],
            ['email', 'isAlreadyExists', 'when' => function (CreateUser $model) {
                return !$model->hasErrors();
            }],

            ['name', 'filter', 'filter' => function () {
                $this->name = mb_convert_case($this->name, MB_CASE_LOWER, "UTF-8");
                return mb_convert_case($this->name, MB_CASE_TITLE, "UTF-8");
            }]
        ];
    }

    /**
     * @return bool
     */
    public function isAlreadyExists()
    {
        if (!empty($this->getByEmail($this->email))) {
            $this->addError('emailExists', \Yii::t('app', 'Указанный e-mail уже зарегистрирован в системе'));
        }
    }

    public function run()
    {
        $data = [
            'email' => $this->email,
            'name' => $this->name,
            'group' => $this->group,
            'auth_key' => $this->password,
            'avatar' => $this->avatar
        ];
        return $this->create($data);
    }
}
