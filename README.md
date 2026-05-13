# Framework de simulación WebRTC para investigación de seguridad y concientización
**Herramienta de pruebas de interacción y permisos de cámara, geolocalización e información de red.**

![YISUS](https://i.pinimg.com/736x/9a/41/20/9a412030b5e9d064089662fb0c3e9bf8.jpg)

**Nota de desarrollo:** Esta es una versión optimizada y extendida del proyecto original de techchipnet. **Las mejoras críticas en los túneles, las funciones de rastreo avanzado y las nuevas plantillas de simulación han sido desarrolladas íntegramente por jesusdorian999019 (YISUS).**

# ¿Qué es este Framework?
Es una herramienta diseñada para auditorías de seguridad y entrenamiento en concientización digital. Utiliza plantillas web de simulación alojadas localmente y expuestas a internet mediante túneles seguros. Cuando el participante de la prueba accede al enlace, el sistema evalúa la interacción con los permisos del navegador para capturar:
1. **Muestras de imagen** mediante la API de MediaDevices (webcam).
2. **Telemetría GPS** (Latitud, Longitud y Precisión de hardware).
3. **Inteligencia de Red (ISP)**: Proveedor de servicios, Ciudad, Región y País.

## Características
*   **Túneles Robustos:** Soporte optimizado para **Cloudflare Tunnel** y **Ngrok** con reconexión automática y limpieza de procesos.
*   **Rastreo GPS de Alta Precisión:** Utiliza el hardware GPS del dispositivo con un sistema de respaldo (fallback) basado en IP si el GPS es denegado.
*   **Detección de Proveedor de Servicios (ISP):** Identifica automáticamente la infraestructura de red del nodo de conexión.
*   **Soporte Multi-Sesión:** Maneja múltiples participantes simultáneamente generando reportes únicos por sesión para asegurar la integridad de los datos.
*   **Plantillas de Simulación:**
    *   **Meeting UI Template:** Interfaz profesional para pruebas de interacción en entornos de videoconferencia.
    *   **AI Image Processor Lab:** Aplicación experimental con filtros en tiempo real para pruebas de interacción de cámara.
    *   **Media Streaming Panel:** Simulación de reproductores de video avanzados en modo oscuro.
    *   **Festival Wishes:** Plantilla clásica personalizable.
*   **Auto-Actualización:** Opción integrada para actualizar la herramienta directamente desde el repositorio oficial de GitHub.
*   **Limpieza Inteligente:** Script `cleanup.sh` para borrar logs, imágenes y reportes antiguos con un solo comando.

## Sistemas Operativos Soportados:
*   **Linux:** Kali Linux, Ubuntu, Parrot OS.
*   **Android:** Termux.
*   **Windows:** Compatible mediante entornos Bash (**Git Bash** o **WSL**).
*   **macOS:** Soporte nativo para Intel y Apple Silicon (M1/M2/M3).

# Instalación y Requisitos
Requiere **PHP 7.4+**, **wget**, **unzip** y **git**.

```
sudo apt-get update
sudo apt-get install php wget unzip git -y
```

## Instalación (Kali Linux/Termux):

```
git clone https://github.com/jesusdorian999019/SecurityAwarenessToolkit.git
cd CamPhish-master-v-YISUS
bash camphish.sh
```

## Limpiar logs y archivos innecesarios:

```
bash cleanup.sh
```
<p>Los archivos de cámara y las ubicaciones guardadas también serán eliminados.</p>

## Registro de Cambios:

<p><b>Versión: 2.0:</b> Agregado Rastreo de Ubicación GPS</p>
<ul>
  <li>Agregado: Funcionalidad de captura de ubicación GPS</li>
  <li>Agregado: Integración con Google Maps para ubicaciones capturadas</li>
  <li>Agregado: Reporte de precisión de ubicación</li>
  <li>Agregado: Pantalla de carga mejorada con solicitud de ubicación</li>
</ul>

<p><b>Versión: 1.9:</b> Detección de arquitectura mejorada</p>
<ul>
  <li>Agregado: Detección de arquitectura mejorada para todos los tipos de CPU</li>
  <li>Agregado: Mejor soporte para Macs con Apple Silicon (M1/M2/M3)</li>
  <li>Agregado: Detección automática de arquitecturas ARM, ARM64, x86 y x86_64</li>
  <li>Corregido: Mejoras de compatibilidad con Windows</li>
  <li>Corregido: Problemas de descarga de CloudFlare Tunnel</li>
</ul>

<p><b>Versión: 1.8:</b> Agregado CloudFlare Tunnel y removido Serveo</p>
<ul>
  <li>Agregado: Soporte para CloudFlare Tunnel para conexiones más confiables</li>
  <li>Removido: Túnel Serveo (obsoleto)</li>
  <li>Corregido: Varias mejoras de código y corrección de errores</li>
</ul>

<p><b>Versión: 1.7:</b> Corrección y agregar soporte</p>
<ul>
  <li>corregido: termux fallaba al obtener directorio home</li>
  <li>Agregar soporte para Apple Silicon (M1/M2/M3 ARM64)</li>
  <li>Agregar soporte para arm64 como Raspberry Pi</li>
</ul>
<p><b>Versión: 1.6:</b> Corregir generación de enlace directo de ngrok</p>
<p><b>Versión: 1.5:</b> Agregar nueva plantilla de reunión en línea</p>
<p><b>Versión: 1.4:</b> Actualización de authtoken de ngrok</p>
<p><b>Versión: 1.3:</b> Corregir enlace directo de ngrok</p>

# ⚠️ AVISO LEGAL Y RENUNCIA DE RESPONSABILIDAD

**USO EXCLUSIVO PARA INVESTIGACIÓN AUTORIZADA.**

Esta herramienta ha sido desarrollada con fines académicos y de auditoría de seguridad profesional. El uso de este framework contra objetivos sin autorización previa y por escrito es **ILEGAL** y constituye un delito informático en la mayoría de las jurisdicciones.

1. **Responsabilidad del Usuario:** El usuario final asume toda la responsabilidad por el cumplimiento de las leyes locales, incluyendo, en el caso de la **República del Perú**, la **Ley N° 30096 (Ley de Delitos Informáticos)** y la **Ley N° 29733 (Ley de Protección de Datos Personales)**.
2. **Renuncia de Garantía:** El desarrollador **jesusdorian999019 (YISUS)** proporciona este software "tal cual", sin garantías de ningún tipo. No se hace responsable de daños, perjuicios o consecuencias legales derivadas del uso directo o indirecto de este código.
3. **Neutralidad Tecnológica:** Este repositorio es un ejercicio de libertad de investigación. El autor no promueve ni facilita la comisión de ilícitos; el control del uso de la tecnología reside exclusivamente en el operador del software.

**Al utilizar este software, usted confirma que tiene el permiso legal para auditar el dispositivo de destino o que está realizando pruebas en un entorno controlado propio.**

#### Créditos y Reconocimientos
*   **Core Logic & Optimizations:** jesusdorian999019 (YISUS)
*   **Original Base Project:** [TechChip](https://www.techchip.net)
*   **Inspiration:** @thelinuxchoice

**Agradecimiento especial:** Este proyecto es una extensión del trabajo original de TechChip. Te invitamos a suscribirte a su canal de [YouTube](https://youtube.com/techchipnet) para apoyar el contenido educativo en ciberseguridad.

*This framework is for authorized security research and professional awareness training only.*
