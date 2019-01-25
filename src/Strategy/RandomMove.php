<?php

declare(strict_types=1);

namespace Grandmaster\Strategy;

use Grandmaster\Strategy;
use Ryanhs\Chess\Chess;

final class RandomMove implements Strategy
{
    /**
     * @var Chess
     */
    private $game;

    public function __construct(Chess $game)
    {
        $this->game = $game;
    }

    public function nextMove(string $state): ?string
    {
        $this->game->load($state);
        $moves = $this->game->moves();

        if(count($moves) === 0) {
            return null;
        }

        return $moves[array_rand($moves)];
    }
}
