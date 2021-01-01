<?php

namespace App;
use GuzzleHttp\Client;

class NasaPicture
{

    private $apiKey;

    public function __construct($apiKey) 
    {
        $this->apiKey = $apiKey;
        $this->getInfo();
    }
    
    public function getInfo()
    {
        $client = new Client();

        $response = $client->request('GET', 'https://api.nasa.gov/planetary/apod?api_key='.$this->apiKey);
        $info = $response->getBody()->getContents();

        $decode = json_decode($info);
    }
}