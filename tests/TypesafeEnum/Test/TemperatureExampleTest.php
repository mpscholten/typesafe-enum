<?php

namespace TypesafeEnum\Test;

use PHPUnit\Framework\TestCase;

class TemperatureExampleTest extends TestCase
{
    public function testTemperatureHot()
    {
        $temperature = TemperatureExample::HOT();

        $this->assertTrue($temperature->isHot());
        $this->assertFalse($temperature->isCold());
        $this->assertEquals(40, $temperature->getCelsius());
    }

    public function testTemperatureCold()
    {
        $temperature = TemperatureExample::COLD();

        $this->assertTrue($temperature->isCold());
        $this->assertFalse($temperature->isHot());
        $this->assertEquals(10, $temperature->getCelsius());
    }
}
