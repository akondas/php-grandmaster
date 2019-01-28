<?php

declare(strict_types=1);

namespace Grandmaster\Tests\Search;

use Grandmaster\Chessboard\ChessphpChessboard;
use Grandmaster\Evaluator\MaterialEvaluator;
use Grandmaster\Search\MinimaxSearch;
use PHPUnit\Framework\TestCase;

final class MinimaxSearchTest extends TestCase
{
    /**
     * @dataProvider stateDataProvider
     */
    public function testSearchNextMove(string $state, string $bestMove): void
    {
        $search = new MinimaxSearch(new MaterialEvaluator(), 1);
        $board = new ChessphpChessboard();
        $board->setState($state);

        self::assertEquals($bestMove, $search->bestMove($board));
    }

    public function stateDataProvider(): array
    {
        return [
            ['rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1', 'Nh3'],
            ['r1bq1b1r/ppp2kpp/2n5/3np3/2B5/5Q2/PPPP1PPP/RNB1K2R b KQ - 2 7', 'Ke7'],
        ];
    }
}
