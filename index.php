<?php

/*
 * This file is part of the OpenClassRoom PHP Object Course.
 *
 * (c) Grégoire Hébert <contact@gheb.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\MatchMaker {

    use App\MatchMaker\Player\Player;
    use App\MatchMaker\Player\Queuing;

    class Lobby
    {
        /** @var array<Queuing> */
        public array $queuings = [];

        public function findOponents(Queuing $player): array
        {
            $minLevel = round($player->getRatio() / 100);
            $maxLevel = $minLevel + $player->getRange();

            return array_filter($this->queuings, static function (Queuing $potentialOponent) use ($minLevel, $maxLevel, $player) {
                $playerLevel = round($potentialOponent->getRatio() / 100);

                return $player !== $potentialOponent && ($minLevel <= $playerLevel) && ($playerLevel <= $maxLevel);
            });
        }

        public function addPlayer(Player $player): void
        {
            $this->queuings[] = new Queuing($player);
        }

        public function addPlayers(Player ...$players): void
        {
            foreach ($players as $player) {
                $this->addPlayer($player);
            }
        }
    }
}

namespace App\MatchMaker\Player {

    abstract class AbstractPlayer
    {
        public function __construct(public string $name = 'anonymous', public float $ratio = 400.0)
        {
        }

        abstract public function getName(): string;

        abstract public function getRatio(): float;

        abstract protected function probabilityAgainst(self $player): float;

        abstract public function updateRatioAgainst(self $player, int $result): void;
    }

    class Player extends AbstractPlayer
    {
        public function getName(): string
        {
            return $this->name;
        }

        protected function probabilityAgainst(AbstractPlayer $player): float
        {
            return 1 / (1 + (10 ** (($player->getRatio() - $this->getRatio()) / 400)));
        }

        public function updateRatioAgainst(AbstractPlayer $player, int $result): void
        {
            $this->ratio += 32 * ($result - $this->probabilityAgainst($player));
        }

        public function getRatio(): float
        {
            return $this->ratio;
        }
    }

    class Queuing extends Player
    {
        public function __construct(AbstractPlayer $player, protected int $range = 1)
        {
            parent::__construct($player->getName(), $player->getRatio());
        }

        public function getRange(): int
        {
            return $this->range;
        }

        public function upgradeRange(): void
        {
            $this->range = min($this->range + 1, 40);
        }
    }

    class Blitz extends Player
    {
        public function __construct(public string $name = 'anonymous', public float $ratio = 1200.0)
        {
            parent::__construct($name, $ratio);
        }

        public function updateRatioAgainst(AbstractPlayer $player, int $result): void
        {
            $this->ratio += 128 * ($result - $this->probabilityAgainst($player));
        }
    }
}

namespace {

    use App\MatchMaker\Lobby;
    use App\MatchMaker\Player\Blitz;

    $greg = new Blitz('greg');
    $jade = new Blitz('jade');

    $lobby = new Lobby();
    $lobby->addPlayers($greg, $jade);

    var_dump($lobby->findOponents($lobby->queuings[0]));

    exit(0);
}