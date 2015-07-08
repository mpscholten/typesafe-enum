<?php

namespace TypesafeEnum\Test;

use TypesafeEnum\Enum;

class TemperatureExampleTest extends \PHPUnit_Framework_TestCase
{
    public function testTemperatureHot()
    {
        $temperature = Temperature::HOT();

        $this->assertTrue($temperature->isHot());
        $this->assertFalse($temperature->isCold());
        $this->assertEquals(40, $temperature->getCelsius());
    }

    public function testTemperatureCold()
    {
        $temperature = Temperature::COLD();

        $this->assertTrue($temperature->isCold());
        $this->assertFalse($temperature->isHot());
        $this->assertEquals(10, $temperature->getCelsius());
    }
}

class Temperature extends Enum
{
    private $celsius;

    protected function __construct($value, $celsius)
    {
        parent::__construct($value);
        $this->celsius = $celsius;
    }

    public static function HOT()
    {
        return new Temperature('hot', 40);
    }

    public static function COLD()
    {
        return new Temperature('cold', 10);
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
