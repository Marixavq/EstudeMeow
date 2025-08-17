<?php
header('Content-Type: application/json; charset=utf-8');
session_start();

include '../conexao.php';

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = json_decode(file_get_contents('php://input'), true);

    $id = $dados['id'];

    if (isset($dados['status'])) {
        $status = $dados['status']; // 1 para concluída, 0 para não concluída
        $query = "UPDATE tarefas SET status = :status WHERE id = :id AND user_id = :user_id";
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Status atualizado com sucesso!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao atualizar o status.']);
        }
    }

    if (isset($dados['descricao'])) {
        $descricao = $dados['descricao'];
        $query = "UPDATE tarefas SET descricao = :descricao WHERE id = :id AND user_id = :user_id";
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Descrição atualizada com sucesso!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao atualizar a descrição.']);
        }
    }
}
?>
