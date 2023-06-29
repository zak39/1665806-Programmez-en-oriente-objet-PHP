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

namespace App\MatchMaker;

use App\MatchMaker\Player\Player;
use App\MatchMaker\Player\PlayerInterface;
use App\MatchMaker\Player\QueuingPlayer;
use App\MatchMaker\Player\QueuingPlayerInterface;
use Exception;

class Lobby implements LobbyInterface
{
    /** @var array<QueuingPlayerInterface> */
    public array $queuingPlayers = [];

    public function findOponents(QueuingPlayerInterface $player): array
    {
        $minLevel = round($player->getRatio() / 100);
        $maxLevel = $minLevel + $player->getRange();

        return array_filter($this->queuingPlayers, static function (QueuingPlayerInterface $potentialOponent) use ($minLevel, $maxLevel, $player) {
            $playerLevel = round($potentialOponent->getRatio() / 100);

            return $player !== $potentialOponent && ($minLevel <= $playerLevel) && ($playerLevel <= $maxLevel);
        });
    }

    public function addPlayer(PlayerInterface $player): void
    {
        $this->queuingPlayers[] = new QueuingPlayer($player);
    }

    public function addPlayers(PlayerInterface ...$players): void
    {
        foreach ($players as $player) {
            $this->addPlayer($player);
        }
    }

    public function isInLobby(PlayerInterface $player): QueuingPlayer
    {
        if (!$this->isPlaying($player)) {
            throw new Exception('Your player is not present in the queuing !');
        }

        return $this->queuingPlayers[$player];
    }

    public function isPlaying(PlayerInterface $player): bool
    {
        return in_array($player, $this->queuingPlayers);
    }

    public function removePlayer(PlayerInterface $player): void
    {
        if ($this->isPlaying($player)) {
            $index = array_search($player, $this->queuingPlayers);
            unset($this->queuingPlayers[$index]);
        }
    }
}
