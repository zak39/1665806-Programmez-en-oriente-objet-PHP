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
     * Avant de serialize(), php va transformer l'objet en
     * un tableau.
     */
   public function __serialize(): array
   {
        return [
            'name' => $this->name,
            'largeur' => $this->tablier->largeur,
            'longueur' => $this->tablier->longueur
        ];
   }

   /**
    * Au moment de faire unserialize(), on transforme le tableau
    * en objet.
    */
   public function __unserialize(array $data): void
   {
        $this->name = $data['name'];
        $this->tablier = new Tablier(
            $data['largeur'],
            $data['longueur']
        );
   }
}

$pont = new Pont('Manhattan', new Tablier(600.0, 40.0));

$chaine = serialize($pont);
print($chaine . PHP_EOL);
// Output: O:4:"Pont":3:{s:4:"name";s:9:"Manhattan";s:7:"largeur";d:40;s:8:"longueur";d:600;}

$pont2 = unserialize($chaine, [
    'allowed_classes' => [
        Pont::class,
        Tablier::class
    ]
]);
var_dump($pont2);
/**
 * Output:
 * 
 * object(Pont)#4 (3) {
 *  ["size"]=>
 *  NULL
 *  ["name":protected]=>
 *  string(9) "Manhattan"
 *  ["tablier":protected]=>
 *  object(Tablier)#5 (2) {
 *    ["longueur"]=>
 *    float(40)
 *    ["largeur"]=>
 *    float(600)
 *  }
 *}
 */