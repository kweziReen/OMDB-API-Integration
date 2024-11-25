@extends('app')
@section('content')
    @if(! empty($movie) && is_array($movie))
        <h1>{{ $movie['Title'] }}</h1>
        <p>Release Date: {{ $movie['Released'] }}</p>
        <p>Rating: {{ $movie['imdbRating'] }}</p>
        <p>Plot: {{ $movie['Plot'] }}</p>
        <a href="{{ route('movies.movie-search') }}">Back to Search</a>
    @endif
@endsection
