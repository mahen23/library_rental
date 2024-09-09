<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function fetchUsers(): array
    {
        $response = $this->client->request('GET', 'https://jsonplaceholder.typicode.com/users');

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Failed to fetch users');
        }

        return $response->toArray(); // Convert JSON response to array
    }
}
