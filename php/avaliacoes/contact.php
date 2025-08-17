<?php

session_start();
header('Content-Type: application/json');

include '../conexao.php';

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $estrelas = $_POST['estrelas'];
    $comentario = $_POST['comentario'];

    $sql = "INSERT INTO avaliacoes (user_id, estrelas, comentario) VALUES (:user_id, :estrelas, :comentario)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':estrelas', $estrelas, PDO::PARAM_INT);
    $stmt->bindParam(':comentario', $comentario, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Avaliação enviada com sucesso!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao enviar a avaliação. Faça login e tente novamente.']);
    }
}
?>