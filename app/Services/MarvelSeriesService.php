<?php

namespace App\Services;

use GuzzleHttp\Client;

class MarvelSeriesService
{
    protected $client;
    protected $baseUrl = 'http://gateway.marvel.com/v1/public/series';
    protected $publicKey;
    protected $privateKey;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->publicKey = env('MARVEL_API_KEY');
        $this->privateKey = env('MARVEL_PRIVATE_KEY');
    }

    public function getFeaturedSeries($limit = 20, $offset = 0)
    {
        $params = $this->generateAuthParams() + [
            'limit' => $limit,
            'offset' => $offset,
        ];

        $response = $this->client->get("{$this->baseUrl}?" . http_build_query($params));
        $body = json_decode($response->getBody()->getContents(), true);

        return [
            'results' => $body['data']['results'],
            'total' => $body['data']['total'],
        ];
    }

    public function searchSeries($query, $limit = 20, $offset = 0)
    {
        $params = $this->generateAuthParams() + [
            'titleStartsWith' => $query,
            'limit' => $limit,
            'offset' => $offset,
        ];

        $response = $this->client->get("{$this->baseUrl}?" . http_build_query($params));
        $body = json_decode($response->getBody()->getContents(), true);

        return [
            'results' => $body['data']['results'],
            'total' => $body['data']['total'],
        ];
    }

    public function getSeriesById($id)
    {
        $params = $this->generateAuthParams();
        $response = $this->client->get("{$this->baseUrl}/{$id}?" . http_build_query($params));

        $body = json_decode($response->getBody()->getContents(), true);
        $results = $body['data']['results'];

        return count($results) > 0 ? $results[0] : null;
    }

    protected function generateAuthParams()
    {
        $timestamp = time();
        $hash = md5($timestamp . $this->privateKey . $this->publicKey);

        return [
            'ts' => $timestamp,
            'apikey' => $this->publicKey,
            'hash' => $hash,
        ];
    }
}
