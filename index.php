<?php

class Encounter
{
    public const RESULT_WINNER = 1;
    public const RESULT_LOSER = -1;
    public const RESULT_DRAW = 0;
    public const RESULT_POSSIBILITIES = [self::RESULT_WINNER, self::RESULT_LOSER, self::RESULT_DRAW];

    public static function probabilityAgainst(Player $playerOne, Player $playerTwo): float
    {
        return 1/(1+(10 ** (($playerTwo->level - $playerOne->level)/400)));
    }

    public static function setNewLevel(Player $playerOne, Player $playerTwo, int $playerOneResult): void
    {
        if (!in_array($playerOneResult, self::RESULT_POSSIBILITIES)) {
            trigger_error(sprintf('Invalid result. Expected %s',implode(' or ', self::RESULT_POSSIBILITIES)));
        }

        $playerOne->level += round(32 * ($playerOneResult - self::probabilityAgainst($playerOne, $playerTwo)));
    }
}

class Player
{
    public function __construct(private int $level)
    {
    }

    public function __set($name, $value): void
    {
        $this->{$name} = $value;
    }

    public function __get($name): mixed
    {
        return $this->{$name};
    }
}

$greg = new Player(400);
$jade = new Player(800);

echo sprintf(
        'Greg à %.2f%% chance de gagner face a Jade',
        Encounter::probabilityAgainst($greg, $jade)*100
    ).PHP_EOL;

// Imaginons que greg l'emporte tout de même.
Encounter::setNewLevel($greg, $jade, Encounter::RESULT_WINNER);
Encounter::setNewLevel($jade, $greg, Encounter::RESULT_LOSER);

echo sprintf(
    'les niveaux des joueurs ont évolués vers %s pour Greg et %s pour Jade',
    $greg->level,
    $jade->level
);

exit(0);
