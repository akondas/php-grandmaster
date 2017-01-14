<?php

declare(strict_types=1);

namespace Grandmaster\Exception;

class BoardException extends \Exception
{
    /**
     * @param string $square
     *
     * @return BoardException
     */
    public static function squareNotEmpty(string $square)
    {
        return new self(sprintf('Square %s is not empty', $square));
    }
}
