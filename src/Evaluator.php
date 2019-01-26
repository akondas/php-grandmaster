<?php

declare(strict_types=1);

namespace Grandmaster;

interface Evaluator
{
    public function evaluate(Chessboard $board): int;
}
