<?php

declare (strict_types = 1);

namespace tests\Grandmaster\Piece;

use Grandmaster\Piece\King;

class KingTest extends \PHPUnit_Framework_TestCase
{
    public function testKingConstruction()
    {
        $king = new King();

        $this->assertEquals(King::class, get_class($king));
    }
}
