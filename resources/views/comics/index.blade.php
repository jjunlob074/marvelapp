@extends('layouts.app')

@section('content')

    <h1>Marvel Comics</h1>
    <form action="{{ route('comics.index') }}" method="GET" class="mb-3">
        <div class="input-group mb-3">
            <input type="text" name="search" class="form-control" placeholder="Search comics..." value="{{ $search }}">
            <div class="input-group-append">
                <button class="btn btn-outline-warning" type="submit">Search</button>
            </div>
            @if(!empty($search))
            <div class="input-group-append">
                <a href="{{ route('comics.index') }}" class="btn btn-outline-primary">Show all</a>
            </div>
            @endif
        </div>
    </form>

    @if($comics->isEmpty())
        <div class="alert alert-warning animate__animated animate__backInLeft" role="alert">
            not results found.
        </div>
    @else
        <div class="row">
            @foreach ($comics as $comic)
                <div class="col-md-4 mb-4">
                    <div class="card"> <!-- Modificación para hacer todas las cartas de igual altura -->
                        <!-- Ajusta la notación aquí para usar la sintaxis de array -->
                        <div class="image-container">
                            <!-- Ajusta la notación aquí para usar la sintaxis de array -->
                            <img src="{{ $comic['thumbnail']['path'].'.'.$comic['thumbnail']['extension'] }}" class="card-img-top img-fluid comic-image" alt="{{ $comic['title'] }}">
                        </div>
                        <div class="card-body d-flex flex-column"> <!-- Flex para posicionar el botón al final -->
                            <!-- Ajusta la notación aquí para usar la sintaxis de array -->
                            <h5 class="card-title">{{ $comic['title'] }}</h5>
                            <!-- Asegúrate de verificar si la descripción existe para evitar errores -->
                            <p class="card-text">{{ Str::limit($comic['description'] ?? '', 100, '...') }}</p>
                            <!-- Ajusta la notación aquí para usar la sintaxis de array -->
                            <a href="{{ route('comics.show', $comic['id']) }}" class="btn btn-danger mt-auto">Comic book details</a> <!-- mt-auto para empujar al final -->
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- La paginación puede necesitar ser ajustada dependiendo de cómo estés pasando los datos a la vista -->
        <div id="pagination">
            {{ $comics->links('vendor.pagination.bootstrap-5') }}
        </div>
    @endif

@endsection
