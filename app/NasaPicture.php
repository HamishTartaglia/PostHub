<?php

namespace App;
use GuzzleHttp\Client;

class NasaPicture
{

    private $apiKey;
    private $info;
    private $photoUrl;
    private $author;
    private $description;
    private $date;

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
        
        $photoUrl = $decode->url;
        $this->photoUrl = $photoUrl;

        $author = $decode->copyright;
        $this->author = $author;

        $description = $decode->explanation;
        $this->description = $description;

        $date = $decode->date;
        $this->date = $date;
    }
}