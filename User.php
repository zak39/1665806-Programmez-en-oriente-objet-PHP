<?php

class User
{
    protected const STATUS_ACTIVE = 'active';
    protected const STATUS_INACTIVE = 'inactive';
  
    public function __construct(protected string $username,
        protected string $status = self::STATUS_ACTIVE)
    {
    }

    protected function setStatus(string $status): void
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

    protected function getStatus(): string
    {
        return $this->status;
    }
}
