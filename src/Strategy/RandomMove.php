<?php

declare(strict_types=1);

namespace Grandmaster\Strategy;

use Grandmaster\Chessboard;
use Grandmaster\Strategy;

final class RandomMove implements Strategy
{
    /**
     * @var Chessboard
     */
    private $board;

    public function __construct(Chessboard $board)
    {
        $this->board = $board;
    }

    public function nextMove(string $state): ?string
    {
        $this->board->state($state);
        $moves = $this->board->moves();

        if (count($moves) === 0) {
            return null;
        }

        return $moves[array_rand($moves)];
    }
}
