@extends('layouts.app')

@section('content')

<h1 class="text-white mb-4">Characters</h1>
<!-- Formulario de Búsqueda -->
<div class="personajes-container">
    <form action="{{ route('personajes.index') }}" method="GET">
        <input type="text" name="search" placeholder="search by name...">
        <button class="form-button" type="submit">Search</button>
        <a href="{{ route('personajes.index') }}" class="form-button">Show all</a>
    </form>
    <!-- Botón para Mostrar Todos -->
    @if($personajes->isEmpty())
            <div class="alert alert-warning animate__animated animate__backInLeft" role="alert">
                No results found.
            </div>
    @else

    <div class="row">
        @foreach($personajes as $personaje)
            <div class="col-md-3 mb-5">
                <div class="flip-container">
                    <div class="card card-marvel h-100">
                        
                        <div class="front" data-title="{{ $personaje->nombre }}">
                            @if($personaje->imagen)
                            <img src="{{ $personaje->imagen }}" class="card-img-top custom-img-card" alt="{{ $personaje->nombre }}">
                            @else
                            <img src="ruta/a/una/imagen/por/defecto.jpg" class="card-img-top custom-img-card" alt="Imagen no disponible">
                            @endif
                        </div>
                        <div class="back">
                            <h3 class="card-title">{{ $personaje->nombre }}</h3>
                            @if ($personaje->descripcion != "")
                                <p class="card-text">{{ $personaje->descripcion }}</p>
                            @else
                                <p class="card-text">Marvel is building this description for you.</p>
                            @endif
                            <img class="img-responsive marvel_back_img" src="{{ asset('img/descarga.png') }}">
                        </div>
                    </div>
                </div>
            </div>
            @if ($loop->iteration % 4 == 0)
                </div><div class="row">
            @endif
        @endforeach
    </div>
</div>
<div id="pagination">
{{ $personajes->links('vendor.pagination.bootstrap-5') }}
</div>
@endif
@endsection
