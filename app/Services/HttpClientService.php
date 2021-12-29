<?php

namespace App\Services;

use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

class HttpClientService
{
    const TIMEOUT = 30;
    const AZROM = 1;
    const ROMPROVIDER = 2;
    private $client;

    public function __construct()
    {
        $this->client = new Client(HttpClient::create(['verify_peer' => false, 'verify_host' => false,'timeout' => self::TIMEOUT]));
    }

    public function get($url = '')
    {
        return $this->client->request('GET', $url);
    }

    public function post($url = '')
    {
        return $this->client->request('POST', $url);
    }

}
