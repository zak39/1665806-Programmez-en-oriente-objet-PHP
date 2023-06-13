<?php

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
            sprintf('Le status %s n\'est pas valide. Les status possibles sont : %s', $status, implode(', ',[self::STATUS_ACTIVE, self::STATUS_INACTIVE]))
        );
    
        $this->status = $status;
    }
    
    public function getStatus(): string
    {
        return $this->status;
    }

    abstract public function getUsername(): string;
}
