<?php
declare(strict_types=1);

namespace Dipocket;
require_once __DIR__ . '/../vendor/autoload.php';

use Exception;
use SimpleXMLElement;

class Search
{
    private string $rssUrl = 'https://news.google.com/rss/search';

    public function searchNews(string $keyword, string $language): array
    {
        $rssUrl = $this->rssUrl . '?q=' . urlencode($keyword) . '&hl=' . $language . '&gl=' . $language;
        $rssContent = $this->fetchRssContent($rssUrl);
        // return $rssContent;
        $rssXml = new SimpleXMLElement($rssContent);
        $items = $rssXml->xpath('//item');

        $results = [];
        foreach ($items as $item) {
            $result = [
                'title' => (string)$item->title,
                'description' => (string)$item->description,
                'link' => (string)$item->link,
                'pubDate' => (string)$item->pubDate
            ];
            $results[] = $result;
        }
        return $results;
    }

    private function fetchRssContent(string $url): string
    {
        $client = new \GuzzleHttp\Client([
                'verify' => false,
            ]);
        $response = $client->get($url);

        if ($response->getStatusCode() !== 200) {
            throw new Exception('Failed to retrieve RSS content');
        }

        return $response->getBody()->getContents();
    }
}

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

    header("Access-Control-Allow-Origin: *");
    header('Content-type: application/json');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header('Content-Type: application/json');
    echo json_encode($results);
    // echo json_encode(['search' => $search]);
} catch (Exception $e) {
    http_response_code(500);
    // lets get all the error messages
     
    // echo json_encode(['error' => $e->getMessage()]);
    echo json_encode(['error' => $e]);
}

