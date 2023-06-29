<?php

declare(strict_types=1);

namespace App\MatchMaker\Player;

interface PlayerInterface
{
    public function getName(): string;
    public function getRatio(): float;
}