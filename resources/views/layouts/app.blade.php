<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marvel</title>
    <link rel="icon" href="{{ asset('/img/favicon.webp') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('/img/favicon.webp') }}" type="image/x-icon">
    <!-- CSS de Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/three@0.128.0/build/three.min.js"></script>
<!-- scrollReveal -->
<script src="https://unpkg.com/scrollreveal"></script>

<style>
/* CARGA DE ASSETS CON ASSET PARA MANTENER LA INTEGRIDAD DEL PROYECTO */
@font-face {
    font-family: 'BADABB';
    src: url('{{ asset('fonts/BADABB__.TTF') }}') format('truetype');
}

#back-to-top {
    background-image: url('{{ asset('img/escudo.jpg') }}');
}

.navbar-toggler-icon {
    background: url('{{ asset('img/telaraña.avif') }}');
    background-position: center;
    background-size: cover;
}

.stories-container {
    background: url('{{ asset('img/marvel-black.jpg') }}');
    background-position: center;
    background-size: cover;
}

.stories-image {
    background: url('{{ asset('img/all-marvel.jpg') }}');
}

.lee-item:nth-child(2){
    background-image: url('{{ asset('img/spider.jpg') }}');
}


.lee-item:nth-child(5){
    background-image: url('{{ asset('img/STAN-LEE.jpg') }}');
}
</style>

</head>

<body>
    <button id="back-to-top" title="Volver Arriba">&#9650;</button>
    <div class="flex-wrapper">
        <div class="content-flex">
            <nav class="navbar navbar-expand-lg navbar-marvel animate__animated animate__slideInDown">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <div class="marvel">MARVEL</div>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('personajes.index') }}">Characters</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('destacados.index') }}">Famous Characters</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('comics.index') }}">Comics</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('eventos.index') }}">Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('creators.index') }}">Creators</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('series.index') }}">Series</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('stories.index') }}">Stories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tributo.index') }}">Stan lee</a>
                        </li>
                        <li class="nav-item">
                                <img  id="deadpool" src="http://riccardotartaglia.it/img/deadpool/deadpool.png" alt="Deadpool">
                        </li>
                        <!-- Agrega más elementos de navegación según sea necesario -->
                    </ul>
                </div>
            </nav>

            <div class="container-fluid p-5">
                @yield('content')
            </div>
        </div>
        <div class="footer animate__animated animate__slideInUp">
            © 2024 Application created by Jose Diego Junquera Lobon - 2DAW
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('additional-scripts')
        
</body>

</html>