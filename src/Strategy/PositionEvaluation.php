<?php

declare(strict_types=1);

namespace Grandmaster\Strategy;

use Grandmaster\Chessboard;
use Grandmaster\Evaluator;
use Grandmaster\Strategy;

final class PositionEvaluation implements Strategy
{
    /**
     * @var Evaluator
     */
    private $evaluator;

    /**
     * @var Chessboard
     */
    private $board;

    public function __construct(Evaluator $evaluator, Chessboard $board)
    {
        $this->evaluator = $evaluator;
        $this->board = $board;
    }

    public function nextMove(string $state): ?string
    {
        $this->board->setState($state);
        $moves = $this->board->moves();
        $whiteTurn = $this->board->isWhiteTurn();
        $bestValue = $whiteTurn ? PHP_INT_MAX : PHP_INT_MIN;
        $bestMove = null;

        if (count($moves) === 0) {
            return null;
        }

        foreach ($moves as $san) {
            $this->board->move($san);
            $newValue = $this->evaluator->evaluate($this->board) * ($whiteTurn ? 1 : -1);
            if ($whiteTurn ? $newValue < $bestValue : $newValue > $bestValue) {
                $bestMove = $san;
                $bestValue = $newValue;
            }
            $this->board->undo();
        }

        return $bestMove;
    }
}
