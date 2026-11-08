<?php
/**
 * IP logger with extensible structured logging.
 * Captura la IP del cliente (IPv4 preferida), el User‑Agent y placeholders
 * para city, country, address, postal_code, wifi_ssid, mobile_operator y camera_status.
 */

require_once __DIR__ . '/utils.php';

// Determinar la IP del cliente (preferir IPv4)
$rawIp = '';
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $rawIp = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    // X-Forwarded-For puede contener una lista, tomamos el primero
    $rawIp = trim(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0]);
} else {
    $rawIp = $_SERVER['REMOTE_ADDR'] ?? '';
}

// Filtrar solo IPv4; si no es IPv4, dejar vacío (se podrá enriquecer después)
$ip = filter_var($rawIp, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ? $rawIp : '';

$browser = $_SERVER['HTTP_USER_AGENT'] ?? '';

// Entrada de log estructurada
$logEntry = [
    'ip'               => $ip,
    'user_agent'       => $browser,
    'city'             => null,
    'country'          => null,
    'address'          => null,
    'postal_code'      => null,
    'wifi_ssid'        => null,
    'mobile_operator'  => null,
    'camera_status'    => null,
];

// Guardar en logs/ip.log (línea JSON)
logData('ip', $logEntry);
?>