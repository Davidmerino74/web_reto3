// URL del feed RSS de ABC Cultura - Libros
var feedURL = 'https://www.abc.es/rss/2.0/cultura/libros/';

// Función para cargar el feed y mostrarlo en el contenedor
function cargarFeed() {
    fetch(`https://api.rss2json.com/v1/api.json?rss_url=${encodeURIComponent(feedURL)}`)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'ok') {
                mostrarFeed(data.items);
            } else {
                console.error('Error al obtener el feed.');
            }
        })
        .catch(error => {
            console.error('Error de red:', error);
        });
}

// Función para procesar la descripción y estructurarla en párrafos
function procesarDescripcion(texto) {
    // Dividir el texto en partes según los guiones largos `—` para crear párrafos
    const partes = texto.split('—').map(parte => parte.trim());
    // Crear párrafos HTML para cada parte manteniendo los guiones visibles
    return partes.map(parte => `<p>— ${parte}</p>`).join('');
}

// Función para mostrar el feed en el contenedor
function mostrarFeed(items) {
    const maxArticulos = 4; // Mostrar solo 4 artículos
    const contenedor = document.getElementById('blog-feed');//ob tiene el div del index.html
    
    items.slice(0, maxArticulos).forEach((item, index) => {
        // Crear el contenedor de cada artículo
        const contenedorArticulo = document.createElement('div');
        contenedorArticulo.classList.add('rss-item');//añadimos la clase css al contenedor para aplicar estilos
        contenedorArticulo.dataset.index = index;//guardamos el indice del artículo , útil para identificar cada bloque

        // Título del artículo
        const titulo = document.createElement('h2');
        titulo.textContent = item.title;

        // Enlace al artículo
        const enlace = document.createElement('a');
        enlace.href = item.link;
        enlace.textContent = 'Leer más';
        enlace.rel = 'noopener noreferrer';
        enlace.target = '_blank';

        // Imagen del artículo
        const imagen = document.createElement('img');
        const mediaContentUrl = item.media?.content?.url || item.enclosure?.link || 'IMAGENES RETO1/default.jpg';
        imagen.src = mediaContentUrl; // Usar URL de media:content o imagen por defecto
        imagen.alt = item.title;//define el texto alternativo con el titulo del artículo

        // Descripción recortada (procesada para incluir formato de párrafos)
        const descripcion = document.createElement('div');
        descripcion.classList.add('descripcion-recortada');
        descripcion.innerHTML = procesarDescripcion(item.description.substring(0, 150)) + '<p>...</p>';//solo mostramos los primeros 150 carácteres(modificable)

        // Descripción completa (procesada para incluir formato de párrafos)
        const descripcionCompleta = document.createElement('div');
        descripcionCompleta.classList.add('descripcion-completa');
        descripcionCompleta.innerHTML = procesarDescripcion(item.description);
        descripcionCompleta.style.display = 'none'; // Ocultada inicialmente

        // Evento para expandir el artículo y ocultar los demás
        contenedorArticulo.addEventListener('click', (e) => {
            e.stopPropagation(); // Evitar que el clic se propague al contenedor principal
            ocultarOtrosArticulos(index);
            contenedorArticulo.classList.add('expandido'); // Aplicar estilo expandido
            descripcionCompleta.style.display = 'block'; // Mostrar descripción completa
            descripcion.style.display = 'none'; // Ocultar descripción recortada
        });

        // Agregar los elementos al contenedor del artículo
        contenedorArticulo.appendChild(imagen);
        contenedorArticulo.appendChild(titulo);
        contenedorArticulo.appendChild(descripcion);
        contenedorArticulo.appendChild(descripcionCompleta);
        contenedorArticulo.appendChild(enlace);

        // Agregar el artículo al contenedor principal
        contenedor.appendChild(contenedorArticulo);
    });

    // Evento para restaurar todos los artículos al estado inicial
    document.body.addEventListener('click', () => {
        restaurarArticulos();
    });
}

// Función para ocultar los otros artículos
function ocultarOtrosArticulos(visibleIndex) {
    const articulos = document.querySelectorAll('.rss-item');
    articulos.forEach((articulo) => {
        if (parseInt(articulo.dataset.index) !== visibleIndex) {
            articulo.style.display = 'none';
        }
    });
}

// Función para restaurar todos los artículos al estado inicial
function restaurarArticulos() {
    const articulos = document.querySelectorAll('.rss-item');
    articulos.forEach((articulo) => {
        articulo.style.display = 'block';
        articulo.classList.remove('expandido'); // Quitar estilo expandido
        const descripcion = articulo.querySelector('.descripcion-recortada');
        const descripcionCompleta = articulo.querySelector('.descripcion-completa');
        descripcion.style.display = 'block';
        descripcionCompleta.style.display = 'none';
    });
}

// Cargar el feed cuando la página se carga completamente
window.addEventListener('load', cargarFeed);

