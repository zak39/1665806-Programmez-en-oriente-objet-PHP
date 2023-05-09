<?php

declare(strict_types=1);

class Pont
{
    // $unite ne sert que dans la class, on met cette proprété en privée.
    private const UNITE = "m²";
    
    private float $longueur;
    private float $largeur;

    // Définition de la propriété statique. Elle sera partagée.
    public static int $nombrePietons = 0;

    // Je laisse volontairement la méthode non statique.
    // Seule la référence à la proprété est importante.
    public function nouveauPieton() {
        // Mise à jour de la propriété statique.
        self::$nombrePietons++;
    }

    public static function validerTaille(float $taille): bool {
        if ($taille < 50.0) {
            trigger_error(
                'La taille est trop courte. (min 50m).',
                E_USER_ERROR
            );
        }

        return true;
    }

    public function setLongueur(float $longueur): void {
        self::validerTaille($longueur);

        $this->longueur = $longueur;
    }

    public function setLargeur(float $largeur): void {
        self::validerTaille($largeur);

        $this->largeur = $largeur;
    }

    public function getLargeur(): float {
        return $this->largeur;
    }
    
    public function getLongueur(): float {
        return $this->longueur;
    }
    
    public function getSurface(): string
    {
        // on renvoie l'unité en plus de la surface.
        return ($this->longueur * $this->largeur) . self::UNITE;
    }
}

$towerBridge = new Pont();
$towerBridge->setLongueur(286.0);
$towerBridge->setLargeur(50.0);
print($towerBridge->getSurface() . PHP_EOL);

$pontLondres = new Pont();
$pontLondres->nouveauPieton();

$pointManhattan = new Pont();
$pointManhattan->nouveauPieton();

// Retourne 2
print(Pont::$nombrePietons . PHP_EOL);
