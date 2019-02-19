<?php

declare(strict_types=1);

namespace Grandmaster\Search;

use Grandmaster\Chessboard;
use Grandmaster\Evaluator;
use Grandmaster\Search;

/**
 * Only for my blog post about chess AI, MinimaxSerach with alpha beta pruning is much faster
 */
final class MinimaxFullSearch implements Search
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

        if (\count($moves) === 1) {
            return reset($moves);
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
        if ($depth === 0) {
            return -$this->evaluator->evaluate($board);
        }

        if ($board->isWhiteTurn()) {
            $bestValue = 99999;
            foreach ($board->moves() as $san) {
                $board->move($san);
                $bestValue = min($bestValue, $this->minimax($depth - 1, $board));
                $board->undo();
            }
        } else {
            $bestValue = -99999;
            foreach ($board->moves() as $san) {
                $board->move($san);
                $bestValue = max($bestValue, $this->minimax($depth - 1, $board));
                $board->undo();
            }
        }

        return $bestValue;
    }
}
