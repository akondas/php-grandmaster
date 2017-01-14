<?php

declare(strict_types=1);

namespace Grandmaster\Pieces;

use Grandmaster\Piece;

class Queen implements Piece
{
    public function name(): string
    {
        return 'queen';
    }
}
