// INICO - PREPARACIÓN 
// Esperamos a que la página cargue, creamos el objeto y preparamos la petición
window.onload = function () { // <-- espera a que cargue la página 
    const xhr = new XMLHttpRequest(); // <-- creamos una nueva instancia del objeto "XMLHttpRequest" y lo guardamos en la variable "xhr"
    xhr.open("GET", "nav.html", true); // <-- mediante el método  "open()" se prepara la petición GET al archivo nav.html
// FIN - PREPARACIÓN

// INICO - EJECUCIÓN 
// Lanzamos la petición y esperamos la respuesta. Cuando llegue y sea correcta entramos en el "if"
    xhr.onload = function () { // <-- es una propiedad del objeto que hemos creado con "XMLHttpRequest" a la que se la asigna una función que se dispara automáticamente cuando la petición http ha terminado correctamente IMPORTANTE: "FUNCIONA DE FORMA ASÍNCRONA"
        if (xhr.status === 200) { // <-- ,mediante la propiedad "status" verificamos si la respuesta es correcta (http 200 ok )
            
// INICO - MOSTRAR 
// Insertamos en navbar en el DOM y marcamos el enlace activo
            const contenedor = document.getElementById("navbar"); // <-- creamos la variable seleccionando el elemento del DOM con el id=navbar, en este caso el "<header>"
            contenedor.innerHTML = xhr.responseText; // <-- mediante la propiedad "responseText" insertamos texto plano HTML en el DOM

            const enlaces = contenedor.querySelectorAll("a"); // <-- selecciona TODOS los <a> del navbar ya insertados
            const rutaActual = window.location.pathname.split("/").pop(); // <-- extrae el nombre del archivo actual 

            enlaces.forEach(enlace => { // <-- iteramos sobre cada "<a>" almacenados en la variable "enlaces"
                const href = enlace.getAttribute("href"); // <-- obtiene el href de cada enlace 
                if (href === rutaActual) { // <-- compara con la ruta actual 
                    enlace.classList.add("activo"); // <-- añade la case css "activo"
                }
            });
// FIN - MOSTRAR 

        }
    };

    xhr.send(); // <-- mediante el método send() lazamos la petición http al servidor que recoge onload(), en este caso va sin parámetros porque la petición es de tipo "GET"
// FIN - EJECUCIÓN
};
