<?php

namespace TypesafeEnum;

/**
 * Representing enum values, e.g. types, while providing type safety.
 * Use plain strings to represent values (not `private static`s or `const`s).
 *
 * Example:
 *      
 *      class Temperature extends \TypesafeEnum\Enum
 *      {
 *          private $celsius;
 *
 *          protected function __construct($value, $celsius)
 *          {
 *              parent::__construct($value);
 *              $this->celsius = $celsius;
 *          }
 *
 *          public static function HOT()
 *          {
 *              return new Temperature('hot', 40);
 *          }
 *
 *          public static function COLD()
 *          {
 *              return new Temperature('cold', 10);
 *          }
 *
 *          public function isHot()
 *          {
 *              return $this->is('hot');
 *          }
 *
 *          public function isCold()
 *          {
 *              return $this->is('cold');
 *          }
 *
 *          public function getCelsius()
 *          {
 *              return $this->celsius;
 *          }
 *      }
 *
 *      $temperature = Temperature::HOT();
 *      $temperature->isHot();
 *      $temperature->getCelsius();
 *
 *      function newDay(Temperature $temperature) {} // Use type hints to provide type safety and auto completion
 */
abstract class Enum
{
    /**
     * @var mixed Internal representation of the current enum value
     */
    protected $value;

    protected function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return string Returns the string representation of the current enum value
     */
    public function __toString()
    {
        return (string) $this->value;
    }

    /**
     * @param $value mixed
     *
     * @return bool Returns true if `$value` is the internal representation of the current enum value, false otherwise
     */
    protected function is($value)
    {
        return $this->value === $value;
    }
}

