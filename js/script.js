/**
 * @file script.js
 * @description Lógica principal para la gestión de una tabla de usuarios interactiva.
 * Incluye funcionalidades para renderizar datos, eliminar filas y filtrar en tiempo real.
 * @author Sergio Seva 
 * @version 1.0
 */

/**
 * Evento principal qeu se dispara cuando el DOM está completamente cargado y listo.
 * Todo el código de la aplicación se ejecuta dentro de esta función para asegurar
 * que todos los elementos HTML necesarios existen antes de intentar manipularlos.
 */
document.addEventListener("DOMContentLoaded", function () {


    /**
     * Array de objetos que contiene los datos iniciales de los usuarios.
     * @constant 
     * @type {Object[]}
     */
    const usuarios = [
        {
            id: 1,
            nombre: "Sergio",
            apellido: "Seva Rayos",
            contrasena: "9400",
            telefono: "633841203",
            email: "sergio@ejemplo.es",
            sexo: "Hombre"
        },
        {
            id: 2,
            nombre: "Pepe",
            apellido: "Serna Escolano",
            contrasena: "1234",
            telefono: "620461112",
            email: "pepe@ejemplo.es",
            sexo: "Hombre"
        },
        {
            id: 3,
            nombre: "Ana",
            apellido: "Perez Soler",
            contrasena: "4321",
            telefono: "645234332",
            email: "ana@ejemplo.es",
            sexo: "Mujer"
        }
    ]


    /**
     * Constante que almacena la referencia al elemento <tbody> de la tabla.
     * 
     * Se guarda en una variable para mejorar el rendimiento, evitando tener que 
     * buscar el elemento en el DOM cada vez que se necesite manipular la tabla.
     * @constant
     * @type {HTMLTableSectionElement}
     */
    const tbody = document.getElementById("cuerpo-tabla")
    /**
     * Renderiza las filas de la tabla de usuarios en el DOM.
     * Esta función primero limpia completamente el contenido actual del <tbody> de la tabla
     * para evitar duplicados. Luego, itera sobre el array de usuarios proporcionado y, 
     * por cada usuario, crea una nueva fila (<tr>), la rellena con sus datos y la
     * añade al final de la tabla.
     * @param {Object[]} datos - Un array de objetos, donde cada objeto representa a un 
     * usuario y contiene sus datos.
     * @returns {void} No devuelve ningún valor. 
     */
    function renderizarTabla(datos) {
        if (tbody) {
            tbody.innerHTML = '';
            datos.forEach(usuarios => {
                const fila = document.createElement("tr")

                fila.innerHTML = `
                <td>
                    <button class="btn-eliminar" title="Eliminar fila">x</button>
                </td>
                <td>${usuarios.nombre}</td>
                <td>${usuarios.apellido}</td>
                <td>${usuarios.telefono}</td>
                <td>${usuarios.email}</td>
                <td>${usuarios.sexo}</td>
            `
                tbody.appendChild(fila)
            });
        }

    }

    /**
     * Constante que almacena la referencia al elemento <tbodyResumen> de la tabla.
     * 
     * Se guarda en una variable para mejorar el rendimiento, evitando tener que 
     * buscar el elemento en el DOM cada vez que se necesite manipular la tabla.
     * @constant
     * @type {HTMLTableSectionElement}
     */
    const tbodyResumen = document.getElementById("cuerpo-tabla-resumen")
    /**
     * Renderiza las filas de la tabla resumen de usuarios en el DOM.
     * Esta función primero limpia completamente el contenido actual del <tbody> de la tabla
     * para evitar duplicados. Luego, itera sobre el array de usuarios proporcionado y, 
     * por cada usuario, crea una nueva fila (<tr>), la rellena con sus datos y la
     * añade al final de la tabla.
     * @param {Object[]} datos - Un array de objetos, donde cada objeto representa a un 
     * usuario y contiene sus datos.
     * @returns {void} No devuelve ningún valor. 
     */
    function renderizarTablaResumen(datos) {
        if (tbodyResumen) {
            tbodyResumen.innerHTML = '';
            datos.forEach(usuarios => {
                const fila = document.createElement("tr")
                fila.innerHTML = `
                <td>${usuarios.nombre}</td>
                <td>${usuarios.apellido}</td>
                <td>${usuarios.telefono}</td>
                <td>${usuarios.email}</td>
                <td>${usuarios.sexo}</td>
            `
                tbodyResumen.appendChild(fila)
            });
        }

    }


    /**
     * Añade un escuchador de eventos al <tbody> para gestionar los clics en los botones de eliminar.
     * Utiliza la delegación de eventos para manejar todos los clics de forma eficiente.
     * @param {event} - El objeto del evento click
     */
    if (tbody) {
        tbody.addEventListener("click", function (event) {
            if (event.target.classList.contains("btn-eliminar")) {
                const filaEliminar = event.target.closest("tr")
                filaEliminar.remove()
            }
        })
    }



    /**
     * Constante que almacena la referencia al campo de texto (input) usado para filtrar la tabla.
     *
     * Almacenar este elemento en una constante permite un acceso rápido y eficiente
     * para leer su valor cada vez que el usuario pulsa una tecla en el evento 'keyup'.
     * @const
     * @type {HTMLInputElement}
     */
    const filtroInput = document.getElementById("filtro")

    /**
     * Añade un escuchador al input del filtro qu se activa con cada tecla leventada (keyup).
     * Filtra el array de usuarios según el texto introducido y vuelve a renderizar la tabla.
     */
    if (filtroInput) {
        filtroInput.addEventListener("keyup", function () {
            const textoBusqueda = filtroInput.value.trim().toLowerCase()

            if (textoBusqueda.length >= 2) {
                const usuariosFiltrados = usuarios.filter(usuarios => {
                    const nombreCompleto = `${usuarios.nombre} ${usuarios.apellido}`.toLowerCase()
                    return nombreCompleto.includes(textoBusqueda)
                })
                renderizarTabla(usuariosFiltrados)
            } else {
                renderizarTabla(usuarios)
            }
        })
    }


    // Llama a la función por primera vez para poblar la tabla con todos los datos iniciales al cargar la página. 
    renderizarTabla(usuarios)
    renderizarTablaResumen(usuarios)

})
