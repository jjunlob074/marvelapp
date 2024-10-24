@extends('layouts.app')

@section('content')
<div class="video-wrapper">
    <video autoplay muted loop class="bg-video">
        <source src="{{ asset('videos/marvel.mp4') }}" type="video/mp4">
        Tu navegador no soporta videos HTML5.
    </video>
</div>

<div class="content-wrapper">
    <div class="content">
        <h1>Welcome to the Marvel Universe!</h1>
        <p>Discover the vast universe of Marvel</p>
    </div>
</div>
@endsection

