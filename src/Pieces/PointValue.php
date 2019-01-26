<?php

declare(strict_types=1);

namespace Grandmaster\Pieces;

/**
 * From Larry Kaufman: https://www.chessprogramming.org/Point_Value#cite_note-18
 */
interface PointValue
{
    public const PAWN = 100;
    public const KNIGHT = 350;
    public const BISHOP = 350;
    public const ROOK = 525;
    public const QUEEN = 1000;
    public const KING = 10000;
}
