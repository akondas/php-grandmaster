<?php

declare(strict_types=1);

namespace Grandmaster\Chessboard;

use Grandmaster\Chessboard;
use Ryanhs\Chess\Chess;

final class ChessphpChessboard implements Chessboard
{
    /**
     * @var Chess
     */
    private $chess;

    public function __construct()
    {
        $this->chess = new Chess();
    }

    public function setState(string $fen): void
    {
        $this->chess->load($fen);
    }

    /**
     * @return string[]
     */
    public function moves(): array
    {
        return $this->chess->moves();
    }

    public function board(): array
    {
        return $this->chess->export()->board;
    }
}
