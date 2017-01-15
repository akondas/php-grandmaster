<?php

declare(strict_types=1);

namespace Grandmaster\Chessboard;

class Chessboard
{
    /*
     * @var array
     */
    private $pieces;

    /**
     * @param Setup $setup
     */
    public function __construct(Setup $setup)
    {
        foreach ($setup->pieces() as $square => $piece) {
            $this->pieces[$square] = $piece;
        }
    }

}
