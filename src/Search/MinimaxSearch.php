<?php

declare(strict_types=1);

namespace Grandmaster\Search;

use Grandmaster\Chessboard;
use Grandmaster\Evaluator;
use Grandmaster\Search;

final class MinimaxSearch implements Search
{
    /**
     * @var Evaluator
     */
    private $evaluator;

    /**
     * @var int
     */
    private $depth;

    public function __construct(Evaluator $evaluator, int $depth)
    {
        $this->evaluator = $evaluator;
        $this->depth = $depth;
    }

    public function bestMove(Chessboard $board): ?string
    {
        // array_reverse forces to move pawns (instead rooks)
        $moves = array_reverse($board->moves());
        $whiteTurn = $board->isWhiteTurn();
        $bestValue = $whiteTurn ? 99999 : -99999;
        $bestMove = null;

        foreach ($moves as $san) {
            $board->move($san);
            $newValue = $this->minimax($this->depth - 1, -100000, 100000, $board);
            if ($whiteTurn ? $newValue < $bestValue : $newValue > $bestValue) {
                $bestMove = $san;
                $bestValue = $newValue;
            }
            $board->undo();
        }

        return $bestMove;
    }

    private function minimax(int $depth, int $alpha, int $beta, Chessboard $board): int
    {
        if ($depth === 0) {
            return -$this->evaluator->evaluate($board);
        }

        if ($board->isWhiteTurn()) {
            $bestValue = 99999;
            foreach ($board->moves() as $san) {
                $board->move($san);
                $bestValue = min($bestValue, $this->minimax($depth - 1, $alpha, $beta, $board));
                $board->undo();
                $beta = min($beta, $bestValue);
                if ($beta <= $alpha) {
                    return $bestValue;
                }
            }
        } else {
            $bestValue = -99999;
            foreach ($board->moves() as $san) {
                $board->move($san);
                $bestValue = max($bestValue, $this->minimax($depth - 1, $alpha, $beta, $board));
                $board->undo();
                $alpha = max($alpha, $bestValue);
                if ($beta <= $alpha) {
                    return $bestValue;
                }
            }
        }


        return $bestValue;
    }
}
