@extends('layouts.app')

@section('title', $series['title'])

@section('content')
<h1 class="text-center mb-4">Serie information sheet</h1>
<button onclick="history.back()" class="btn btn-danger mb-3">Go back</button>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow card-series">
                <div class="card-body">
                    <img src="{{ $series['thumbnail']['path'] }}.{{ $series['thumbnail']['extension'] }}" class="card-img-top series-img animate__animated animate__zoomIn" alt="{{ $series['title'] }}">
                    <h2 class="card-title animate__animated animate__flipInY" style="color:goldenrod !important; margin-top:10px;">{{ $series['title'] }}</h2>
                    <h6 class="text-muted"> {{ $series['description'] ?? 'Not available' }}</h6>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5 style="color:#EE171F !important;">Details</h5>
                            <ul>
                                @isset($series['startYear'])
                                <li style="color:black;">Start Year: {{ $series['startYear'] }}</li>
                                @endisset
                                @isset($series['endYear'])
                                <li style="color:black;">End Year: {{ $series['endYear'] }}</li>
                                @endisset
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5 style="color:#EE171F !important;">More Info</h5>
                            <p id="rating">Rating: {{ $series['rating'] != "" ? $series['rating'] : 'Not rated' }}</p>
                            <div class="gallery">
                                <h5 style="color:#EE171F !important;">Type</h5>
                                @if(isset($series['type']))
                                    <p style="color:black;">{{$series['type']}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- Nueva sección: Personajes principales -->
                    <div class="mt-4">
                        <h5 style="color:#EE171F !important;">Main Characters</h5>
                        <div>
                            @if(isset($series['characters']) && is_array($series['characters']))
                            <ul style="color:black !important; text-align:center;">
                            @foreach($series['characters']['items'] as $character)
                                <li style="color:black !important; text-align:center !important;">{{ $character['name'] }}</li> 
                            @endforeach
                            </ul>
                            @endif
                        </div>
                    </div>
                    <!-- Nueva sección: Críticas y Reseñas -->
                    <div class="mt-4">
                        <h5 style="color:#EE171F !important;">Reviews</h5>
                        @if(isset($series['reviews']) && count($series['reviews']) > 0)
                            @foreach($series['reviews'] as $review)
                                <div><strong>{{ $review['author'] }}:</strong> {{ $review['content'] }}</div>
                            @endforeach
                        @else
                            <p style="color:black !important;">No reviews available.</p>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <a href="#" onclick="goBack()" class="btn btn-danger">Back to series list</a>
                    @if(isset($series['officialSite']))
                        <a href="{{ $series['officialSite'] }}" class="btn btn-secondary" target="_blank">Visit Official Site</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
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
@endsection
@section('additional-scripts')
<script>
    function goBack() {
        window.history.back();
    }
</script>
@endsection
