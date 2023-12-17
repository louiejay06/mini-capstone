@extends('base')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h1 class="card-title mb-0">Motor List</h1>
        </div>
        <div class="card-body">
            @role('admin')
               <a href="{{ route('motors.create') }}" class="btn btn-success mb-3">Create Motor</a>
            @endrole

            @if(count($motors) > 0)
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($motors as $motor)
                        <div class="col mb-4">
                            <div class="card h-100 shadow">
                                @if ($motor->image_path)
                                    <img src="{{ asset($motor->image_path) }}" class="card-img-top" alt="{{ $motor->brand }} Image" style="max-height: 150px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $motor->brand }} {{ $motor->model }}</h5>
                                    <p class="card-text">
                                        <strong>Year:</strong> {{ $motor->year }}<br>
                                        <strong>Power:</strong> {{ $motor->power }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        @role('admin')
                                           <a href="{{ route('motors.edit', $motor) }}" class="btn btn-outline-secondary">Edit</a>
                                           <form method="POST" action="{{ route('motors.destroy', $motor) }}" class="d-inline">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" class="btn btn-outline-danger">Delete</button>
                                            </form>
                                        @endrole

                                        <div class="btn-group" role="group">
                                            <a href="{{ route('motors.purchaseForm', $motor) }}" class="btn btn-outline-success">Purchase</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info mt-3" role="alert">
                    No motors found.
                </div>
            @endif
        </div>
    </div>
@endsection
