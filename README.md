TypesafeEnum
============
[![Latest Stable Version](https://poser.pugx.org/mpscholten/typesafe-enum/version)](https://packagist.org/packages/mpscholten/typesafe-enum) [![License](https://poser.pugx.org/mpscholten/typesafe-enum/license)](https://packagist.org/packages/mpscholten/typesafe-enum) [![Circle CI](https://circleci.com/gh/mpscholten/typesafe-enum.svg?style=shield)](https://circleci.com/gh/mpscholten/typesafe-enum)

A lightweight, type safe enum library for PHP.

Use it to provide safe enums with autocompletion support. Fits well in domain driven designed applications.

### Get started ###

Install via composer
    
    composer install mpscholten/typesafe-enum

### Basic Usage ###

```php
class UserType extends \TypesafeEnum\Enum
{
    public static function PAID()
    {
        return new UserType('paid');
    }

    public static function FREE()
    {
        return new UserType('free');
    }

    public function isPaid()
    {
        return $this->is('paid');
    }

    public function isFree()
    {
        return $this->is('free');
    }
}

class User
{
    public function __construct($email, UserType $type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }
}

$user = new User('hello@example.com', UserType::PAID()); // Good
$user->getType()->isPaid(); // true
$user->getType()->isFree(); // false
(string) $user->getType(); // "paid"

$user = new User('hello@example.com', UserType::FREE()); // Good
$user->getType()->isFree(); // true
$user->getType()->isPaid(); // false
(string) $user->getType(); // "free"

$user = new User('hello@example.com', 'some string'); // Type error (PHP Catchable fatal error:  Argument 2 passed to User::__construct() must be an instance of UserType, integer given, called in ...)
$user = new User('hello@example.com', null); // Type error (PHP Catchable fatal error:  Argument 2 passed to User::__construct() must be an instance of UserType, null given, called in ...)

```

### Extended Usage ###

```php
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

$temperature = Temperature::HOT();
$temperature->isHot(); // true
$temperature->isCold(); // false
$temperature->getCelsius(); // 40
(string) $temperature; // "hot"

$temperature = Temperature::COLD();
$temperature->isCold(); // true
$temperature->isHot(); // false
$temperature->getCelsius(); // 10
(string) $temperature; // "cold"
```

### Usage with doctrine2 ###

You can use this library together with doctrine2 by using so called [embeddables](http://doctrine-orm.readthedocs.org/en/latest/tutorials/embeddables.html):

```php
/** @Embeddable */
class UserType extends \TypesafeEnum\Enum
{
    /** @Column(type = "smallint", name = "type") */
    protected $value; // Override the `$value` property of \TypesafeEnum\Enum and apply mapping

    public static function PAID()
    {
        return new UserType(0);
    }

    public static function FREE()
    {
        return new UserType(1);
    }

    public function isPaid()
    {
        return $this->is(0);
    }

    public function isFree()
    {
        return $this->is(1);
    }
}

class User
{
    /** @Embedded(class = "UserType", columnPrefix = false) */
    private $type;

    public function __construct($email, UserType $type)
    {
        $this->type = $type;
    }
}
```

### Tests ###

You can run the `phpunit` suite with `make`

    make tests

### Contributing ###

Feel free to send pull requests!
