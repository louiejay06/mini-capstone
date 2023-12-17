@extends('base')

@section('content')
    <div class="card">
        <div class="card-header bg-success text-white">
            <h1 class="card-title mb-0">Purchase Motor</h1>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('motors.purchase', $motor) }}">
                @csrf
                <div class="mb-3">
                    <label for="buyer_name" class="form-label">Your Name:</label>
                    <input type="text" name="buyer_name" id="buyer_name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="contact_number" class="form-label">Contact Number:</label>
                    <input type="tel" name="contact_number" id="contact_number" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">Purchase</button>
            </form>
        </div>
    </div>
@endsection
