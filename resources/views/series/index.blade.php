@extends('layouts.app')

@section('title', 'Featured Marvel Series')

@section('content')
    <div class="row">
        <div class="col">
            <h1 class="text-center mb-4">Featured Marvel Series</h1>
            <form action="{{ route('series.index') }}" method="GET" class="mb-3">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Search series..." value="{{ $search }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-warning" type="submit">Search</button>
                    </div>
                    @if(!empty($search))
                        <div class="input-group-append">
                            <a href="{{ route('series.index') }}" class="btn btn-outline-primary">Show All</a>
                        </div>
                    @endif
                </div>
            </form>
            <div class="card-columns">
                @if($series->isEmpty())
                    <div class="alert alert-warning animate__animated animate__backInLeft" role="alert">
                        No results found.
                    </div>
                @else
                    @foreach($series as $serie)
                        <div class="card series-card-index">
                            @if(isset($serie['thumbnail']['path']) && isset($serie['thumbnail']['extension']))
                                <div class="image-container">
                                    <img src="{{ $serie['thumbnail']['path'] }}.{{ $serie['thumbnail']['extension'] }}" class="card-img-top" alt="{{ $serie['title'] }}">
                                </div>
                            @else
                                <img src="https://via.placeholder.com/150" class="card-img-top" alt="Placeholder">
                            @endif
                            <div class="card-body">
                                <h4 class="card-title" style="color:goldenrod;">{{ $serie['title'] }}</h4>
                                <p class="card-text" style="color:black;">{{ $serie['description'] ?? 'No description available' }}</p>
                                <p class="card-text"><small class="text-muted">Start Year: {{ $serie['startYear'] }}</small></p>
                                <p class="card-text"><small class="text-muted">End Year: {{ $serie['endYear'] }}</small></p>
                                <a href="{{ route('series.show', ['id' => $serie['id']]) }}" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
                <!-- La paginación -->
                <div class="row mt-4">
                    <div class="col-md-8 offset-md-2">
                        <div id="pagination">
                            {{ $series->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
