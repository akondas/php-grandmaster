<?php

declare(strict_types=1);

namespace Grandmaster;

use Grandmaster\Chessboard\ChessphpChessboard;
use Grandmaster\Evaluator\CombinedEvaluator;
use Grandmaster\Evaluator\MaterialEvaluator;
use Grandmaster\Evaluator\PositionEvaluator;
use Grandmaster\Search\MinimaxFullSearch;
use Grandmaster\Search\MinimaxSearch;
use Grandmaster\Strategy\PositionEvaluation;
use Grandmaster\Strategy\RandomMove;
use Grandmaster\Strategy\TreeSearch;

var_dump($_SERVER);
die;

require_once __DIR__.'/../vendor/autoload.php';

$state = $_POST['state'] ?? null;
$strategy = $_POST['strategy'] ?? null;
$depth = $_POST['depth'] ?? 3;

$chessboard = new ChessphpChessboard();
$evaluator = new CombinedEvaluator([
    $materialEvaluator = new MaterialEvaluator(),
    new PositionEvaluator()
]);

/** @var Strategy[] $strategies */
$strategies = [
    RandomMove::class => new RandomMove($chessboard),
    PositionEvaluation::class => new PositionEvaluation($materialEvaluator, $chessboard),
    TreeSearch::class => new TreeSearch(new MinimaxSearch($evaluator, (int) $depth), $chessboard),
    // for my blog post live examples
    TreeSearch::class.'PruningMaterial' => new TreeSearch(new MinimaxSearch($materialEvaluator, (int) $depth), $chessboard),
    TreeSearch::class.'FullMaterial' => new TreeSearch(new MinimaxFullSearch($materialEvaluator, (int) $depth), $chessboard)
];

if ($state === null) {
    echo json_encode(['error' => 'State is required']);
    exit;
}

if (!isset($strategies[$strategy])) {
    echo json_encode(['error' => 'Unknown strategy']);
    exit;
}

$startTime = microtime(true);
$move = $strategies[$strategy]->nextMove($state);

// Support for AWS Lambda endpoint
header('Access-Control-Allow-Origin: *');

echo json_encode([
    'move' => $move,
    'movesEvaluated' => $chessboard->moveCount(),
    'time' => microtime(true) - $startTime
]);
