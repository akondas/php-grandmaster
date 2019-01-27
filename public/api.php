<?php

namespace Grandmaster;

use Grandmaster\Chessboard\ChessphpChessboard;
use Grandmaster\Evaluator\MaterialEvaluator;
use Grandmaster\Strategy\PositionEvaluation;
use Grandmaster\Strategy\RandomMove;

require_once __DIR__.'/../vendor/autoload.php';

$state = $_POST['state'] ?? null;
$strategy = $_POST['strategy'] ?? null;

$chessboard = new ChessphpChessboard();

/** @var Strategy[] $strategies */
$strategies = [
    RandomMove::class => new RandomMove($chessboard),
    PositionEvaluation::class => new PositionEvaluation(new MaterialEvaluator(), $chessboard)
];

if($state === null) {
    echo json_encode(['error' => 'State is required']);
    exit;
}

if(!isset($strategies[$strategy])) {
    echo json_encode(['error' => 'Unknown strategy']);
    exit;
}

echo json_encode(['move' => $strategies[$strategy]->nextMove($state)]);
