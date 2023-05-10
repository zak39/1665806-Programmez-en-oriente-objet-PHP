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

    public function __toString(): string
    {
        return sprintf(
            'Ce pont mesure %d de long pour %d de large',
            $this->tablier->longueur,
            $this->tablier->largeur,
        );
    }
}

$pont = new Pont('Manhattan', new Tablier(600.0, 40.0));
print($pont . PHP_EOL);
