# CamPhish
**Captura de cámara, ubicación GPS exacta e información de red con ingeniería social avanzada.**

![CamPhish](https://techchip.net/wp-content/uploads/2020/04/camphish.jpg)

**Nota importante:** Esta es una versión optimizada y extendida del proyecto original de techchipnet. **Las mejoras críticas en los túneles, las funciones de rastreo avanzado y las nuevas plantillas de alta fidelidad han sido desarrolladas íntegramente por jesusdorian999019 (YISUS - mi bro).**

# ¿Qué es CamPhish?
CamPhish es una herramienta de ingeniería social diseñada para auditorías de seguridad. Utiliza sitios web falsos (phishing) alojados localmente y expuestos a internet mediante túneles seguros. Cuando una víctima accede al enlace, la herramienta solicita permisos para capturar:
1. **Fotos en ráfaga** de la cámara frontal o webcam.
2. **Ubicación GPS exacta** (Latitud, Longitud, Altitud y Precisión).
3. **Inteligencia de Red (ISP)**: Operadora, Ciudad, Región y País.

## Características
*   **Túneles Robustos:** Soporte optimizado para **Cloudflare Tunnel** y **Ngrok** con reconexión automática y limpieza de procesos.
*   **Rastreo GPS de Alta Precisión:** Utiliza el hardware GPS del dispositivo con un sistema de respaldo (fallback) basado en IP si el GPS es denegado.
*   **Detección de Operadora (ISP):** Identifica automáticamente la empresa de internet, distrito y región de la víctima.
*   **Soporte Multi-Usuario:** Maneja múltiples víctimas simultáneamente generando archivos de reporte únicos para cada una, evitando colisiones de datos.
*   **Plantillas de Alta Fidelidad:**
    *   **Google Meet Clone:** Interfaz idéntica con participantes reales (video) y controles funcionales.
    *   **AI Selfie Lab:** Una aplicación moderna de "IA" con filtros en tiempo real para incentivar el uso de la cámara.
    *   **YouTube Live:** Panel de YouTube en modo oscuro con video en vivo integrado.
    *   **Festival Wishes:** Plantilla clásica personalizable.
*   **Auto-Actualización:** Opción integrada para actualizar la herramienta directamente desde el repositorio oficial de GitHub.
*   **Limpieza Inteligente:** Script `cleanup.sh` para borrar logs, imágenes y reportes antiguos con un solo comando.

## Sistemas Operativos Soportados:
*   **Linux:** Kali, Ubuntu, Parrot, etc.
*   **Android:** Termux.
*   **Windows:** Compatible mediante **Git Bash** o **WSL**.
*   **macOS:** Soporte nativo para Intel y Apple Silicon (M1/M2/M3).

# Instalación y Requisitos
Requiere **PHP 7.4+**, **wget**, **unzip** y **git**.

```
sudo apt-get update
sudo apt-get install php wget unzip git -y
```

## Instalación (Kali Linux/Termux):

```
git clone https://github.com/jesusdorian999019/CamPhish-master-v-YISUS.git
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

# ⚠️ ADVERTENCIA LEGAL Y DESLINDE DE RESPONSABILIDAD (PERÚ)

**CLÁUSULA DE EXCLUSIÓN DE RESPONSABILIDAD PARA EL DESARROLLADOR.**

El autor **jesusdorian999019 (YISUS)** publica este software bajo el principio de **Neutralidad Tecnológica**. El código fuente aquí expuesto es un trabajo de investigación en ciberseguridad y no constituye, por sí mismo, una actividad ilícita. Al acceder a este repositorio, el usuario acepta que el desarrollador queda **blindado y exonerado** de toda responsabilidad civil, penal o administrativa según las leyes de la **República del Perú**.

### 1. Marco Jurídico de Protección al Creador
*   **Código Civil - Art. 1969 y 1970 (Responsabilidad Extracontractual):** El autor no causa daño doloso ni culposo al publicar código fuente. La responsabilidad recae exclusivamente en el agente (usuario) que utiliza la herramienta para ejecutar un acto lesivo. El creador no tiene el control ni la vigilancia sobre las acciones de terceros.
*   **Ley N° 30096 - Ley de Delitos Informáticos:** 
    *   **Art. 2 (Acceso Ilícito):** El que accede indebidamente a todo o parte de un sistema informático será reprimido con pena privativa de libertad.
    *   **Art. 3 (Atentado a la integridad de datos):** El que daña, borra o deteriora datos informáticos.
    *   **Art. 10 (Abuso de mecanismos y dispositivos informáticos):** El uso de dispositivos o programas diseñados para la comisión de delitos informáticos.
*   **Decreto Legislativo 822 - Ley sobre el Derecho de Autor:** El autor ejerce su derecho a la libre creación y publicación de software como obra literaria/técnica. La publicación de vulnerabilidades o herramientas de prueba es parte del ejercicio de la libertad de investigación científica.
*   **Ley N° 29733 (Protección de Datos):** El desarrollador **no recolecta, almacena ni procesa** los datos obtenidos por los usuarios de este script. No existe una base de datos centralizada; toda información capturada se aloja en el entorno local del usuario, siendo este el único "Titular del Banco de Datos" ante la ANPDP.

### 2. Exoneración de Responsabilidad
1. **Uso Dual:** CamPhish es una herramienta de doble uso. Su propósito legítimo es el Pentesting Ético y la Educación. El desarrollador no induce, promueve ni facilita la comisión de delitos.
2. **Garantía "AS IS":** El software se entrega "tal cual", sin garantías de ningún tipo. El autor no es responsable de daños directos, indirectos o incidentales derivados del uso del script.
3. **Jurisdicción:** Cualquier intento de acción legal contra el autor será nulo, dado que la publicación de código abierto está protegida por la libertad de expresión y de cátedra (Art. 2, inciso 4 y 8 de la Constitución).

**ADVERTENCIA FINAL:** Si utilizas este software para actividades no autorizadas, estás violando la ley por cuenta propia. El creador ha diseñado este código para que aprendas a defenderte de los atacantes, no para que te conviertas en uno.

---
#### Créditos y Reconocimientos
*   **Desarrollo de Mejoras Pro:** [jesusdorian999019 (YISUS)](https://github.com/jesusdorian999019)
*   **Proyecto Original:** techchipnet
*   **Inspirado en:** @thelinuxchoice

#### Suscríbete para más contenido ético: <a href="http://youtube.com/techchipnet">Canal de YouTube TechChip</a>
