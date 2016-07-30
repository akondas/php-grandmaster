<?php

declare (strict_types = 1);

namespace Grandmaster\Board;

class Square
{
    /**
     * @var string
     */
    private $file;

    /**
     * @var int
     */
    private $rank;

    /**
     * @param string $file
     * @param int    $rank
     */
    public function __construct(string $file, int $rank)
    {
        $this->file = $file;
        $this->rank = $rank;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->file.(string) $this->rank;
    }
}
