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
        $bestValue = $whiteTurn ? PHP_INT_MAX : PHP_INT_MIN;
        $bestMove = null;

        if (count($moves) === 0) {
            return null;
        }

        foreach ($moves as $san) {
            $board->move($san);
            $newValue = $this->minimax($this->depth - 1, $board);
            if ($whiteTurn ? $newValue < $bestValue : $newValue > $bestValue) {
                $bestMove = $san;
                $bestValue = $newValue;
            }
            $board->undo();
        }

        return $bestMove;
    }

    private function minimax(int $depth, Chessboard $board): int
    {
        $whiteTurn = $board->isWhiteTurn();

        if ($depth === 0) {
            return -$this->evaluator->evaluate($board);
        }

        if ($whiteTurn) {
            $bestValue = PHP_INT_MAX;
            foreach ($board->moves() as $san) {
                $board->move($san);
                $bestValue = min($bestValue, $this->minimax($depth - 1, $board));
                $board->undo();
            }
        } else {
            $bestValue = PHP_INT_MIN;
            foreach ($board->moves() as $san) {
                $board->move($san);
                $bestValue = max($bestValue, $this->minimax($depth - 1, $board));
                $board->undo();
            }
        }


        return $bestValue;
    }
}
