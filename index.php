<?php

declare(strict_types=1);

class Pont
{
    // $unite ne sert que dans la class, on met cette proprété en privée.
    private string $unite = "m²";
    
    private float $longueur;
    private float $largeur;

    public function setLongueur(float $longueur): void {
        if ($longueur < 0) {
            trigger_error(
                'La longueur est trop courte. (min 1)',
                E_USER_ERROR
            );
        }

        $this->longueur = $longueur;
    }

    public function setLargeur(float $largeur): void {
        if ($largeur < 0) {
            trigger_error(
                'La largeur est trop courte. (min 1)',
                E_USER_ERROR
            );
        }

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
        return ($this->longueur * $this->largeur) . $this->unite;
    }
}

$towerBridge = new Pont();
$towerBridge->setLongueur(286.0);
$towerBridge->setLargeur(15.0);

print($towerBridge->getSurface() . PHP_EOL);
