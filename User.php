<?php

class User
{
    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';

    public static $nombreUtilisateursInitialises = 0;
    
    public function __construct(public string $username,
        public string $status = self::STATUS_ACTIVE)
    {
    }

    public function printStatus()
    {
        print($this->status);
    }

    public function setStatus(string $status): void
    {
        if (!in_array($status, [self::STATUS_ACTIVE, self::STATUS_INACTIVE])) {
            trigger_error(
                sprintf(
                    'Le status %s n\'est pas valide. Les status possibles sont : %s',
                    $status,
                    implode(', ', [self::STATUS_ACTIVE, self::STATUS_INACTIVE])
                ), E_USER_ERROR
            );
        }

        $this->status = $status;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
