<?php

namespace App;
use GuzzleHttp\Client;

class NasaPicture
{

    private $apiKey;

    public function __construct($apiKey) 
    {
        $this->apiKey = $apiKey;
    }
}