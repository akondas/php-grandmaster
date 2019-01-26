<?php

declare(strict_types=1);

namespace Grandmaster;

interface Chessboard
{
    public function state(string $fen): void;

    /**
     * @return string[]
     */
    public function moves(): array;
}
