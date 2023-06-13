<?php

declare(strict_types=1);

abstract class User
{
    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';

    public function __construct(public string $email, public string $status = self::STATUS_ACTIVE)
    {
    }

    public function setStatus(string $status): void
    {
        assert(
            in_array($status, [self::STATUS_ACTIVE, self::STATUS_INACTIVE]),
            sprintf('Le status %s n\'est pas valide. Les status possibles sont : %s', $status, [self::STATUS_ACTIVE, self::STATUS_INACTIVE])
        );
    
        $this->status = $status;
    }
    
    public function getStatus(): string
    {
        return $this->status;
    }
    
    abstract public function getUsername(): string;
}

abstract class Player extends User
{
    // Ajout d'un tableau de roles pour affiner les droits des administrateurs :)
    public function __construct(string $email, public string $username, string $status = self::STATUS_ACTIVE)
    {
        parent::__construct($email, $status);
    }

    // ...
}

class QueuingPlayer extends Player
{
    public function getUsername(): string
    {
        return $this->username;
    }
}

$Qp = new QueuingPlayer('roland@gras.ros', 'Roland');
var_dump($Qp);