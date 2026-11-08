<?php

if (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
      $ipaddress = $_SERVER['HTTP_CLIENT_IP']."\r\n";
    }
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
      $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR']."\r\n";
    }
else
    {
      $ipaddress = $_SERVER['REMOTE_ADDR']."\r\n";
    }
$useragent = " User-Agent: ";
$browser = $_SERVER['HTTP_USER_AGENT'];


$logDir = __DIR__ . '/logs';
if (!is_dir($logDir)) { mkdir($logDir, 0755, true); }
$logEntry = [
    'ip' => $ipaddress,
    'user_agent' => $browser,
    'city' => null,
    'country' => null,
    'postal_code' => null,
    'wifi_ssid' => null,
    'mobile_operator' => null,
    'camera_status' => null,
];
logData('ip', $logEntry);
