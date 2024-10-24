@extends('layouts.app')

@section('content')
    <h1 class="animate__animated animate__rotateInDownLeft">{{ $comic['title'] }}</h1>
    <button onclick="history.back()" class="btn btn-danger mb-3">Go back</button>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ $comic['thumbnail']['path'].'.'.$comic['thumbnail']['extension'] }}" alt="{{ $comic['title'] }}" class="img-fluid animate__animated animate__zoomIn" id="img-show-comic">
            </div>
            <div class="col-md-8">
                <p>{{ $comic['description'] }}</p>
                @if(isset($comic['dates']))
                    @foreach($comic['dates'] as $date)
                        @if($date['type'] == 'onsaleDate')
                            <h3><strong>Release Date:</strong> {{ date('F j, Y', strtotime($date['date'])) }}</h3>
                        @endif
                    @endforeach
                @endif
                @if(isset($comic['prices'][0]['price']))
                    <h3><strong>Price:</strong> ${{ $comic['prices'][0]['price'] }}</h3>
                @endif
                <h3><strong>Pages:</strong> {{ $comic['pageCount'] }}</h3>

                @if($comic['characters']['returned'] !== 0)
                <h3>Characters</h3>
                <ul>
                    @foreach($comic['characters']['items'] as $story)
                        <li>{{ $story['name'] }}</li>
                    @endforeach
                </ul>
            @endif

                @if($comic['creators']['returned'] !== 0)
                    <h3>Creators</h3>
                    <ul>
                            @foreach($comic['creators']['items'] as $creator)
                                <li>{{ $creator['role'] }}: {{ $creator['name'] }}</li>
                            @endforeach
                    </ul>
                @endif
                
                @if($comic['stories']['returned'] !== 0)
                    <h3>Stories</h3>
                    <ul>
                        @foreach($comic['stories']['items'] as $story)
                            <li>{{ $story['name'] }}</li>
                        @endforeach
                    </ul>
                @endif
                
                @if($comic['events']['returned'] !== 0)
                <h3>Events</h3>
                <ul class="events">
                    @foreach($comic['events']['items'] as $event)
                        <li>{{ $event['name'] }}</li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>

        <!-- Mapa -->
        <div id="comicMap" style="height: 80vh; width: 100%; margin-top: 20px;"></div>
        
        <h3 style="margin:100px auto; font-style:italic;">If you've made it this far, it's clear you're a true Marvel fan, but be wary of their most infamous supervillains...</h3>
        <div id="villainsCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#villainsCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#villainsCarousel" data-slide-to="1"></li>
              <li data-target="#villainsCarousel" data-slide-to="2"></li>
              <li data-target="#villainsCarousel" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="{{ asset('img/thanos.webp') }}" class="d-block w-100" alt="Thanos">
                <div class="carousel-caption">
                  <h3 style="border: 2px solid goldenrod;border-radius:5px; background:black;color: goldenrod; display:inline-block; padding:10px">Thanos</h3>
                </div>
              </div>
              <div class="carousel-item">
                <img src="{{ asset('img/galactus.webp') }}" class="d-block w-100" alt="Galactus">
                <div class="carousel-caption">
                  <h3 style="border: 2px solid goldenrod;border-radius:5px; background:black;color: goldenrod; display:inline-block; padding:10px">Galactus</h3>
                </div>
              </div>
              <div class="carousel-item">
                <img src="{{ asset('img/dr-doom.webp') }}" class="d-block w-100" alt="Doctor Doom">
                <div class="carousel-caption">
                  <h3 style="border: 2px solid goldenrod;border-radius:5px; background:black;color: goldenrod; display:inline-block; padding:10px">Doctor Doom</h3>
                </div>
              </div>
              <div class="carousel-item">
                <img src="{{ asset('img/magneto.jpg') }}" class="d-block w-100" alt="Magneto">
                <div class="carousel-caption">
                  <h3 style="border: 2px solid goldenrod;border-radius:5px; background:black;color: goldenrod; display:inline-block; padding:10px">Magneto</h3>
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#villainsCarousel" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#villainsCarousel" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
    </div>

@endsection

@section('additional-scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var map = L.map('comicMap', {
            center: [0, 0],
            zoom: 0,
            crs: L.CRS.Simple,
            attributionControl: false,
            zoomControl: true,
            maxBounds: [[0, 0], [700, 600]],
            maxBoundsViscosity: 0.1,
            wheelPxPerZoomLevel: 200 
        });

        var bounds = [[0, 0], [700, 600]];
        L.imageOverlay('{{ $comic['thumbnail']['path'].'.'.$comic['thumbnail']['extension'] }}', bounds).addTo(map);
        map.fitBounds(bounds);
    });
</script>
@endsection
