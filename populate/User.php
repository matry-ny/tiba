<?php

namespace app\populate;

/**
 * Class User
 * @package app\library
 */
class User extends Populator
{
    /**
     * @return int
     */
    public function getId()
    {
        return $this->getValue('id');
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->getValue('email');
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getValue('name');
    }

    /**
     * @return int
     */
    public function getGroupId()
    {
        return $this->getValue('group');
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->getValue('password');
    }

    /**
     * @return string
     */
    public function getAuthKey()
    {
        return $this->getValue('auth_key');
    }

    /**
     * @return string
     */
    public function getAvatar()
    {
        return $this->getValue('avatar') ? $this->getValue('avatar') : '/storage/images/system/user.png';
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return !empty($this->getValue('is_active'));
    }

    /**
     * @return string
     */
    public function getCreateDate()
    {
        return $this->getValue('create_time');
    }

    /**
     * @return string|null
     */
    public function getGroupName()
    {
        return $this->getValue('group_name');
    }
}
