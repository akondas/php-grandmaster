<?php

declare(strict_types=1);

namespace Grandmaster\Strategy;

use Grandmaster\Chessboard;
use Grandmaster\Search;
use Grandmaster\Strategy;

final class TreeSearch implements Strategy
{
    /**
     * @var Search
     */
    private $search;

    /**
     * @var Chessboard
     */
    private $board;

    public function __construct(Search $search, Chessboard $board)
    {
        $this->board = $board;
        $this->search = $search;
    }

    public function nextMove(string $state): ?string
    {
        $this->board->setState($state);

        return $this->search->bestMove($this->board);
    }
}
