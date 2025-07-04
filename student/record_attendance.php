<?php
session_start();

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'student') {
    http_response_code(403);
    echo json_encode(['error' => 'Não autorizado']);
    exit();
}

// Obtém dados JSON da requisição
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!$data || !isset($data['classId']) || !isset($data['timestamp']) || !isset($data['token'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Dados inválidos']);
    exit();
}

// Verifica token (em uma aplicação real, você usaria uma validação mais segura)
$expectedToken = base64_encode($data['classId'] . '-' . $data['timestamp']);
if ($data['token'] !== $expectedToken) {
    http_response_code(400);
    echo json_encode(['error' => 'Token inválido']);
    exit();
}

// Verifica se o QR code não expirou (5 minutos de validade)
$currentTime = time() * 1000; // Converte para milissegundos
$scanTimeDiff = $currentTime - $data['timestamp'];
if ($scanTimeDiff > 300000) { // 5 minutos em milissegundos
    http_response_code(400);
    echo json_encode(['error' => 'QR Code expirado']);
    exit();
}

// Em uma aplicação real, você deveria:
// 1. Conectar a um banco de dados
// 2. Registrar a presença com ID do aluno, ID da turma e timestamp
// 3. Implementar verificação de duplicidade para evitar múltiplos registros
// 4. Adicionar tratamento de erros adequado

// Para esta demonstração, apenas retornaremos sucesso
echo json_encode([
    'success' => true,
    'message' => 'Presença registrada com sucesso',
    'data' => [
        'studentId' => $_SESSION['username'],
        'classId' => $data['classId'],
        'timestamp' => date('Y-m-d H:i:s', $data['timestamp'] / 1000)
    ]
]);