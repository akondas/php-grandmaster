<?php

declare(strict_types=1);

namespace Grandmaster\Tests\Evaluator;

use Grandmaster\Chessboard\ChessphpChessboard;
use Grandmaster\Evaluator\PositionEvaluator;
use PHPUnit\Framework\TestCase;

final class PositionEvaluatorTest extends TestCase
{
    /**
     * @dataProvider stateDataProvider
     */
    public function testPositionEvaluation(string $state, int $value): void
    {
        $board = new ChessphpChessboard();
        $board->setState($state);

        $evaluator = new PositionEvaluator();

        self::assertEquals($value, $evaluator->evaluate($board));
    }

    public function stateDataProvider(): array
    {
        return [
            ['rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1', -190],
            ['r1bq1b1r/ppp2kpp/2n5/3np3/2B5/5Q2/PPPP1PPP/RNB1K2R b KQ - 2 7', 60],
        ];
    }
}
