<?php

namespace TypesafeEnum\Test;

use TypesafeEnum\Enum;

class TemperatureExample extends Enum
{
    private $celsius;

    protected function __construct($value, $celsius)
    {
        parent::__construct($value);
        $this->celsius = $celsius;
    }

    public static function HOT()
    {
        return new TemperatureExample('hot', 40);
    }

    public static function COLD()
    {
        return new TemperatureExample('cold', 10);
    }

    public function isHot()
    {
        return $this->is('hot');
    }

    public function isCold()
    {
        return $this->is('cold');
    }

    /**
     * @return int
     */
    public function getCelsius()
    {
        return $this->celsius;
    }
}
