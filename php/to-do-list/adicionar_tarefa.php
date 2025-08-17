<?php

header('Content-Type: application/json');

include '../conexao.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location:../../login.html");
    exit();
}

$user_id = $_SESSION['user_id'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = json_decode(file_get_contents('php://input'), true);

    if (isset($dados['descricao']) && isset($dados['status'])) {
        $descricao = $dados['descricao'];
        $status = $dados['status'];


        $query = "INSERT INTO tarefas (user_id, descricao, status) VALUES (:user_id, :descricao, :status)";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':status', $status);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Tarefa adicionada com sucesso!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao adicionar tarefa.']);
        }        
    }
}
