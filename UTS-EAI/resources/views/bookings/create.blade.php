@extends('layouts.app')

@section('title', 'Book Tickets - ' . $movie->title)

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="position-relative">
                <img src="{{ $movie->poster_url }}" class="card-img-top movie-poster" alt="{{ $movie->title }}">
                <div class="position-absolute top-0 end-0 m-3">
                    <span class="badge bg-primary">
                        <i class="fas fa-star me-1"></i> {{ $movie->rating }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title mb-3">{{ $movie->title }}</h5>
                <div class="d-flex align-items-center mb-3">
                    <span class="badge bg-secondary me-2">{{ $movie->genre }}</span>
                    <span class="text-muted">
                        <i class="fas fa-clock me-1"></i> {{ $movie->duration }} min
                    </span>
                </div>
                <div class="mb-4">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-calendar-alt me-2 text-primary"></i>
                        <span>{{ $schedule->show_time->format('l, M d, Y') }}</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-clock me-2 text-primary"></i>
                        <span>{{ $schedule->show_time->format('h:i A') }}</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-chair me-2 text-primary"></i>
                        <span>{{ $schedule->available_seats }} seats available</span>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <span class="text-muted">Price per ticket</span>
                    <h5 class="text-primary mb-0">${{ number_format($schedule->price, 2) }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-transparent border-0">
                <h4 class="mb-0">
                    <i class="fas fa-ticket-alt me-2 text-primary"></i>
                    Select Your Seats
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                    <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">

                    <div class="mb-4">
                        <label class="form-label">Number of Tickets</label>
                        <select name="ticket_count" id="ticketCount" class="form-select" required>
                            <option value="">Select number of tickets</option>
                            @for($i = 1; $i <= min(10, $schedule->available_seats); $i++)
                                <option value="{{ $i }}">{{ $i }} ticket{{ $i > 1 ? 's' : '' }}</option>
                            @endfor
                        </select>
                    </div>

                    <div id="seatSelection" class="d-none">
                        <div class="mb-4">
                            <label class="form-label">Select Seats</label>
                            <div class="seat-grid">
                                @for($row = 1; $row <= 10; $row++)
                                    <div class="row mb-2">
                                        @for($col = 1; $col <= 10; $col++)
                                            <div class="col-1">
                                                <div class="seat" data-row="{{ $row }}" data-col="{{ $col }}">
                                                    {{ chr(64 + $row) }}{{ $col }}
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                @endfor
                            </div>
                        </div>

                        <div class="booking-summary">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0">Selected Seats</h5>
                                <span id="selectedSeats" class="text-muted">None</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Total Price</h5>
                                <h5 class="text-primary mb-0">$<span id="totalPrice">0.00</span></h5>
                            </div>
                        </div>

                        <input type="hidden" name="seats" id="selectedSeatsInput">
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-4" id="bookButton" disabled>
                        <i class="fas fa-check me-2"></i> Confirm Booking
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .seat-grid {
        background: #f8fafc;
        padding: 2rem;
        border-radius: 16px;
        box-shadow: var(--card-shadow);
    }

    .seat {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background: #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 12px;
        font-weight: 500;
        transition: all 0.3s ease;
        margin: 0.25rem;
    }

    .seat:hover {
        background: #cbd5e1;
        transform: scale(1.05);
    }

    .seat.selected {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        transform: scale(1.05);
    }

    .seat.unavailable {
        background: #fecaca;
        color: #ef4444;
        cursor: not-allowed;
    }

    .booking-summary {
        background: #f8fafc;
        padding: 1.5rem;
        border-radius: 12px;
        margin-top: 2rem;
        box-shadow: var(--card-shadow);
    }

    .form-select {
        border-radius: 12px;
        padding: 0.75rem 1rem;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(26, 35, 126, 0.1);
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border: none;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(26, 35, 126, 0.3);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ticketCount = document.getElementById('ticketCount');
        const seatSelection = document.getElementById('seatSelection');
        const selectedSeats = document.getElementById('selectedSeats');
        const selectedSeatsInput = document.getElementById('selectedSeatsInput');
        const totalPrice = document.getElementById('totalPrice');
        const bookButton = document.getElementById('bookButton');
        const pricePerTicket = {{ $schedule->price }};
        let selectedSeatsArray = [];

        ticketCount.addEventListener('change', function() {
            if (this.value) {
                seatSelection.classList.remove('d-none');
                resetSeatSelection();
            } else {
                seatSelection.classList.add('d-none');
                resetSeatSelection();
            }
        });

        function resetSeatSelection() {
            selectedSeatsArray = [];
            selectedSeats.textContent = 'None';
            selectedSeatsInput.value = '';
            totalPrice.textContent = '0.00';
            bookButton.disabled = true;
            document.querySelectorAll('.seat').forEach(seat => {
                seat.classList.remove('selected');
                if (!seat.classList.contains('unavailable')) {
                    seat.style.cursor = 'pointer';
                }
            });
        }

        document.querySelectorAll('.seat').forEach(seat => {
            seat.addEventListener('click', function() {
                if (this.classList.contains('unavailable')) return;

                const maxSeats = parseInt(ticketCount.value);
                const isSelected = this.classList.contains('selected');

                if (isSelected) {
                    this.classList.remove('selected');
                    selectedSeatsArray = selectedSeatsArray.filter(s => s !== this.textContent);
                } else if (selectedSeatsArray.length < maxSeats) {
                    this.classList.add('selected');
                    selectedSeatsArray.push(this.textContent);
                }

                updateSelection();
            });
        });

        function updateSelection() {
            selectedSeats.textContent = selectedSeatsArray.join(', ') || 'None';
            selectedSeatsInput.value = JSON.stringify(selectedSeatsArray);
            totalPrice.textContent = (selectedSeatsArray.length * pricePerTicket).toFixed(2);
            bookButton.disabled = selectedSeatsArray.length !== parseInt(ticketCount.value);
        }
    });
</script>
@endpush
@endsection 