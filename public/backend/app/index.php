<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Class\Search;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}

try {
    $requestBody = file_get_contents('php://input');
    $requestJson = json_decode($requestBody, true);

    if (!$requestJson || !isset($requestJson['keyword'], $requestJson['language'])) {
        throw new Exception('Invalid request');
    }

    $search = new Search();
    $results = $search->searchNews($requestJson['keyword'], $requestJson['language']);

    header('Content-Type: application/json');
    echo json_encode($results);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}

