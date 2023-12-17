<!-- resources/views/motors/purchased/index.blade.php -->

@extends('base')

@section('content')
    <div class="container">
        <h2 class="mb-4">Purchased Motors</h2>

        <ul class="list-group">
            @forelse($purchasedMotors as $purchasedMotor)
                <li class="list-group-item">
                    {{ $purchasedMotor->motor->brand }} {{ $purchasedMotor->motor->model }}
                    - Buyer: {{ $purchasedMotor->buyer_name }}
                </li>
            @empty
                <li class="list-group-item">No purchased motors available.</li>
            @endforelse
        </ul>
    </div>
@endsection
