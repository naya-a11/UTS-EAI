<?php

namespace App\Services;

use App\Models\Movie;
use App\Models\Schedule;
use Illuminate\Support\Facades\Cache;

class MovieService
{
    public function getAllMovies()
    {
        return Cache::remember('movies', 3600, function () {
            return Movie::with('schedules')->get();
        });
    }

    public function getMovieById($id)
    {
        return Movie::with('schedules')->findOrFail($id);
    }

    public function getMovieSchedules($movieId)
    {
        return Schedule::where('movie_id', $movieId)
            ->where('show_time', '>', now())
            ->orderBy('show_time')
            ->get();
    }

    public function updateMovieStats($movieId, $ticketsSold)
    {
        $movie = Movie::findOrFail($movieId);
        $movie->tickets_sold += $ticketsSold;
        $movie->save();
        
        Cache::forget('movies');
        return $movie;
    }
} 