<?php

declare (strict_types = 1);

namespace Grandmaster\Board;

use Grandmaster\Exception\BoardException;
use Grandmaster\Piece\Piece;

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
        if (isset($this->pieces[$square])) {
            throw BoardException::squareNotEmpty();
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
