<?php

use DI\ContainerBuilder;
use function DI\create;
use function DI\get;
use function DI\autowire;

require "./vendor/autoload.php";

// Interface
interface Human {
    public function speak();
    public function breath();
}

class PersonManager {
    function __construct(protected Human $human){}

    public function connect()
    {
        return $this->human->speak();
    }

    public function air()
    {
        return $this->human->breath();
    }
}


class PersonOne implements Human {

    public function breath()
    {
        return "Person 1 : Breath";
    }

    public function speak()
    {
        return "Person 1 : Speak";
    }
}


class PersonTwo implements Human {

    public function breath()
    {
        return "Person 2 : Breath";
    }

    public function speak()
    {
        return "Person 2 : Speak";
    }
}


$builder = new ContainerBuilder();
$builder->useAutowiring(true);
$builder->addDefinitions([
    'pm' => autowire(PersonManager::class),
    Human::class => create(className: PersonOne::class), 
]);
$container = $builder->build();



$person = $container->get('pm');
echo $person->air() . "\n";
echo $person->connect();

