<?php

session_start();

include '../conexao.php';

header('Content-Type: application/json');


if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Usuário não está logado']);
    exit;
}

 $user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (empty($dados['cad_title']) || empty($dados['cad_start']) || empty($dados['cad_end'])) {
        echo json_encode(['error' => 'Dados incompletos.']);
        exit();
    }

    $query_cad_event = "INSERT INTO events (title, color, start, end, obs, user_id) VALUES (:title, :color, :start, :end, :obs, :user_id)";

    $cad_event = $pdo->prepare($query_cad_event);

    $cad_event->bindParam(':title', $dados['cad_title']);
    $cad_event->bindParam(':color', $dados['cad_color']);
    $cad_event->bindParam(':start', $dados['cad_start']);
    $cad_event->bindParam(':end', $dados['cad_end']);
    $cad_event->bindParam(':obs', $dados['cad_obs']);
    $cad_event->bindParam(':user_id', $user_id);

    if ($cad_event->execute()) {
        $retorna = [
            'status' => true,
            'msg' => 'Evento cadastrado com sucesso!',
            'id' => $pdo->lastInsertId(),
            'title' => $dados['cad_title'],
            'color' => $dados['cad_color'],
            'start' => $dados['cad_start'],
            'end' => $dados['cad_end'],
            'obs' => $dados['cad_obs'],
            'user_id' => $user_id,
        ];
    } else {
        $retorna = ['status' => false, 'msg' => 'Erro: Evento não cadastrado!'];
    }

    echo json_encode($retorna);
}
