<?php

declare(strict_types=1);

require_once('./User.php');

class Admin extends User
{
    public static $nombreAdminInitialises = 0;
    public const STATUS_LOCKED = 'locked';
    
    public function printStatusFromParent()
    {
        // vous pouvez accéder au status comme si la propriété appartenait à Admin :)
        print($this->status);
    }

    public static function nouvelleInitialisation()
    {
        self::$nombreAdminInitialises++; // classe Admin
        parent::$nombreUtilisateursInitialises++; // class User
    }

    public function printCustomStatus()
    {
        print("L'administrateur {$this->username} a pour status : ");
        $this->printStatus(); // on appelle printStatus du parent depuis la classe enfant
    }

    // La méthode est entièrement réécrite ici :)
    // Seule la signature reste inchangée.
    public function setStatus(string $status): void
    {
        if (!in_array($status, [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_LOCKED])) {
            trigger_error(
                sprintf(
                    'Le status %s n\'est pas valide. Les status possibles sont : %s',
                    $status,
                    implode(', ', [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_LOCKED])
                ), E_USER_ERROR
            );
        }

        $this->status = $status;
    }

    // La méthode utilisée celle de la classe parente, puis
    // ajoute un comportement :)
    public function getStatus(): string
    {
        return strtoupper(parent::getStatus());
    }
}
