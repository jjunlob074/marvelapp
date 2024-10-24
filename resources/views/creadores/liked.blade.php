@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center;">
    <h1>Creators</h1>
    <a href="{{ route('creators.index') }}" class="btn btn-warning">List of creators</a>
</div>
@if(session('danger'))
    <div class="alert alert-danger">
        {{ session('danger') }}
    </div>
@endif
    <div class="hero">
        <div class="hero__background" style="background-image: url('{{ asset('img/fondo-pantalla-avengers.jpg') }}')">
            <div class="creators-container">
                @if (count($likedCreators) == 0)
                    <div class="alert alert-warning animate__animated animate__backInLeft" role="alert">
                        You haven't liked any creator.
                    </div>
                @else
                    <!-- Lista de creadores con "Me gusta" -->
                    <ul class="creators-list">
                        @foreach($likedCreators as $creator)
                            <li class="creators-item animate__animated animate__flipInX">
                                <div class="creators-details">
                                    <h2 class="creators-name">{{ $creator->nombre }}</h2>
                                    <p class="creators-type">{{ $creator->tipo }}</p>
                                    <!-- Formulario para quitar el "Me gusta" -->
                                    <form action="{{ route('like.toggle', $creator->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Remove like</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection
