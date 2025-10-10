document.addEventListener("DOMContentLoaded", function(){
    const usuarios = [
        {
            id: 1,
            nombre: "Sergio",
            apellidos: "Seva Rayos",
            contraseña: "9400",
            prefijo: "+34",
            telefono: "633841203",
            email: "sergio@ejemplo.es",
            sexo: "Hombre"
        },
        {
            id: 2,
            nombre: "Pepe",
            apellidos: "Serna Escolano",
            contraseña: "1234",
            prefijo: "+34",
            telefono: "62461112",
            email: "pepe@ejemplo.es",
            sexo: "Hombre"
        },
        {
            id: 3,
            nombre: "Ana",
            apellidos: "Perez Soler",
            contraseña: "4321",
            prefijo: "+34",
            telefono: "645234332",
            email: "ana@ejemplo.es",
            sexo: "Mujer"
        }
    ]

    const tbody = document.getElementById("cuerpo-tabla")

    function renderizarTabla(datos) {
        tbody.innerHTML = '';
        datos.forEach(usuarios => {
            const fila = document.createElement("tr")

            fila.innerHTML = `
                <button class="btn-eliminar" title="Eliminar fila">x</button>
                <td>${usuarios.nombre}</td>
                <td>${usuarios.apellidos}</td>
                <td>${usuarios.prefijo + usuarios.telefono}</td>
                <td>${usuarios.email}</td>
                <td>${usuarios.sexo}</td>
            `
            tbody.appendChild(fila)
        });
    }
    renderizarTabla(usuarios)

    tbody.addEventListener("click", function (event) {
        if (event.target.classList.contains("btn-eliminar")) {
            const filaEliminar = event.target.closest("tr")
            filaEliminar.remove()
        }
    })

    const filtroInput = document.getElementById("filtro")

    filtroInput.addEventListener("keyup", function () {
        const textoBusqueda = filtroInput.value.trim().toLowerCase()

        if (textoBusqueda.length >=2) {
            const usuariosFiltrados = usuarios.filter(usuarios =>{
                const nombreCompleto = `${usuarios.nombre} ${usuarios.apellidos}`.toLowerCase()
                return nombreCompleto.includes(textoBusqueda)
            })
            renderizarTabla(usuariosFiltrados)
        }else{
            renderizarTabla(usuarios)
        }
    })

})
