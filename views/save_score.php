<?php
require_once __DIR__ . '/../includes/functions.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$username = sanitizeInput($data['username'] ?? '');
$difficulty = sanitizeInput($data['difficulty'] ?? '');
$time_taken = intval($data['time_taken'] ?? 0);

if (!$username || !$difficulty || $time_taken <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Datos inválidos.']);
    exit;
}

$query = "INSERT INTO scores (username, difficulty, time_taken) VALUES (?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param('ssi', $username, $difficulty, $time_taken);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Puntaje guardado exitosamente.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No se pudo guardar el puntaje.']);
}

$stmt->close();
