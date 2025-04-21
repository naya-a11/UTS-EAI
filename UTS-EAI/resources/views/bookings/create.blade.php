@extends('layouts.app')

@section('title', 'Book Ticket')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Book Your Ticket</h2>
                    
                    <form action="{{ route('bookings.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="schedule_id" value="{{ $scheduleId }}">
                        
                        <!-- Customer Information -->
                        <div class="mb-4">
                            <h5 class="text-muted mb-3">Customer Information</h5>
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                    id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                    id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                    id="phone" name="phone" value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Ticket Information -->
                        <div class="mb-4">
                            <h5 class="text-muted mb-3">Ticket Information</h5>
                            <div class="mb-3">
                                <label for="seats" class="form-label">Number of Seats</label>
                                <select class="form-select @error('seats') is-invalid @enderror" 
                                    id="seats" name="seats" required>
                                    @for($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ old('seats') == $i ? 'selected' : '' }}>
                                            {{ $i }} {{ $i == 1 ? 'seat' : 'seats' }}
                                        </option>
                                    @endfor
                                </select>
                                @error('seats')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Payment Information -->
                        <div class="mb-4">
                            <h5 class="text-muted mb-3">Payment Method</h5>
                            <div class="mb-3">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="payment_method" 
                                        id="credit_card" value="credit_card" checked>
                                    <label class="form-check-label" for="credit_card">
                                        <i class="fas fa-credit-card me-2"></i>Credit Card
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="payment_method" 
                                        id="debit_card" value="debit_card">
                                    <label class="form-check-label" for="debit_card">
                                        <i class="fas fa-credit-card me-2"></i>Debit Card
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" 
                                        id="e_wallet" value="e_wallet">
                                    <label class="form-check-label" for="e_wallet">
                                        <i class="fas fa-wallet me-2"></i>E-Wallet
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="fas fa-ticket-alt me-2"></i>Book Now
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 