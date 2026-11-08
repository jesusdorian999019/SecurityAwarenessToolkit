<?php
/**
 * Utility functions for the SecurityAwarenessToolkit.
 *
 * Provides a simple structured logger that writes JSON lines to files
 * under the `logs` directory. Each entry includes a timestamp and the
 * supplied data payload.
 */

/**
 * Write a log entry for a given category.
 *
 * @param string $category  Identifier for the log (e.g., 'ip', 'location').
 * @param array  $data      Associative array of data to log.
 */
function logData(string $category, array $data): void {
    $logDir = __DIR__ . '/logs';
    if (!is_dir($logDir)) {
        mkdir($logDir, 0755, true);
    }
    $logFile = $logDir . '/' . $category . '.log';
    $entry = array_merge(['timestamp' => date('c')], $data);
    // Encode as a single‑line JSON string.
    $json = json_encode($entry, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    if ($json === false) {
        // Fallback to plain text if encoding fails.
        $json = json_encode(['error' => 'json_encode_failed', 'raw' => $data]);
    }
    file_put_contents($logFile, $json . PHP_EOL, FILE_APPEND | LOCK_EX);
}
?>
