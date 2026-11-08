<?php
// send_location.php - original version restored
// Simple educational tool: input latitude/longitude, then show OpenStreetMap after geolocation permission.

session_start();

// If coordinates are posted, store them in session and redirect (PRG)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lat']) && isset($_POST['lon'])) {
    $_SESSION['lat'] = trim($_POST['lat']);
    $_SESSION['lon'] = trim($_POST['lon']);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Enviar mi ubicación</title>
    <style>
        body {font-family: Arial, sans-serif; margin: 20px;}
        .error {color: red;}
        #map { height: 400px; margin-top: 20px; }
    </style>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-sA+e2R0k2J5F+0KpKx1r4pJ7GQy0Gx7b7h3Gf9a0f5w=" crossorigin=""/>
</head>
<body>
<h1>Enviar mi ubicación</h1>
<?php if (!isset($_SESSION['lat']) || !isset($_SESSION['lon'])): ?>
    <form method="post" action="">
        <label for="lat">Latitud:</label><br>
        <input type="text" id="lat" name="lat" required placeholder="e.g., -34.6037"><br><br>
        <label for="lon">Longitud:</label><br>
        <input type="text" id="lon" name="lon" required placeholder="e.g., -58.3816"><br><br>
        <button type="submit">Enviar coordenadas</button>
    </form>
<?php else: ?>
    <p>Coordenadas recibidas: <strong><?php echo htmlspecialchars($_SESSION['lat']); ?></strong>, <strong><?php echo htmlspecialchars($_SESSION['lon']); ?></strong></p>
    <div id="map"></div>
    <script>
        // Request geolocation permission before loading the map
        function initMap() {
            var map = L.map('map').setView([<?php echo $_SESSION['lat']; ?>, <?php echo $_SESSION['lon']; ?>], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);
            L.marker([<?php echo $_SESSION['lat']; ?>, <?php echo $_SESSION['lon']; ?>]).addTo(map)
                .bindPopup('Ubicación simulada').openPopup();
        }

        if (navigator.permissions) {
            navigator.permissions.query({name: 'geolocation'}).then(function(status) {
                if (status.state === 'granted') {
                    initMap();
                } else if (status.state === 'prompt') {
                    navigator.geolocation.getCurrentPosition(function() { initMap(); }, function() {
                        document.getElementById('map').innerHTML = '<p class="error">Error: Se necesita permiso de ubicación para ver el mapa.</p>';
                    });
                } else {
                    document.getElementById('map').innerHTML = '<p class="error">Error: Se necesita permiso de ubicación para ver el mapa.</p>';
                }
            });
        } else {
            navigator.geolocation.getCurrentPosition(function() { initMap(); }, function() {
                document.getElementById('map').innerHTML = '<p class="error">Error: Se necesita permiso de ubicación para ver el mapa.</p>';
            });
        }
    </script>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-o9N1j8+FQG8Vh+U4+ZfHk4n0Cw0a5F6c4bXKx9x4Z0A=" crossorigin=""></script>
    <p><a href="send_location.php?reset=1">Resetear y enviar nuevas coordenadas</a></p>
<?php endif; ?>
<?php
// Reset handling
if (isset($_GET['reset'])) {
    session_unset();
    header('Location: send_location.php');
    exit();
}
?>
</body>
</html>
?>