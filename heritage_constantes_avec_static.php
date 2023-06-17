<?php

declare(strict_types=1);

abstract class User
{
    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';
    public const DelayConnection = 100;

    public function __construct(public string $email,
        public string $status = self::STATUS_ACTIVE,
        public int $delay = self::DelayConnection)
    {
    }

    public function setStatus(string $status): void
    {
        assert(
            in_array(
                $status,
                [ static::STATUS_INACTIVE, static::STATUS_INACTIVE ]
            ),
            sprintf(
                'Le status %s n\'est pas valide. Les status posibles sont : %s',
                $status,
                implode(', ', [ static::STATUS_ACTIVE, static::STATUS_INACTIVE])
            )            
        );

        $this->status = $status;
    }

    public function setDelayConnection(int $delay): void {
        assert(
            in_array(
                $delay,
                [ static::DelayConnection ]
            ),
            sprintf(
                'Le delai %s n\'est pas valide. Les delais posibles sont : %s',
                $delay,
                implode(', ', [ static::DelayConnection ])
            )            
        );

        $this->delay = $delay;
    }

    public function getDelayConnection(): int {
        return $this->delay;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    abstract public function getUsername(): string;
}

final class Admin extends User
{
    public const STATUS_ACTIVE = 'is_active';
    public const STATUS_INACTIVE = 'is_inactive';
    public const DelayConnection = 200;

    // Ajout d'un tableau de roles pour affiner les droits des administrateurs :)
    public function __construct(string $email,
        string $status = self::STATUS_ACTIVE,
        int $delay = self::DelayConnection,
        public array $roles = [])
    {
        parent::__construct($email, $status, $delay);
    }

    public function getUsername(): string
    {
        return $this->email;
    }
}

$admin = new Admin('michel@petrucciani.com');
var_dump($admin);
$admin->setStatus(Admin::STATUS_INACTIVE);
var_dump($admin);
$admin->setDelayConnection(Admin::DelayConnection);
