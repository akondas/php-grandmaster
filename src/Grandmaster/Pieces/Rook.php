<?php

declare (strict_types = 1);

namespace Grandmaster\Pieces;

use Grandmaster\Piece;

class Rook implements Piece
{
    public function name(): string
    {
        return 'rook';
    }
}
