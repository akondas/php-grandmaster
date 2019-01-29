<?php

declare(strict_types=1);

namespace Grandmaster\Benchmarks\Search;

use Grandmaster\Chessboard\ChessphpChessboard;
use Grandmaster\Evaluator\MaterialEvaluator;
use Grandmaster\Search\MinimaxSearch;
use PhpBench\Benchmark\Metadata\Annotations\BeforeMethods;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

/**
 * @BeforeMethods({"init"})
 */
final class MinimaxSearchBench
{
    /**
     * @var MinimaxSearch
     */
    private $search;

    public function init(): void
    {
        $this->search = new MinimaxSearch(new MaterialEvaluator(), 2);
    }

    /**
     * @Revs(100)
     * @Iterations(5)
     */
    public function benchSearch(): void
    {
        $this->search->bestMove(new ChessphpChessboard());
    }
}
