<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../conexao.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $token = htmlspecialchars(trim($_POST['token']), ENT_QUOTES, 'UTF-8');
    $new_password = htmlspecialchars(trim($_POST['new_password']), ENT_QUOTES, 'UTF-8');

    if (!empty($token) && !empty($new_password)) {
     
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("SELECT user_id FROM recuperacao_senha WHERE token = ? AND expiracao > NOW()");
        $stmt->execute([$token]);
        $user = $stmt->fetch();

        if ($user) {
            $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->execute([$hashed_password, $user['user_id']]);

            $stmt = $pdo->prepare("DELETE FROM recuperacao_senha WHERE token = ?");
            $stmt->execute([$token]);

            header("Location:../../login.html");
            exit;
        } else {
            echo "Token inválido ou expirado!";
        }
    } else {
        echo "Dados inválidos!";
    }
} else {
    echo "Acesso inválido!";
}
