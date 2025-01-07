<?php
require_once __DIR__ . '/../config.php';

// Redirigir
function redirect($url) {
    header("Location: " . BASE_URL . $url);
    exit();
}

// Sanitizar entradas
function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}
?>
