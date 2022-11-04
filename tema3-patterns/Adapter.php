<?php

namespace App;


class Duck {

    public function quack() {
           echo "Quack <br>";
    }

    public function fly() {
           echo "I'm flying <br>";
    }
}

class Turkey {

    public function gobble() {
        echo "Gobble gobble <br>";
    }

    public function fly() {
        echo "I'm flying a short distance <br>";
    }
}

class TurkeyAdapter
{
    private $turkey;
    public function __construct(Turkey $turkey)
    {
        echo "The expected output is as follows:<br>";
        $this->turkey = $turkey;
    }

    public function quack() 
    {
        echo $this->turkey->gobble();
    }

    public function fly() 
    {
        for ($x=1; $x<=5; $x++){
            echo $this->turkey->fly();
        }
    }

}


function duck_interaction($duck) {
    $duck->quack();
    $duck->fly();
}

$duck = new Duck;
$turkey = new Turkey;
$turkey_adapter = new TurkeyAdapter($turkey);
echo "The Turkey says...<br>";
$turkey->gobble();
$turkey->fly();
echo "The Duck says...<br>";
duck_interaction($duck);
echo "The TurkeyAdapter says...<br>";
duck_interaction($turkey_adapter);