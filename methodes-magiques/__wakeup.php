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
    public $size = null;
    
    public function __construct(
        protected string $name,
        protected Tablier $tablier)
    {
        $this->size = fn() => $this->tablier->largeur * $this->tablier->longueur;
    }

    /**
     * Quand on utilise "serialize()", on va exécuter le code
     * dans __sleep() et on lui return un tableau avec les
     * propriétées qu'on souhaite serialize.
     */
    public function __sleep()
    {
        return ['name', 'tablier'];
    }

    /**
     * A l'inverse de __sleep(). __wakeup() est utilisé lorsqu'on
     * veut unserialize().
     * On transforme notre une chaine de caractère en objet.
     */
    public function __wakeup()
    {
        $this->size = fn() => $this->tablier->largeur * $this->longueur;
    }
}

$pont = new Pont('Manhattan', new Tablier(600.0, 40.0));

$chaine = serialize($pont);
// output: O:4:"Pont":2:{s:7:"*name";s:9:"Manhattan";s:10:"*tablier";O:7:"Tablier":2:{s:8:"longueur";d:600;s:7:"largeur";d:40;}}

$pont2 = unserialize($chaine, [
    'allowed_classes' => [
        Pont::class,
        Tablier::class
    ]
]);

var_dump($pont2);
/**
 * object(Pont)#4 (3) {
 *  ["size"]=>
 *  object(Closure)#6 (1) {
 *    ["this"]=>
 *    *RECURSION*
 *  }
 *  ["name":protected]=>
 *  string(9) "Manhattan"
 *  ["tablier":protected]=>
 *  object(Tablier)#5 (2) {
 *    ["longueur"]=>
 *    float(600)
 *    ["largeur"]=>
 *    float(40)
 *  }
 *}
*/
