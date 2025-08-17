<?php

session_start();

include_once '../conexao.php';

header('Content-Type: application/json');


if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Usuário não está logado']);
    exit;
}

$user_id = $_SESSION['user_id'];

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {

    $query_apagar_event = "DELETE FROM events WHERE id = :id AND user_id = :user_id";

    $apagar_event = $pdo->prepare($query_apagar_event);

    $apagar_event->bindParam(':id', $id);
    $apagar_event->bindParam(':user_id', $user_id);

    if ($apagar_event->execute()) {
        $retorna = ['status' => true, 'msg' => 'Evento apagado com sucesso!'];
    } else {
        $retorna = ['status' => false, 'msg' => 'Erro: Evento não apagado!'];
    }
} else {
    $retorna = ['status' => false, 'msg' => 'Erro: Necessário enviar o id do evento!'];
}

echo json_encode($retorna);
exit;
