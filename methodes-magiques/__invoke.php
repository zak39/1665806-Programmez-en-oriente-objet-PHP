<?php

declare(strict_types=1);

class Majuscule
{
    /**
     * Permet d'utiliser la classe comme une fonction.
     */
    public function __invoke(string $chaine): string
    {
        return strToUpper($chaine);
    }
}

$enMajuscule = new Majuscule;
print($enMajuscule('chaine en minuscule'));

var_dump($enMajuscule);

class StartWith
{
    public function __construct(
        private string $startWith
    )
    {
    }

    public function __invoke(string $chaine): bool
    {
        return str_starts_with($chaine, $this->startWith);
    }
}

/**
 * Cas d'utilisation : Filtrer un tableau en passant par un objet et non
 * par l'utilisation d'une fonction.
 */
var_dump(
    array_filter(
        [
            'Globule',
            'Plante',
            'Garage',
            'Livre',
            'Good Omens',
        ],
        new StartWith('G')
    )
);

/**
* array(3) {
*     [0]=>
*     string(7) "Globule"
*     [2]=>
*     string(6) "Garage"
*     [4]=>
*     string(10) "Good Omens"
*   }
*/