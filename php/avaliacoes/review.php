<?php

include './php/conexao.php';

$query = "SELECT comentario, estrelas FROM avaliacoes";
$result = $pdo->query($query);

$avaliacoes = [];
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $avaliacoes[] = [
        'comentario' => $row['comentario'],
        'estrelas' => $row['estrelas']
    ];
}
?>
