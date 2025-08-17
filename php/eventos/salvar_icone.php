<?php

include_once '../conexao.php';

session_start(); 

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não está logado.']);
    exit;
}

$user_id = $_SESSION['user_id'];  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = json_decode(file_get_contents('php://input'), true);

    if (isset($dados['start'])) {
        $start = $dados['start'];
        $end = $dados['end'] ?? null; // Opcional
        $title = $dados['title'] ?? null; // Opcional
        $color = $dados['color'] ?? null; // Opcional
        $obs = $dados['obs'] ?? null; // Opcional
        $icone = $dados['icone'] ?? null; // Opcional

        try {
            $stmt = $pdo->prepare("
                INSERT INTO events (user_id, start, end, title, color, obs, icone)
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ");
            $success = $stmt->execute([$user_id, $start, $end, $title, $color, $obs, $icone]);

            if ($success) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erro ao salvar no banco.']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Erro ao salvar no banco: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Dados insuficientes enviados.']);
    }
}

?>
