<?php

declare(strict_types=1);

namespace App\Domain\Exceptions;

class NotFoundPlayersException extends \RuntimeException
{
    public $message = "Ce joueur ne se trouve pas dans le lobby";
    public $code = E_USER_ERROR;
}
