// Event listener para el flip de las tarjetas al cargar el DOM
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.flip-container').forEach(container => {
        container.addEventListener('click', function() {
            this.querySelector('.card').classList.toggle('flip-js');
        });
    });

   

    // Mostrar o ocultar el botón "Volver arriba" según el desplazamiento
    window.onscroll = function() {
        scrollFunction();
    };

    function scrollFunction() {
        var button = document.getElementById("back-to-top");
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            button.style.display = "block";
        } else {
            button.style.display = "none";
        }
    }

    // Volver al principio al hacer clic en el botón "Volver arriba"
    document.getElementById("back-to-top").addEventListener("click", function() {
        document.body.scrollTop = 0; // Para Safari
        document.documentElement.scrollTop = 0; // Para Chrome, Firefox, IE y Opera
    });

     // Configuración de ScrollReveal para las tarjetas de series
     ScrollReveal().reveal('.series-card-index', { 
        duration: 1000, // Duración de la animación: 1 segundo
        easing: 'cubic-bezier(0.5, 0, 0, 0.1)', // Función de aceleración
        origin: 'bottom', // Origen de la animación
        distance: '200px', // Distancia de desplazamiento
        interval: 500 // Intervalo entre elementos
    });

    // Configuración básica de ScrollReveal para otras tarjetas
    ScrollReveal().reveal('.card', { 
        duration: 300, // Duración de la animación: 0.3 segundos
        easing: 'cubic-bezier(0.5, 0, 0, 1)', // Función de aceleración
        interval: 100 // Intervalo entre elementos
    });
});


