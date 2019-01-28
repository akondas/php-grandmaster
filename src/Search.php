<?php

declare(strict_types=1);

namespace Grandmaster;

interface Search
{
    public function bestMove(Chessboard $board): ?string;
}
