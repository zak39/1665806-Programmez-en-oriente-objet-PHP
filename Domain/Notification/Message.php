<?php

declare(strict_types=1);


namespace Domain\Notification;

use Domain\Display\MessageInterface;
use Domain\User\User;

class Message implements MessageInterface {
    public function __construct(
        private User $author,
        private string $content
    ) { }

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
