<?php

session_start();
header('Content-Type: application/json');

include '../conexao.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Usuário não está logado']);
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = json_decode(file_get_contents('php://input'), true);

    $query = "DELETE FROM tarefas WHERE user_id = :user_id";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Todas as tarefas foram excluídas com sucesso!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao excluir as tarefas.']);
    }
}
