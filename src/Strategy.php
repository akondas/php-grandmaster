<?php

declare(strict_types=1);

namespace Grandmaster;

interface Strategy
{
    public function nextMove(string $state): ?string;
}
