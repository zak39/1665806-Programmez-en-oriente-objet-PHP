<?php

declare(strict_types=1);

class Pont
{
    private string $proprieteMasquee = 'Au bal !';

    private function methodeMasquee()
    {
        return $this->proprieteMasquee;
    }

    /**
     * Permet d'accéder à une méthode private ou protected
     * ou qui n'a jamais été définie.
     * 
     */
    public function __call(string $name, array $arguments)
    {
        return $this->{$name}(...$arguments);
    }
}

print(new Pont)->methodeMasquee();
// Au bal !