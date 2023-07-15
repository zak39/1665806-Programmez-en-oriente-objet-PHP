<?php

declare(strict_types=1);

namespace App\Domain\Exceptions;

class NotEnoughPlayersException extends \LengthException
{
    public $message = 'Le nombre de joueurs est insuffisant pour créer une rencontre :(';
}
