<?php

declare(strict_types=1);

namespace tests\Grandmaster\Pieces;

use Grandmaster\Pieces\King;

class KingTest extends \PHPUnit_Framework_TestCase
{
    public function testKingConstruction()
    {
        $king = new King();

        $this->assertEquals(King::class, get_class($king));
    }
}
