document.addEventListener("DOMContentLoaded", function () {

    let usuarios = [];

    const cuerpoTabla = document.getElementById("cuerpo-tabla");
    const filtroInput = document.getElementById("filtro");
    const formEditar = document.getElementById("form-editar");
    const cancelarBtn = document.getElementById("cancelar-edicion");

    function renderizarTabla(lista, textoFiltro = "") {
        if (!cuerpoTabla) return;

        cuerpoTabla.innerHTML = "";

        lista.forEach(usuario => {
            const tr = document.createElement("tr");

            const nombre = resaltarTexto(usuario.nombre, textoFiltro);
            const apellidos = resaltarTexto(usuario.apellidos, textoFiltro);
            const telefono = resaltarTexto(usuario.telefono, textoFiltro);
            const email = resaltarTexto(usuario.email, textoFiltro);


            tr.innerHTML = `
            <td>${nombre}</td>
            <td>${apellidos}</td>
            <td>${telefono}</td>
            <td>${email}</td>
            <td>${usuario.sexo ?? ""}</td>
            <td>
                <button data-id="${usuario.id}" class="eliminar">Eliminar</button>
                <button data-id="${usuario.id}" class="modificar">Modificar</button>
            </td>
        `;

            cuerpoTabla.appendChild(tr);
        });
    }


    function cargarUsuarios() {
        if (!cuerpoTabla) return;

        const xhr = new XMLHttpRequest();
        xhr.open("GET", "ws/getUsuario.php", true);
        xhr.responseType = "json";

        xhr.onload = function () {
            if (xhr.status === 200 && xhr.response?.success) {
                usuarios = xhr.response.data;
                renderizarTabla(usuarios);
            }
        };

        xhr.send();
    }

    if (cuerpoTabla) {
        cuerpoTabla.addEventListener("click", e => {
            const boton = e.target.closest("button");
            if (!boton) return;

            const id = parseInt(boton.dataset.id);
            if (isNaN(id)) return;

            if (boton.classList.contains("modificar")) {
                mostrarFormularioEdicion(id);
            }

            if (boton.classList.contains("eliminar")) {
                if (confirm("¿Eliminar usuario?")) {
                    eliminarUsuario(id);
                }
            }
        });
    }



    if (filtroInput) {
        filtroInput.addEventListener("keyup", () => {
            const texto = filtroInput.value.toLowerCase();

            if (texto.length >= 3) {
                const filtrados = usuarios.filter(u =>
                    `${u.nombre} ${u.apellidos} ${u.telefono} ${u.email}`.toLowerCase().includes(texto)
                );
                renderizarTabla(filtrados, texto);
            } else {
                renderizarTabla(usuarios, "");
            }
        });
    }
    function resaltarTexto(texto, filtro) {
        if (!texto || !filtro) return texto ?? "";

        // Escapar caracteres especiales de RegExp
        const filtroSeguro = filtro.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");

        const regex = new RegExp(`(${filtroSeguro})`, "gi");
        return texto.toString().replace(regex, `<span class="resaltado">$1</span>`);
    }




    function mostrarFormularioEdicion(id) {
        const usuario = usuarios.find(u => u.id === id);
        if (!usuario || !formEditar) return;

        document.getElementById("edit-id").value = usuario.id;
        document.getElementById("edit-nombre").value = usuario.nombre;
        document.getElementById("edit-apellidos").value = usuario.apellidos;
        document.getElementById("edit-telefono").value = usuario.telefono;
        document.getElementById("edit-email").value = usuario.email;
        document.getElementById("edit-sexo").value = usuario.sexo;
        document.getElementById("edit-fecha").value = usuario.fecha_nacimiento;

        formEditar.style.display = "block";
    }

    if (formEditar) {
        formEditar.addEventListener("submit", e => {
            e.preventDefault();

            const usuario = {
                id: parseInt(document.getElementById("edit-id").value, 10),
                nombre: document.getElementById("edit-nombre").value,
                apellidos: document.getElementById("edit-apellidos").value,
                telefono: document.getElementById("edit-telefono").value,
                email: document.getElementById("edit-email").value,
                sexo: document.getElementById("edit-sexo").value,
                fecha_nacimiento: document.getElementById("edit-fecha").value
            };


            enviarModificacion(usuario);
        });
    }

    if (cancelarBtn) {
        cancelarBtn.addEventListener("click", () => {
            formEditar.style.display = "none";
        });
    }

    function enviarModificacion(usuario) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "ws/modificarUsuario.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function () {
            const res = JSON.parse(xhr.responseText);
            if (res.success) {
                usuarios = usuarios.map(u =>
                    u.id == usuario.id
                        ? { ...u, ...usuario }
                        : u
                );

                formEditar.style.display = "none";
                renderizarTabla(usuarios);
            }
        };

        xhr.send(
            `id=${usuario.id}&nombre=${usuario.nombre}&apellidos=${usuario.apellidos}&telefono=${usuario.telefono}&email=${usuario.email}&sexo=${usuario.sexo}&fecha_nacimiento=${usuario.fecha_nacimiento}`
        );
    }

    function eliminarUsuario(id) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "ws/deleteUsuario.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function () {
            const res = JSON.parse(xhr.responseText);
            if (res.success) {
                usuarios = usuarios.filter(u => u.id !== id);
                renderizarTabla(usuarios);
            }
        };

        xhr.send(`id=${id}`);
    }

    cargarUsuarios();
});