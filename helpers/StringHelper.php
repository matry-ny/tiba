<?php

namespace app\helpers;

use yii\helpers\BaseStringHelper;

/**
 * Class StringHelper
 * @package app\helpers
 */
class StringHelper extends BaseStringHelper
{
    /**
     * @var string
     */
    private $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789';

    /**
     * @param int $length
     * @return string
     */
    public function random($length = 10)
    {
        $letters = strlen($this->alphabet) - 1;
        $code = '';

        while (strlen($code) < $length) {
            $code .= $this->alphabet[mt_rand(0, $letters)];
        }

        return $code;
    }
}
