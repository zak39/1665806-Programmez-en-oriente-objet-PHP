<?php

declare(strict_types=1);

class Tablier
{
    public function __construct(
        public float $longueur,
        public float $largeur)
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
     * Ici, on évite de copier le même en objet en demandant
     * à PHP de copier l'objet Tablier, mais de le cloner.
     * Quand on fait un "clone".
     * On peut jouer avec le var_dump.
     */
    public function __clone()
    {
        $this->tablier = clone $this->tablier;
    }
}

$pont1 = new Pont('Manhattan', new Tablier(600.0, 40.0));
// En clonant ici $pont1 et $pont2 partagent la même instance de
// Tablier. Il faudrait éviter ça.
$pont2 = clone $pont1;

var_dump(
    [
        'pont1' => $pont1,
        'pont2' => $pont2,
    ]
);