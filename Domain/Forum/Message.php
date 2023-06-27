<?php

declare(strict_types=1);

namespace Domain\Forum;

use Domain\User\User;

class Message
{
    public function __construct(private User $author, private string $content)
    {
    }
}
