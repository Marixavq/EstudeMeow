
<?php
session_start();
header('Content-Type: application/json');

include_once '../conexao.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Usuário não está logado']);
    exit();
}

$user_id = $_SESSION['user_id'];

$query_events = "SELECT evt.id, evt.title, evt.color, evt.start, evt.end, evt.obs
                 FROM events AS evt
                 WHERE evt.user_id = :user_id";

$result_events = $pdo->prepare($query_events);
$result_events->bindParam(':user_id', $user_id, PDO::PARAM_INT);

$result_events->execute();

$eventos = [];

while ($row_events = $result_events->fetch(PDO::FETCH_ASSOC)) {
    $start = (new DateTime($row_events['start']))->format('Y-m-d\TH:i:s');
    $end = (new DateTime($row_events['end']))->format('Y-m-d\TH:i:s');

    $eventos[] = [
        'id' => $row_events['id'],
        'title' => $row_events['title'],
        'color' => $row_events['color'],
        'start' => $start,
        'end' => $end,
        'obs' => $row_events['obs']
    ];
}
ini_set('display_errors', 1);
error_reporting(E_ALL);


if ($result_events->rowCount() == 0) {
    echo json_encode(['message' => 'Nenhum evento encontrado.']);
} 

echo json_encode($eventos);
