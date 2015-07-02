<?php

namespace app\helpers;

use yii\web\Cookie;

/**
 * Class CookieHelper
 * @package app\helpers
 */
class CookieHelper
{
    /**
     * @param $key string
     * @param $value string|int
     */
    public static function setCookie($key, $value, $expire = false)
    {
        $expire = empty($expire) ? (time() + 3600) : $expire;
        \Yii::$app->response->cookies->add(new Cookie([
            'name' => $key,
            'value' => $value,
            'expire' => $expire
        ]));
    }

    /**
     * @param array $data
     */
    public static function setCookies($data = [])
    {
        foreach ($data as $key => $value) {
            self::setCookie($key, $value);
        }
    }

    /**
     * @param $name string
     * @return string|int
     */
    public static function getCookie($name)
    {
        return \Yii::$app->request->cookies->getValue($name);
    }

    /**
     * @param $name string
     */
    public static function removeCookie($name)
    {
        \Yii::$app->response->cookies->remove($name);
    }
}
