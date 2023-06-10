<?php

declare(strict_types=1);

require_once('./User.php');

class Admin extends User
{
    public const STATUS_LOCKED = 'locked';
    
    // La méthode est entièrement ré-écrite ici :)
    // Seule la signature reste inchangée
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
