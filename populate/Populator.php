<?php

namespace app\populate;

/**
 * Class Populator
 * @package app\populate
 */
class Populator
{
    /**
     * @var array
     */
    private $data;

    /**
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    /**
     * @param string $key
     * @param null $defaultValue
     * @return mixed
     */
    public function getValue($key, $defaultValue = null)
    {
        return isset($this->data[$key]) ? $this->data[$key] : $defaultValue;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function setValue($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}
