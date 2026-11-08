<?php
// location.php - Realistic "Enviar mi ubicación" implementation (template)
// ------------------------------------------------------------
// Provides a form to input latitude and longitude (simulated location)
// and displays an interactive OpenStreetMap map only after the user
// grants geolocation permission. Uses Bootstrap for a polished UI.
// ------------------------------------------------------------

session_start();

// ---------------------------------------------------------------------
// CSRF token handling (simple implementation suitable for demo purposes)
// ---------------------------------------------------------------------
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify CSRF token
    if (empty($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $csrf_error = 'Token CSRF inválido. Refresca la página y vuelve a intentarlo.';
    } else {
        // Basic numeric validation of coordinates
        $lat = trim($_POST['lat'] ?? '');
        $lon = trim($_POST['lon'] ?? '');
        if (!is_numeric($lat) || !is_numeric($lon)) {
            $error = 'Latitud y longitud deben ser números válidos.';
        } else {
            // Store coordinates in session – regenerate ID to avoid fixation
            $_SESSION['lat'] = $lat;
            $_SESSION['lon'] = $lon;
            session_regenerate_id(true);
            // Log the submission with structured JSON
            require_once __DIR__ . '/utils.php';
            $logEntry = [
                'lat' => $lat,
                'lon' => $lon,
                'city' => null,
                'country' => null,
                'address' => null,
                'postal_code' => null,
                'wifi_ssid' => null,
                'mobile_operator' => null,
                'camera_status' => null,
            ];
            logData('location', $logEntry);
            // Redirect (Post/Redirect/Get) to avoid duplicate submissions
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        }
    }
}

// ---------------------------------------------------------------------
// Reset handling – placed before any output
// ---------------------------------------------------------------------
if (isset($_GET['reset'])) {
    session_unset();
    // Regenerate a fresh token for the new session
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    header('Location: ' . basename(__FILE__));
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Enviar mi ubicación</title>
    <!-- Bootstrap 5 (free CDN) for a realistic look -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ENjdO4Dr2bkBIFxQpeoYz1Z6V5E2UjF6lF9/6X6C3a8xG9xS9G+Q4K9fT7LwE5k3" crossorigin="anonymous">
    <style>
        #map { height: 400px; }
    </style>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-sA+e2R0k2J5F+0KpKx1r4pJ7GQy0Gx7b7h3Gf9a0f5w=" crossorigin=""/>
</head>
<body class="bg-light">
<div class="container py-4">
    <h1 class="mb-4 text-center">📍 Enviar mi ubicación</h1>

    <?php if (!empty($csrf_error)): ?>
        <div class="alert alert-danger" role="alert">
            <?= htmlspecialchars($csrf_error) ?>
        </div>
    <?php endif; ?>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger" role="alert">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <?php if (!isset($_SESSION['lat']) || !isset($_SESSION['lon'])): ?>
        <div class="card mx-auto" style="max-width: 500px;">
            <div class="card-body">
                <p class="card-text">Introduce una latitud y longitud simuladas. <em>En un caso real, estas coordenadas se obtendrían automáticamente del sensor GPS del dispositivo.</em></p>
                <form method="post" action="">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                    <div class="mb-3">
                        <label for="lat" class="form-label">Latitud</label>
                        <input type="text" class="form-control" id="lat" name="lat" placeholder="e.g., -34.6037" required>
                    </div>
                    <div class="mb-3">
                        <label for="lon" class="form-label">Longitud</label>
                        <input type="text" class="form-control" id="lon" name="lon" placeholder="e.g., -58.3816" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Enviar coordenadas</button>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="card mx-auto mb-4" style="max-width: 600px;">
            <div class="card-body">
                <h5 class="card-title">Coordenadas capturadas</h5>
                <p class="card-text">
                    Latitud: <strong><?= htmlspecialchars($_SESSION['lat']) ?></strong><br>
                    Longitud: <strong><?= htmlspecialchars($_SESSION['lon']) ?></strong>
                </p>
                <a href="?reset=1" class="btn btn-outline-secondary btn-sm">Cambiar coordenadas</a>
            </div>
        </div>
        <div class="card mx-auto" style="max-width: 800px;">
            <div class="card-body p-0">
                <div id="map" class="rounded-bottom"></div>
            </div>
        </div>
        <script>
            // Initialise map only after the user grants permission
            function initMap() {
                var map = L.map('map').setView([<?= $_SESSION['lat'] ?>, <?= $_SESSION['lon'] ?>], 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);
                L.marker([<?= $_SESSION['lat'] ?>, <?= $_SESSION['lon'] ?>]).addTo(map)
                    .bindPopup('Ubicación simulada').openPopup();
            }

            function showPermissionError() {
                document.getElementById('map').innerHTML =
                    '<div class="alert alert-warning m-3" role="alert">' +
                    'Necesitas <strong>permitir el acceso a tu ubicación</strong> para ver el mapa.' +
                    '</div>';
            }

            if (navigator.permissions) {
                navigator.permissions.query({name: 'geolocation'}).then(function(status) {
                    if (status.state === 'granted') {
                        initMap();
                    } else if (status.state === 'prompt') {
                        navigator.geolocation.getCurrentPosition(function(){
                            initMap();
                        }, function(){
                            showPermissionError();
                        });
                    } else {
                        showPermissionError();
                    }
                }).catch(function(){
                    requestGeolocation();
                });
            } else {
                requestGeolocation();
            }

            function requestGeolocation() {
                navigator.geolocation.getCurrentPosition(function(){
                    initMap();
                }, function(){
                    showPermissionError();
                });
            }
        </script>
        <!-- Leaflet JS -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
                integrity="sha256-o9N1j8+FQG8Vh+U4+ZfHk4n0Cw0a5F6c4bXKx9x4Z0A=" crossorigin=""></script>
    <?php endif; ?>
</div>
<!-- Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+Xkk+Y5F5Z3zV4I1W6pCkKz3T3h+5" crossorigin="anonymous"></script>
</body>
</html>
?>