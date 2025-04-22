<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected $movies = [
        'NS001' => [
            'title' => 'Pabrik Gula',
            'poster' => 'images/movies/pabrik-gula.jpg',
            'rating' => 4.0,
            'genres' => ['Horror'],
            'duration' => '1h 45min',
            'releaseDate' => 'May 1, 2024',
            'ageRating' => 'R',
            'synopsis' => 'Di sebuah pabrik gula tua yang sudah lama ditinggalkan, sekelompok remaja memutuskan untuk menghabiskan malam mereka. Namun, mereka tidak menyadari bahwa pabrik tersebut menyimpan rahasia mengerikan.'
        ],
        'NS002' => [
            'title' => 'Jumbo',
            'poster' => 'images/movies/jumbo.jpg',
            'rating' => 5.0,
            'genres' => ['Animation', 'Adventure'],
            'duration' => '1h 30min',
            'releaseDate' => 'May 15, 2024',
            'ageRating' => 'PG',
            'synopsis' => 'Don (Prince Poetiray), anak gemuk yang sering diolok-olok dengan panggilan "Jumbo" ingin membalas perbuatan anak yang suka merundungnya.'
        ],
        'NS003' => [
            'title' => 'Sinners',
            'poster' => 'images/movies/sinners.jpg',
            'rating' => 4.5,
            'genres' => ['Thriller', 'Horror'],
            'duration' => '2h 15min',
            'releaseDate' => 'June 1, 2024',
            'ageRating' => 'R',
            'synopsis' => 'Sebuah tim investigasi paranormal dipanggil untuk menyelidiki serangkaian kematian misterius di sebuah kota kecil.'
        ],
        'NS004' => [
            'title' => 'Minecraft',
            'poster' => 'images/movies/minecraft.jpg',
            'rating' => 4.5,
            'genres' => ['Action', 'Adventure'],
            'duration' => '2h 30min',
            'releaseDate' => 'June 15, 2024',
            'ageRating' => 'PG-13',
            'synopsis' => 'Steve, seorang pemain Minecraft yang terobsesi dengan permainan, secara tidak sengaja terhisap ke dalam dunia Minecraft.'
        ]
    ];

    public function create($movieId = null)
    {
        if (!$movieId) {
            return redirect('/')->with('error', 'No movie selected');
        }

        if (!isset($this->movies[$movieId])) {
            return redirect('/')->with('error', 'Movie not found');
        }

        $movie = (object) $this->movies[$movieId];
        return view('movie_details-fuad.booking', compact('movie', 'movieId'));
    }

    public function storeBookingData(Request $request)
    {
        $request->validate([
            'selectedSeats' => 'required|array',
            'totalPrice' => 'required|numeric',
            'movieId' => 'required|string'
        ]);

        if (!isset($this->movies[$request->movieId])) {
            return response()->json(['success' => false, 'message' => 'Movie not found'], 404);
        }

        session([
            'selectedSeats' => json_encode($request->selectedSeats),
            'totalPrice' => $request->totalPrice,
            'movie' => $this->movies[$request->movieId],
            'movieId' => $request->movieId
        ]);

        return response()->json(['success' => true]);
    }
} 