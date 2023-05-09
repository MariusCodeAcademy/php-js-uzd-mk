<?php
declare(strict_types=1);

namespace App\Class;

use Exception;
use SimpleXMLElement;

class Search
{
    private string $rssUrl = 'https://news.google.com/rss/search';

    public function searchNews(string $keyword, string $language): array
    {
        $rssUrl = $this->rssUrl . '?q=' . urlencode($keyword) . '&hl=' . $language . '&gl=' . $language;
        $rssContent = $this->fetchRssContent($rssUrl);
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