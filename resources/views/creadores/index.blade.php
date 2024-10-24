@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center;">
    <h1>Creators</h1>
    <a href="{{ route('creators.liked') }}" class="btn btn-warning">Creators I like</a>
</div>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="hero">
        <div class="hero__background" style="background-image: url('{{ asset('img/fondo-pantalla-avengers.jpg') }}')">
            <div class="creators-container">
                <!-- Barra de búsqueda -->
                <form action="{{ route('creators.index') }}" method="GET" class="creators-search-form">
                    <input type="text" name="search" class="creators-search-input" placeholder="Search creators">
                    <button type="submit" class="creators-search-button">Search</button>
                    <a href="{{ route('creators.index') }}" class="creators-show-all-button">Show all</a>
                </form>
                @if($creators->isEmpty())
                    <div class="alert alert-warning animate__animated animate__backInLeft" role="alert">
                        not results found.
                    </div>
                @else
                    <!-- Lista de creadores -->
                    <ul class="creators-list">
                        @foreach($creators as $creator)
                        <li class="creators-item animate__animated animate__flipInX">
                            <div class="creators-details">
                                <h2 class="creators-name">{{ $creator->nombre }}</h2>
                                <p class="creators-type">{{ $creator->tipo }}</p>
                                <!-- Botón de Me gusta -->
                                @if(!in_array($creator->id, $likedCreatorsIds))
                                    <form action="{{ route('like.toggle', $creator->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Like</button>
                                    </form>
                                @endif
                            </div>
                        </li>
                    @endforeach
                    </ul>
                    <!-- Botón para enlazar con la vista de creadores con "Me gusta" -->
                    <a href="{{ route('creators.liked') }}" class="btn btn-primary">View Creators with Likes</a>
                @endif
            </div>
        </div>
    </div>
    <div id="pagination">
        {{ $creators->links('vendor.pagination.bootstrap-5') }}
    </div>
@endsection

