<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class OmdbService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = 'http://www.omdbapi.com/';
        $this->apiKey = config('services.omdb.api_key');
    }

    public function searchMovies($title)
    {
        $response = Http::get($this->baseUrl, [
            'apikey' => $this->apiKey,
            't' => $title,
        ]);

        return $response->json();
    }

    public function getMovieDetails($id)
    {
        $response = Http::get($this->baseUrl, [
            'apikey' => $this->apiKey,
            'i' => $id,
        ]);

        return $response->json();
    }
}
