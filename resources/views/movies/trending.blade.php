@extends('app')
@section('content')
    <h1>Trending Movies</h1>

    <ul>
        @foreach ($movies as $key => $movie)
            <li>
                <a href="{{ route('movies.movie-details', $key) }}">
                    {{ $movie['title'] }} ({{ $movie['year'] }})
                </a>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('movies.movie-search') }}">Back to Search</a>
@endsection
