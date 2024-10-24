@extends('layouts.app')

@section('content')
<h1>EVENTS</h1>
<div id="threeContainer" style="height: 100vh; margin: 0 auto; display: flex; justify-content: center; align-items: center"></div>
<div class="container mt-5">
    <div class="row">
        @foreach($eventosPerPage as $evento)
        <div class="col-md-4">
            <img src="{{ $evento['imagen'] }}" class="img-fluid" alt="Imagen del evento">
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body" style = "background: #EE171F ">
                    <h3 class="card-title">{{ $evento['nombre'] }}</h5>
                    <p class="card-text">{{ $evento['descripcion'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div id="pagination">
    {{ $eventosPerPage->links('vendor.pagination.bootstrap-5') }}
</div>
@endsection
@section('additional-scripts')  
<script>
document.addEventListener('DOMContentLoaded', () => {
    const eventos = @json($eventos);

    const scene = new THREE.Scene();
    const aspectRatio = window.innerWidth / window.innerHeight;
    const camera = new THREE.PerspectiveCamera(75, aspectRatio, 0.2, 1000);
    const renderer = new THREE.WebGLRenderer();
    renderer.setSize(window.innerWidth * 0.94, window.innerHeight);
    renderer.setClearColor(0x112031); // Establece el color de fondo del renderizador
    document.getElementById('threeContainer').appendChild(renderer.domElement);

    // Ajustes de responsividad
    function adjustCameraAndRenderer() {
        const width = window.innerWidth;
        const height = window.innerHeight;
        renderer.setSize(width * 0.94, height);
        camera.aspect = width / height;
        camera.updateProjectionMatrix();
        
        // Ajustar la posición de la cámara basándose en el nuevo tamaño
        const totalFilas = Math.ceil(eventos.length / esferasPorFila);
        camera.position.z = Math.max(30, totalFilas * distanciaEntreEsferas * 0.5);
        camera.position.y = -((Math.floor(eventos.length / esferasPorFila) / 2) * distanciaEntreEsferas);
    }

    window.addEventListener('resize', adjustCameraAndRenderer);

    const textureLoader = new THREE.TextureLoader();
    const esferas = []; // Para rotarlas después

    const esferasPorFila = 11;
    const distanciaEntreEsferas = 6;

    eventos.forEach((evento, index) => {
        textureLoader.load(evento.imagen, (texture) => {
            const geometry = new THREE.BoxGeometry(1, 4, 4);
            const material = new THREE.MeshBasicMaterial({ map: texture });
            const box = new THREE.Mesh(geometry, material);

            // Posición basada en el índice
            const fila = Math.floor(index / esferasPorFila);
            const columna = index % esferasPorFila;

            box.position.x = (columna - (esferasPorFila / 2)) * distanciaEntreEsferas + 3;
            box.position.y = -(fila * distanciaEntreEsferas);
            box.position.z = 0;

            scene.add(box);
            esferas.push(box); // Para referencia posterior
        });
    });

    adjustCameraAndRenderer(); // Llamada inicial para ajustes

    const animate = () => {
        requestAnimationFrame(animate);
        esferas.forEach(esfera => {
            esfera.rotation.y += 0.01;
        });
        renderer.render(scene, camera);
    };

    animate();
});
</script>

@endsection
