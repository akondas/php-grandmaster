<?php

declare (strict_types = 1);

namespace Grandmaster\Board;

use Grandmaster\Piece\King;

class BoardTest extends \PHPUnit_Framework_TestCase
{
    public function testAddPieceToBoard()
    {
        $board = new Board();
        $board->addPiece($piece = new King(), $square = new Square('e', 1));

        $pieces = [(string) $square => $piece];

        $this->assertSame($pieces, $board->getPieces());
    }
}
