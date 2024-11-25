<?php

namespace App\Http\Controllers;

use App\Services\OmdbService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;


class MovieController extends Controller
{
    protected $omdb_service;

    public function __construct(OmdbService $omdb_service)
    {
        $this->omdb_service = $omdb_service;
    }

    /**
     * Search for movies by title
     *
     * @param Request $request
     *
     * @return Application|Factory|View
     * @throws Exception
     */
    public function search(Request $request)
    {
        $searched_movies = [];
        $title = $request->query('title');
        $response = $this->omdb_service->searchMovies($title);

        if( ! empty($response) && $response['Response'] === 'True') {
            $searched_movies = session('searched_movies', []);

            $searched_movies[$response['imdbID']] = [
                'title' => $response['Title'],
                'year'  => $response['Year'],
                'count' => isset($searched_movies[$response['imdbID']]) ? $searched_movies[$response['imdbID']]['count'] + 1 : 1,
            ];

            session(['searched_movies' => $searched_movies]);

            return view('movies.search', ['movie' => $response]);
        }

        return view('movies.search', ['movie' => []]);
    }

    /**
     * Display movie details
     *
     * @param $id
     *
     * @return Application|Factory|View
     */
    public function details($id)
    {
        $movie = $this->omdb_service->getMovieDetails($id);

        return view('movies.details', ['movie' => $movie]);
    }

    /**
     * Get trending movies
     *
     * @return Application|Factory|View
     */
    public function trending()
    {
        $trending_movies = session('searched_movies', []);

        $sort_movies = collect($trending_movies)
            ->sortByDesc('count')
            ->take(10);

        return view('movies.trending', ['movies' => $sort_movies]);
    }

}
