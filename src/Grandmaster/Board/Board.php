<?php

declare(strict_types=1);

namespace Grandmaster\Board;

use Grandmaster\Exception\BoardException;
use Grandmaster\Piece;

class Board
{
    /*
     * @var array
     */
    public $pieces;

    /**
     * @param Piece  $piece
     * @param Square $square
     *
     * @throws BoardException
     */
    public function addPiece(Piece $piece, Square $square)
    {
        if (isset($this->pieces[(string) $square])) {
            throw BoardException::squareNotEmpty((string) $square);
        }

        $this->pieces[(string) $square] = $piece;
    }

    /**
     * @return array
     */
    public function getPieces()
    {
        return $this->pieces;
    }
}
