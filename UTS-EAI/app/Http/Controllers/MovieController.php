<?php

namespace App\Http\Controllers;

use App\Services\MovieService;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    protected $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function index()
    {
        $movies = $this->movieService->getAllMovies();
        return view('movies.index', compact('movies'));
    }

    public function show($id)
    {
        $movie = $this->movieService->getMovieById($id);
        $schedules = $this->movieService->getMovieSchedules($id);
        return view('movies.show', compact('movie', 'schedules'));
    }
} 