<?php

namespace Grandmaster;

use Grandmaster\Chessboard\ChessphpChessboard;
use Grandmaster\Strategy\PositionEvaluation;
use Grandmaster\Strategy\RandomMove;

require_once __DIR__.'/../vendor/autoload.php';

$state = $_POST['state'] ?? null;
$strategy = $_POST['strategy'] ?? null;

$strategies = [
    RandomMove::class,
    PositionEvaluation::class
];

if($state === null) {
    echo json_encode(['error' => 'State is required']);
    exit;
}

if(!in_array($strategy, $strategies, true)) {
    echo json_encode(['error' => 'Unknow strategy']);
    exit;
}

/** @var Strategy $strategy */
$strategy = new $strategy(new ChessphpChessboard());

echo json_encode(['move' => $strategy->nextMove($state)]);
