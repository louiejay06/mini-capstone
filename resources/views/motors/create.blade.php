@extends('base')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h1 class="card-title mb-0">Create Motor</h1>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('motors.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="brand" class="form-label">Brand:</label>
                    <input type="text" name="brand" id="brand" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="model" class="form-label">Model:</label>
                    <input type="text" name="model" id="model" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="year" class="form-label">Year:</label>
                    <input type="text" name="year" id="year" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="power" class="form-label">Power:</label>
                    <input type="text" name="power" id="power" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image:</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Create Motor</button>
            </form>
        </div>
    </div>
@endsection
