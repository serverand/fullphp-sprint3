<?php

namespace App;

class Tigger
{
    private static $instances = [];
    private $counter = 0;

    protected function __construct() {
        echo "Building character...<br>";
    }

    protected function __clone() { }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): Tigger
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function roar()
    {
        $this->counter++;
        return "Grrr!<br>";
    }

    public function getCounter (): int
    {
        return $this->counter;
    }
}



$l1 = Tigger::getInstance();
$l2 = Tigger::getInstance();
if ($l1 === $l2) {
    echo $l1->roar();
    echo $l1->roar();
    echo $l1->roar();
    echo $l1->roar();
    echo $l1->roar();
    echo $l1->getCounter();
} else {
    echo "Loggers are different.";
}