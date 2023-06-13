<?php

require_once('./User.php');

final class Admin extends User
{
    // Ajout d'un tableau de roles pour affiner les droits administrateurs :)
    public function __construct(
        public string $email,
        public string $status = self::STATUS_ACTIVE,
        public array $roles = []
    )
    {
        parent::__construct($email, $status);
    }

    public function getUsername(): string
    {
        return $this->email;
    }
}