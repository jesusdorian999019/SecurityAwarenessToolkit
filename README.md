# Enviar mi ubicación – Herramienta educativa

## Descripción
`send_location.php` es una **aplicación web PHP** que permite al usuario introducir coordenadas de latitud/longitud (simuladas) y, después de conceder permiso de geolocalización al navegador, muestra un mapa interactivo de **OpenStreetMap** mediante **Leaflet**.  La interfaz está estilizada con **Bootstrap 5** para que parezca una herramienta real.

## Características
- **Formulario seguro** con protección CSRF y validación numérica.
- **Prevención de fijación de sesión** (`session_regenerate_id`).
- **Permiso de geolocalización**: el mapa solo se renderiza si el usuario permite el acceso a su ubicación.
- **Registro de envíos** (`logs/send_location.log`) – funciona en Windows, Linux, Kali y Termux.
- **Reset de sesión** para volver a introducir coordenadas.
- **Aspecto profesional** gracias a Bootstrap y a una disposición responsive.

## Requisitos
| Sistema | Necesario |
|---------|-----------|
| Windows | Servidor web con PHP (XAMPP, WAMP, IIS, etc.) |
| Linux / Kali / Termux | PHP ≥ 7.4 y un servidor web (Apache, Nginx o el servidor embebido `php -S`) |
| Navegador | Compatibilidad con la **Permissions API** y **Geolocation API** (Chrome, Firefox, Edge, etc.) |

## Instalación
1. Copia la carpeta `SecurityAwarenessToolkit` al directorio raíz de tu servidor web.
2. Asegúrate de que PHP tiene permiso para crear carpetas y escribir en `SecurityAwarenessToolkit/logs/`.
   ```bash
   # en Linux / Termux
   cd "d:/codigo/ANTE CASO DE HACKERS, USAR ESTA CARPETA/v1/SecurityAwarenessToolkit"
   chmod -R 755 .
   ```
3. (Opcional) Crea un **host virtual** o simplemente usa el servidor embebido:
   ```bash
   php -S 127.0.0.1:8000
   # abre http://127.0.0.1:8000/send_location.php en el navegador
   ```

## Uso
1. Accede a `send_location.php`.
2. Introduce latitud y longitud (por ejemplo `-34.6037` y `-58.3816`).
3. Pulsa **Enviar coordenadas**.
4. El navegador mostrará un cuadro de permiso de ubicación.  Si lo aceptas, aparecerá el mapa centrado en las coordenadas.
5. Si lo rechazas, verás un mensaje de error indicando que se necesita permiso.
6. Usa el enlace **Cambiar coordenadas** o `?reset=1` para volver al formulario.

## Registro de actividad
Cada envío exitoso se guarda en `logs/send_location.log` con formato ISO‑8601, por ejemplo:
```
2026-11-06T00:46:23+00:00 - lat=-34.6037, lon=-58.3816
```
Puedes revisar este archivo en cualquier sistema (Windows Explorer, `cat` en Linux/Termux, etc.).

## Integración con el resto del proyecto
Se incluye `index.php` que ofrece un menú sencillo para acceder tanto a `location.php` (antigua función) como a la nueva `send_location.php`.

---
*Este código está pensado con fines educativos y científicos; no envía datos reales a terceros.*