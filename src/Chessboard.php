<?php

declare(strict_types=1);

namespace Grandmaster;

interface Chessboard
{
    public function setState(string $fen): void;

    public function move(string $san): void;

    public function undo(): void;

    /**
     * @return string[]
     */
    public function moves(): array;

    public function board(): array;

    public function isWhiteTurn(): bool;
}
