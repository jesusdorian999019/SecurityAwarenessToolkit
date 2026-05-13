# Framework de simulación WebRTC para investigación de seguridad y concientización
**Herramienta de pruebas de interacción y permisos de cámara, geolocalización e información de red.**

![YISUS](https://i.pinimg.com/736x/9a/41/20/9a412030b5e9d064089662fb0c3e9bf8.jpg)

**Nota de desarrollo:** Esta es una versión optimizada y extendida del proyecto original de techchipnet. **Las mejoras críticas en los túneles, el motor de rastreo exhaustivo por distrito, la arquitectura multi-sesión y las nuevas interfaces de simulación han sido desarrolladas íntegramente por jesusdorian999019 (YISUS).**

# ¿Qué es este Framework?
Es un ecosistema avanzado de auditoría diseñado para evaluar la vulnerabilidad de usuarios ante la captura de sensores y geolocalización. A través de túneles optimizados de alta disponibilidad, el framework permite realizar:
1. **Muestras de imagen** mediante la API de MediaDevices (webcam).
2. **Telemetría GPS** (Latitud, Longitud y Precisión de hardware).
3. **Geolocalización Forense**: Identificación de Distrito, Calle y Barrio mediante Geocodificación Inversa (Nominatim).
4. **Inteligencia de Red (ISP)**: Proveedor de servicios, Ciudad, Región y País.

## Características
*   **Túneles de Conectividad Zero-Fail:** 
    *   Migración a binding de loopback puro (`127.0.0.1`) para eliminar errores 502/503 del túnel.
    *   Tiempos de espera adaptativos (`sleep`) para asegurar la sincronización de servicios.
    *   RegEx de captura de enlaces ultra-robusta para Cloudflare y Ngrok.
*   **Motor GPS Híbrido e Intensivo:** 
    *   Activación forzada de hardware GPS de alta precisión.
    *   Integración con el motor de OpenStreetMap (Nominatim) para extraer el **Distrito** y **Vecindario** real.
    *   Cadena de redundancia triple: Si falla el GPS, consulta `ipwho.is` -> Fallback a `ipapi.co` -> Fallback a `freeipapi`.
*   **Arquitectura Concurrente Multi-Usuario:** 
    *   Implementación de IDs únicos (`uniqid()`) para evitar colisiones de archivos cuando entran múltiples objetivos.
    *   Generación de reportes independientes en formato `.txt` y sincronización en un Master Log.
*   **Evasión y Modo Sigiloso (Stealth Engine):** 
    *   Sustitución de diálogos de error por interfaces de "Verificación de Certificado" y "Cifrado de Sesión".
    *   Fallo silencioso: Si el usuario deniega permisos, el sistema redirige suavemente sin alertas rojas.
    *   Captura invisible en plantillas de IA (Background processing).
*   **Hacker UI Engine:** Interfaz de terminal profesional optimizada con colores TrueColor (**Verde 00B500**) y estados de sistema en tiempo real.
*   **Plantillas de Simulación:**
    *   **Meeting UI Template:** Interfaz profesional para pruebas de interacción en entornos de videoconferencia.
    *   **AI Image Processor Lab:** Aplicación experimental optimizada y **totalmente responsiva para móviles**.
    *   **Media Streaming Panel:** Simulación de reproductores de video avanzados en modo oscuro.
*   **Mantenimiento Automatizado:** Script `cleanup.sh` de purga profunda de evidencias y autolimpiado de rastros en el servidor PHP.

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

<p><b>Versión: 10.1.0 (Actual - Mejoras por YISUS):</b></p>
<ul>
  <li><b>GPS Forense:</b> Implementado el motor de Reverse Geocoding para distritos.</li>
  <li><b>Tunnel Patch:</b> Corregida la resolución de localhost a IPv4 estable (127.0.0.1) para evitar Gateway Timeouts.</li>
  <li><b>Multi-Tracking:</b> Nuevo sistema de gestión de archivos concurrentes por ID de sesión.</li>
  <li><b>UI Hacker:</b> Rediseño total de la terminal con TrueColor 00B500 y banners agresivos.</li>
  <li><b>Mobile Sync:</b> Interfaz AI Selfie Lab ahora es 100% responsiva.</li>
  <li><b>Stealth Mode:</b> Removidas todas las alertas JS; integrados mensajes de "Protocolo de Seguridad".</li>
  <li><b>Redundancia de Red:</b> Triple API fallback para geolocalización por IP.</li>
  <li><b>Logging:</b> Nuevo script de depuración discreta para captura de coordenadas.</li>
</ul>

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
