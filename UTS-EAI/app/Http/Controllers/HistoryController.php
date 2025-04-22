<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;
use stdClass;

class HistoryController extends Controller
{
    public function index()
    {
        // For testing purposes, always use dummy data
        $orders = $this->getDummyData();

        return view('history-cinta.history', ['orders' => $orders]);

    }
    
    private function mapStatus($status)
    {
        // Map database status to view status
        $statusMap = [
            'pending' => 'pending',
            'paid' => 'pending',
            'completed' => 'completed',
            'cancelled' => 'cancelled'
        ];
        
        return $statusMap[$status] ?? 'pending';
      
    }
    
    private function getDummyData()
    {
        $now = Carbon::now();
        $yesterday = Carbon::yesterday();
        $lastWeek = Carbon::now()->subDays(7);
        $lastMonth = Carbon::now()->subDays(30);
        
        $dummyData = [
            [
                'id' => 1001,
                'movie_title' => 'Avengers: Endgame',
                'movie_poster' => 'https://image.tmdb.org/t/p/w500/or06FN3Dka5tukK1e9sl16pB3iy.jpg',
                'screening_date' => $now->format('d M Y'),
                'screening_time' => '19:00',
                'ticket_count' => 2,
                'total_price' => 120000,
                'created_at' => $now->copy()->subHours(2),
                'cinema' => 'Moononton Cinema',
                'studio' => 'Studio 1'
            ],
            [
                'id' => 1002,
                'movie_title' => 'Spider-Man: No Way Home',
                'movie_poster' => 'https://image.tmdb.org/t/p/w500/1g0dhYtq4irTY1GPXvft6k5YLjm.jpg',
                'screening_date' => $now->copy()->addDays(3)->format('d M Y'),
                'screening_time' => '20:30',
                'ticket_count' => 3,
                'total_price' => 180000,
                'created_at' => $now->copy()->subHours(5),
                'cinema' => 'Moononton Cinema',
                'studio' => 'Studio 2'
            ],
            [
                'id' => 1003,
                'movie_title' => 'The Batman',
                'movie_poster' => 'https://image.tmdb.org/t/p/w500/qbSrSmMkE3iCFx9z6fSygTro6yL.jpg',
                'screening_date' => $yesterday->format('d M Y'),
                'screening_time' => '18:30',
                'ticket_count' => 1,
                'total_price' => 60000,
                'created_at' => $yesterday->copy()->subHours(24),
                'cinema' => 'Moononton Cinema',
                'studio' => 'Studio 3'
            ],
            [
                'id' => 1004,
                'movie_title' => 'Black Panther: Wakanda Forever',
                'movie_poster' => 'https://image.tmdb.org/t/p/w500/sv1xJUazXeenevqxlYKm8QNZ3lz.jpg',
                'screening_date' => $lastWeek->format('d M Y'),
                'screening_time' => '21:00',
                'ticket_count' => 2,
                'total_price' => 120000,
                'created_at' => $lastWeek->copy()->subHours(48),
                'cinema' => 'Moononton Cinema',
                'studio' => 'Studio 1'
            ]
        ];

        // Convert each array to object
        return collect($dummyData)->map(function ($item) {
            return (object)$item;
        });
    }
} 