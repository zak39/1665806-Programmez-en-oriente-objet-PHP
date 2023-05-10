<?php

declare(strict_types=1);

class Tablier
{
    public function __construct(
        public float $longueur,
        public float $largeur
    )
    {
    }
}

class Pont
{
    public function __construct(
        protected string $name,
        protected Tablier $tablier)
    {

    }

    /**
     * Quand on utilise "serialize()", on va exécuter le code
     * dans __sleep() et on lui return un tableau avec les
     * propriétées qu'on souhaite serialize.
     */
    public function __sleep()
    {
        return ['name'];
    }
}

$pont = new Pont('Manhattan', new Tablier(600.0, 40.0));
$chaine = serialize($pont);

// Sans sleep
// echo($chaine . PHP_EOL);
// output: O:4:"Pont":2:{s:7:"*name";s:9:"Manhattan";s:10:"*tablier";O:7:"Tablier":2:{s:8:"longueur";d:600;s:7:"largeur";d:40;}}

// Avec sleep
echo($chaine . PHP_EOL);
// output: O:4:"Pont":1:{s:7:"*name";s:9:"Manhattan";}