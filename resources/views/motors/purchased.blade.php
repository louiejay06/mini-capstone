<!-- resources/views/motors/purchase.blade.php -->

@extends('base') <!-- Adjust as per your layout structure -->

@section('content')
    <div class="container">
        <h2>Motor Purchase Details</h2>

        <div>
            <p><strong>Motor ID:</strong> {{ $motor->id }}</p>
            <p><strong>Brand:</strong> {{ $motor->brand }}</p>
            <p><strong>Model:</strong> {{ $motor->model }}</p>
            <!-- Add more motor details as needed -->

            <h3>Buyer Information</h3>
            <p><strong>Name:</strong> {{ $purchase->buyer_name }}</p>
            <p><strong>Contact Number:</strong> {{ $purchase->contact_number }}</p>
            <!-- Add more purchase details as needed -->
        </div>
    </div>
@endsection
