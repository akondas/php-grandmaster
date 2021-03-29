<?php

declare(strict_types=1);

namespace Grandmaster\Evaluator;

use Grandmaster\Chessboard;
use Grandmaster\Evaluator;
use Grandmaster\Pieces\PositionValue;

final class PositionEvaluator implements Evaluator
{
    public function evaluate(Chessboard $board): int
    {
        // array_reduce is cleaner, but performance is the key here
        $sum = 0;

        foreach ($board->board() as $index => $piece) {
            $sum += $this->getPieceValue($index, $piece);
        }

        return $sum;
    }

    private function getPieceValue(int $index, ?array $piece): int
    {
        if ($piece === null) {
            return 0;
        }

        $i = (int) floor($index / 16);
        $j = $index % 16;
        $isWhite = $piece['color'] === 'w';

        switch ($piece['type']) {
            case 'p':
                return $isWhite ? PositionValue::PAWN_WHITE[$i][$j] : PositionValue::PAWN_BLACK[$i][$j];
            case 'r':
                return $isWhite ? PositionValue::ROOK_WHITE[$i][$j] : PositionValue::ROOK_BLACK[$i][$j];
            case 'n':
                return $isWhite ? PositionValue::KNIGHT_WHITE[$i][$j] : PositionValue::KNIGHT_BLACK[$i][$j];
            case 'b':
                return $isWhite ? PositionValue::BISHOP_WHITE[$i][$j] : PositionValue::BISHOP_BLACK[$i][$j];
            case 'q':
                return $isWhite ? PositionValue::QUEEN_WHITE[$i][$j] : PositionValue::QUEEN_BLACK[$i][$j];
            case 'k':
                return $isWhite ? PositionValue::KING_WHITE[$i][$j] : PositionValue::KING_BLACK[$i][$j];
            default:
                return 0;
        }
    }
}
