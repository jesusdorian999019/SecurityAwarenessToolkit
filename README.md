# CamPhish
Captura fotos de la cámara frontal del teléfono o webcam de la PC de la víctima enviando solo un enlace.
![CamPhish](https://techchip.net/wp-content/uploads/2020/04/camphish.jpg)

**Nota importante:** Este proyecto ha sido modificado para mejorar la compatibilidad y funcionamiento con Cloudflare Tunnel. El proyecto original pertenece a techchipnet y se puede encontrar en [https://github.com/techchipnet/CamPhish](https://github.com/techchipnet/CamPhish). No somos los autores originales.

# ¿Qué es CamPhish?
<p>CamPhish es una técnica para tomar fotos de la cámara frontal del teléfono o la webcam de la PC de la víctima. CamPhish aloja un sitio web falso en un servidor PHP integrado y usa Ngrok y CloudFlare Tunnel para generar un enlace que enviaremos a la víctima, el cual se puede usar en internet. El sitio web solicita permiso para la cámara y si la víctima lo permite, esta herramienta captura fotos de la cámara del dispositivo de la víctima.

Se ha agregado una función de captura de ubicación GPS.</p>

## Características
<p>En esta herramienta agregué dos plantillas automáticas de páginas web para mantener a la víctima comprometida en la página y obtener más fotos de la cámara</p>
<ul>
  <li>Deseos de Festival</li>
  <li>TV en Vivo de YouTube</li>
  <li>Reunión en Línea [Beta]</li>
  <li>Rastreo de Ubicación GPS</li>
</ul>
<p>Se ha agregado un script de limpieza para eliminar todos los archivos y logs innecesarios.</p>

## Esta Herramienta se Probó En:
<ul>
  <li>Kali Linux</li>
  <li>Termux</li>
  <li>MacOS</li>
  <li>Ubuntu</li>
  <li>Parrot Sec OS</li>
  <li>Windows (WSL)</li>
</ul>

# Instalación y Requisitos
<p>Esta herramienta requiere PHP para el servidor web y wget para descargar dependencias. Primero ejecuta el siguiente comando en tu terminal</p>

```
apt-get -y install php wget unzip
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

### Aviso Importante
La reubicación no autorizada de este proyecto está prohibida.

#### Para Más Videos suscríbete al <a href="http://youtube.com/techchipnet">Canal de YouTube TechChip</a>
<p>CamPhish se crea para ayudar en pruebas de penetración y no es responsable de ningún mal uso o propósitos ilegales.</p>
<p>CamPhish está inspirado en https://github.com/thelinuxchoice/ Grandes gracias a @thelinuxchoice</p>
