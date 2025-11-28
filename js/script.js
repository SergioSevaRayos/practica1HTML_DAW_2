document.addEventListener("DOMContentLoaded", function () {

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

    const tbody = document.getElementById("cuerpo-tabla")

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


    if (tbody) {
        tbody.addEventListener("click", function (event) {
            if (event.target.classList.contains("btn-eliminar")) {
                const filaEliminar = event.target.closest("tr")
                filaEliminar.remove()
            }
        })
    }


    const filtroInput = document.getElementById("filtro")

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

    renderizarTabla(usuarios)

})
