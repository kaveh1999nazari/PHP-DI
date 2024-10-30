<?php

require __DIR__ . '/vendor/autoload.php';

use DI\ContainerBuilder;

use function DI\create;
use function DI\get;

Interface Human {
    public function breath();
    public function speak();
}

class PersonManager {
    function __construct(protected readonly Human $human){}

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
        return "Person 1 : breath";
    }

    public function speak()
    {
        return "person 1 : speak";
    }
}

class PersonTwo implements Human {

    public function breath()
    {
        return "Person 2 : breath";
    }

    public function speak()
    {
        return "Person 2 : speak";
    }
}


$builder = new ContainerBuilder();
$builder->addDefinitions([
    "pm" => create(PersonManager::class)->constructor(get("PersonOne")),
    "PersonOne" => create(PersonOne::class)
]);

$container = $builder->build();

$person = $container->get("pm");

echo $person->air() . "\n";
echo $person->connect();