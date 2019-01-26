<?php

declare(strict_types=1);

namespace Grandmaster;

interface Chessboard
{
    public function setState(string $fen): void;

    /**
     * @return string[]
     */
    public function moves(): array;

    public function board(): array;
}
