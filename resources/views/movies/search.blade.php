@extends('app')
@section('content')
    <form method="GET" action="{{ route('movies.movie-search') }}">
        <input type="text" name="title" placeholder="Search movies..." value="{{ request('title') }}">
        <button type="submit">Search</button>
    </form>

    @if(! empty($movie) && is_array($movie))
        <ul>
                <li>
                    <a href="{{ route('movies.movie-details', $movie['imdbID']) }}">
                        {{ $movie['Title'] }} ({{ $movie['Year'] }})
                    </a>
                </li>
        </ul>
    @else
        <p>No results found.</p><br>

        <a href="{{ route('movies.trending-movies') }}">Trending Movies</a>
    @endif

@endsection
