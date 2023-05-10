<?php

declare(strict_types=1);

class Pont
{
    private string $proprieteMasquee = 'Au bal !';

    /**
     * Permet de getter la propriete en faisant
     * -><NomDeLaPropriete> même si elle est en
     * private.
     */
    public function __get(string $name) {
        return $this->{$name};
    }

    /**
     * Permet de setter la propriete en faisant
     * "-><NomDeLaPropriete> = 'toto'" même si elle est en
     * private.
     */
    public function __set(string $name, $value): void {
        $this->{$name} = $value;
    }

    /**
     * Cette méthode est déclencher quand on fait un
     * isset() ou empty() permet de savoir si 
     * une propriété existe.
     */
    public function __isset(string $name): bool {
        return isset($this->{$name});
    }

    /**
     * Cette méthode est déclencher quand on fait un
     * unset() permet de supprimer une propriété.
     */
    public function __unset(string $name): void {
        unset($this->{$name});
    }
}

$pont = new Pont;
print($pont->proprieteMasquee . PHP_EOL);
// output: Au bal !
// Là c'est grace à __get

$pont->proprieteMasquee = 'masqué ohé ohé !';
echo($pont->proprieteMasquee.PHP_EOL);
// output: masqué ohé ohé 
// Là c'est grace à __set
