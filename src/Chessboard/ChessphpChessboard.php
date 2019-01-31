<?php

declare(strict_types=1);

namespace Grandmaster\Chessboard;

use Grandmaster\Chessboard;
use Grandmaster\Exception\InvalidFenException;
use Ryanhs\Chess\Chess;

final class ChessphpChessboard implements Chessboard
{
    /**
     * @var Chess
     */
    private $chess;

    /**
     * @var int
     */
    private $moveCount = 0;

    public function __construct()
    {
        $this->chess = new Chess();
    }

    public function setState(string $fen): void
    {
        if ($this->chess->load($fen) === false) {
            throw new InvalidFenException(sprintf('Given "%s" FEN is invalid', $fen));
        }
    }

    public function move(string $san): void
    {
        $this->chess->move($san);
        ++$this->moveCount;
    }

    public function undo(): void
    {
        $this->chess->undo();
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

    public function isWhiteTurn(): bool
    {
        return $this->chess->turn() === Chess::WHITE;
    }

    public function moveCount(): int
    {
        return $this->moveCount;
    }
}
