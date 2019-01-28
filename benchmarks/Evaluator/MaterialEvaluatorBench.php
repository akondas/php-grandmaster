<?php

declare(strict_types=1);

namespace Grandmaster\Benchmarks\Evaluator;

use Grandmaster\Chessboard;
use Grandmaster\Evaluator\MaterialEvaluator;
use PhpBench\Benchmark\Metadata\Annotations\BeforeMethods;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

/**
 * @BeforeMethods({"init"})
 */
final class MaterialEvaluatorBench
{
    /**
     * @var MaterialEvaluator
     */
    private $evaluator;

    /**
     * @var Chessboard
     */
    private $board;

    public function init(): void
    {
        $this->evaluator = new MaterialEvaluator();
        $this->board = new Chessboard\ChessphpChessboard();
    }

    /**
     * @Revs(10000)
     * @Iterations(5)
     */
    public function benchEvaluate(): void
    {
        $this->evaluator->evaluate($this->board);
    }
}
