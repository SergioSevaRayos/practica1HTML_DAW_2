# Importar Librerías: Local vs CDN

Cuando desarrollamos un proyecto web, una de las decisiones más comunes es cómo gestionar las dependencias externas. Las dos opciones principales son descargar las librerías en local o cargarlas mediante un CDN (*Content Delivery Network*).

---

## 📦 Librerías en Local

Consiste en descargar los archivos de la librería y servirlos desde el propio servidor o incluirlos en el bundle del proyecto.

### ✅ Ventajas

- **Control total sobre la versión**: la librería no cambia a menos que tú lo decidas, evitando actualizaciones inesperadas.
- **Disponibilidad offline**: el proyecto funciona sin conexión a internet, ideal para entornos de desarrollo o aplicaciones sin red.
- **Mayor seguridad**: no dependes de servidores externos; reduces el riesgo de ataques de cadena de suministro o modificaciones maliciosas.
- **Sin dependencia de terceros**: si el CDN cae o deja de dar soporte a una versión, tu aplicación no se ve afectada.
- **Integración con el proceso de build**: permite el *tree shaking*, minificación y otras optimizaciones en tiempo de compilación.
- **Cumplimiento de políticas de privacidad**: no se realizan peticiones a servidores externos, lo que facilita el cumplimiento del RGPD y normativas similares.

### ❌ Desventajas

- **Mayor tamaño del bundle**: incrementa el peso de los archivos que hay que desplegar y mantener.
- **Gestión manual de actualizaciones**: es necesario actualizar las librerías de forma explícita y supervisar vulnerabilidades.
- **Sin aprovechamiento de caché compartida**: cada usuario debe descargar la librería desde tu servidor, aunque ya la haya usado en otro sitio.
- **Mayor carga en el servidor propio**: todos los recursos se sirven desde tu infraestructura.

---

## 🌐 Librerías mediante CDN

Consiste en cargar la librería directamente desde una URL de un servidor externo especializado (por ejemplo, *jsDelivr*, *cdnjs*, *unpkg* o *Google Hosted Libraries*).

### ✅ Ventajas

- **Velocidad de carga**: los CDN tienen servidores distribuidos globalmente y sirven los archivos desde el nodo más cercano al usuario.
- **Caché compartida entre sitios**: si el usuario ya visitó otro sitio que usa la misma librería desde el mismo CDN, es probable que ya esté en su caché, mejorando el tiempo de carga.
- **Menor carga en tu servidor**: los recursos estáticos los sirve el CDN, liberando tu infraestructura.
- **Facilidad de uso**: basta con añadir una etiqueta `<script>` o `<link>` para empezar a usar la librería, sin instalación ni configuración de build.
- **Alta disponibilidad**: los CDN populares cuentan con redundancia y SLAs elevados.

### ❌ Desventajas

- **Dependencia de un tercero**: si el CDN tiene una caída o descontinúa el servicio, tu aplicación puede dejar de funcionar.
- **Riesgo de seguridad**: si el CDN es comprometido, podría servir código malicioso. Es fundamental usar **Subresource Integrity (SRI)** para mitigarlo.
- **Sin funcionamiento offline**: la aplicación no cargará la librería si no hay conexión a internet.
- **Menos control sobre la versión**: si se usa una URL sin versión fija (p. ej. `latest`), pueden introducirse cambios inesperados.
- **Posibles implicaciones de privacidad**: las peticiones a CDN externos pueden exponer la IP del usuario a terceros, lo que puede ser problemático bajo el RGPD.
- **Bloqueo por políticas de seguridad (CSP)**: configuraciones estrictas de *Content Security Policy* pueden bloquear recursos externos si no están explícitamente permitidos.

---

## 🔍 Comparativa Rápida

| Criterio                  | Local            | CDN              |
|---------------------------|------------------|------------------|
| Control de versión        | ✅ Total          | ⚠️ Depende de la URL |
| Funcionamiento offline    | ✅ Sí             | ❌ No             |
| Velocidad (primera carga) | ⚠️ Variable       | ✅ Generalmente mejor |
| Caché entre sitios        | ❌ No             | ✅ Sí             |
| Seguridad                 | ✅ Mayor control  | ⚠️ Requiere SRI   |
| Privacidad (RGPD)         | ✅ Sin peticiones externas | ❌ Exposición de IP |
| Optimización de build     | ✅ Tree shaking, minificación | ❌ Limitada |
| Facilidad de setup        | ⚠️ Requiere instalación | ✅ Solo una etiqueta |
| Dependencia de terceros   | ✅ Ninguna        | ❌ Alta           |

---

## 💡 Recomendación General

- Usa **CDN** para prototipos rápidos, demos o proyectos pequeños donde la velocidad de configuración es prioritaria.
- Usa **local** (junto con un gestor de paquetes como npm o yarn) para proyectos en producción donde necesitas control, seguridad y un pipeline de build robusto.
- Si usas CDN en producción, implementa siempre **Subresource Integrity (SRI)** y define versiones fijas en la URL.