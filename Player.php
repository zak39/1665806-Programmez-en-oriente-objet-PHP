<?php

require_once('./User.php');

class Player extends User
{
    public function __construct(
        public string $email,
        public string $username,
        public string $status = self::STATUS_ACTIVE
    )
    {
        parent::__construct($email, $status);
    }

    public function getUsername(): string
    {
        return $this->username;
    }
}
