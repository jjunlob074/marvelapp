//Proyecto Marvel//

/Primeros Pasos/
Crear la Base de Datos
Crea una base de datos llamada marvel.
Ejecuta el comando php artisan migrate para realizar la migración de las tablas. Esto creará las tablas necesarias para los tipos de contenido: Personajes, Eventos y Creadores.

/Importar Datos a la Base de Datos/

*Personajes y Eventos*
posicionate en la raíz del proyecto
Utiliza el comando php artisan app:fetch-marvel-characters para traer datos de personajes desde la API de Marvel.
Para los eventos, el comando es php artisan app:fetch-marvel-events, funcionando de manera análoga al de personajes.
*Creadores*
Primero ejecuta php artisan serve y en la url de inicio añade la siguiente url:
Accede a la URL /fetch-creadores para traer y almacenar datos de creadores en la base de datos a través de un controlador
Tardará un ratito porque son cerca de 6000, pero te avisará en la pantalla cuando termine.

/Servicios para Contenidos Adicionales/
Para contenidos con gran cantidad de ítems como cómics, stories, y series, se utilizan servicios. Los métodos implementados incluyen:
getFeaturedComics()
searchComics($query)
getComicById($id)

Son análogos para los demás tipos de contenido

¡NOTA!-> AL SER UNA WEB DE PRUEBA SE HA QUERIDO REALIZAR LAS COSAS DE MUCHAS FORMAS DIFERENTES PARA ILUSTRAR MÚLTIPLES FORMAS DE RESOLVER UN PROBLEMA

/Consideraciones sobre Traer Datos de la API con Servicios vs Almacenamiento en Base de Datos/

Traer datos por servicio ofrece actualización en tiempo real y menor almacenamiento local, pero depende de la disponibilidad de la API y puede tener límites de uso.
Almacenamiento en base de datos proporciona mayor control y rendimiento mejorado, pero requiere sincronización manual y puede llevar a información desactualizada.

/Librerías de JavaScript y CSS Utilizadas/
#CSS
#Bootstrap CSS
#Animate.css
#Leaflet CSS

/JavaScript/
#Leaflet JS
#Three.js
#ScrollReveal
#jQuery
#Popper.js
#Bootstrap JS

/Funcionalidades/

#Diversas funcionalidades de JavaScript y librerías.
#Manipulación de datos para visualización.
#Búsqueda de contenido adaptado.
#Gestión de "me gusta" en Creadores usando Cookies de Laravel.
#Diseño responsive.
#Paginación custom con Bootstrap.
#Efecto Parallax en "Famous Characters".

/Gestión de Assets/
Todos los assets están en la carpeta public para mayor facilidad de correción.
Una mejora futura podría ser usar Vite integrado en Laravel para la compilación de estos assets.

/Datos Relevantes/
La aplicación está diseñada para funcionar tanto con php artisan serve como en localhost con Apache, aunque se recomienda usar php artisan serve ya que se
ha maquetado usando el servidor integrado de laravel y la apariencia visual difiere un poco.

/Uso de la Aplicación/
Se realizará un video para ilustrar el uso de la web.
ENLACE DE YOUTUBE:
https://youtu.be/eeFkdxQ6ujs

Este README proporciona una guía clara sobre cómo configurar y usar el proyecto Marvel, incluyendo la preparación de la base de datos, la importación de datos, las librerías utilizadas, las funcionalidades principales, la gestión de assets, y consejos para una mejor experiencia de usuario.

