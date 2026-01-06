window.onload = function () {
    const xhr = new XMLHttpRequest();

    xhr.open("GET", "nav.html", true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            const contenedor = document.getElementById("navbar");
            contenedor.innerHTML = xhr.responseText;

            const enlaces = contenedor.querySelectorAll("a");
            const rutaActual = window.location.pathname.split("/").pop();

            enlaces.forEach(enlace => {
                const href = enlace.getAttribute("href");
                if (href === rutaActual) {
                    enlace.classList.add("activo");
                }
            });

        }
    };

    xhr.send();
};