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
        $bookings = Booking::where('user_id', auth()->id())
                          ->with(['schedule.movie'])
                          ->orderBy('created_at', 'desc')
                          ->get();
        
        // If no bookings found, use dummy data
        if ($bookings->isEmpty()) {
            $orders = $this->getDummyData();
        } else {
            // Transform bookings into the format expected by the view
            $orders = $bookings->map(function ($booking) {
                return [
                    'id' => $booking->id,
                    'movie_title' => $booking->schedule->movie->title,
                    'movie_poster' => $booking->schedule->movie->poster_url,
                    'screening_date' => $booking->schedule->show_time->format('d M Y'),
                    'screening_time' => $booking->schedule->show_time->format('H:i'),
                    'ticket_count' => $booking->number_of_tickets,
                    'total_price' => $booking->total_price,
                    'status' => $this->mapStatus($booking->status),
                    'created_at' => $booking->created_at,
                    'cinema' => 'Moononton Cinema',
                    'studio' => 'Studio ' . $booking->schedule->theater_number,
                    'used_at' => $booking->status === 'completed' ? $booking->schedule->show_time : null
                ];
            });
        }

        return view('history-cinta.history', ['orders' => collect($orders)->map(function ($order) {
            return is_array($order) ? (object)$order : $order;
        })]);
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
                'status' => 'pending',
                'created_at' => $now->copy()->subHours(2),
                'cinema' => 'Moononton Cinema',
                'studio' => 'Studio 1',
                'used_at' => null
            ],
            [
                'id' => 1002,
                'movie_title' => 'Spider-Man: No Way Home',
                'movie_poster' => 'https://image.tmdb.org/t/p/w500/1g0dhYtq4irTY1GPXvft6k5YLjm.jpg',
                'screening_date' => $now->copy()->addDays(3)->format('d M Y'),
                'screening_time' => '20:30',
                'ticket_count' => 3,
                'total_price' => 180000,
                'status' => 'pending',
                'created_at' => $now->copy()->subHours(5),
                'cinema' => 'Moononton Cinema',
                'studio' => 'Studio 2',
                'used_at' => null
            ],
            [
                'id' => 1003,
                'movie_title' => 'The Batman',
                'movie_poster' => 'https://image.tmdb.org/t/p/w500/qbSrSmMkE3iCFx9z6fSygTro6yL.jpg',
                'screening_date' => $yesterday->format('d M Y'),
                'screening_time' => '18:30',
                'ticket_count' => 1,
                'total_price' => 60000,
                'status' => 'completed',
                'created_at' => $yesterday->copy()->subHours(24),
                'cinema' => 'Moononton Cinema',
                'studio' => 'Studio 3',
                'used_at' => $yesterday->copy()->setHour(18)->setMinute(30)
            ],
            [
                'id' => 1004,
                'movie_title' => 'Black Panther: Wakanda Forever',
                'movie_poster' => 'https://image.tmdb.org/t/p/w500/sv1xJUazXeenevqxlYKm8QNZ3lz.jpg',
                'screening_date' => $lastWeek->format('d M Y'),
                'screening_time' => '21:00',
                'ticket_count' => 2,
                'total_price' => 120000,
                'status' => 'completed',
                'created_at' => $lastWeek->copy()->subHours(48),
                'cinema' => 'Moononton Cinema',
                'studio' => 'Studio 1',
                'used_at' => $lastWeek->copy()->setHour(21)->setMinute(0)
            ],
            [
                'id' => 1005,
                'movie_title' => 'Doctor Strange in the Multiverse of Madness',
                'movie_poster' => 'https://image.tmdb.org/t/p/w500/9Gtg2DzBhmYamXBS1hKAhiwbBKS.jpg',
                'screening_date' => $lastMonth->format('d M Y'),
                'screening_time' => '19:30',
                'ticket_count' => 4,
                'total_price' => 240000,
                'status' => 'cancelled',
                'created_at' => $lastMonth->copy()->subHours(72),
                'cinema' => 'Moononton Cinema',
                'studio' => 'Studio 2',
                'used_at' => null
            ],
            [
                'id' => 1006,
                'movie_title' => 'Thor: Love and Thunder',
                'movie_poster' => 'https://image.tmdb.org/t/p/w500/pIkRyD18kluFvDtWxGPB3S2R2SU.jpg',
                'screening_date' => $lastMonth->copy()->subDays(5)->format('d M Y'),
                'screening_time' => '20:00',
                'ticket_count' => 2,
                'total_price' => 120000,
                'status' => 'completed',
                'created_at' => $lastMonth->copy()->subDays(10),
                'cinema' => 'Moononton Cinema',
                'studio' => 'Studio 3',
                'used_at' => $lastMonth->copy()->subDays(5)->setHour(20)->setMinute(0)
            ]
        ];

        // Convert each array to object
        return collect($dummyData)->map(function ($item) {
            return (object)$item;
        });
    }
} 