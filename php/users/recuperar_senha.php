<?php

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// ____________

include_once '../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
  $email = $_POST['email'];

  $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
  $stmt->execute([$email]);
  $user = $stmt->fetch();

  if ($user) {

    $token = bin2hex(random_bytes(16)); // Gera um token de 32 caracteres
    $userid = $user['id'];

    $stmt = $pdo->prepare("INSERT INTO recuperacao_senha (user_id, token, expiracao) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 1 HOUR))");
    $stmt->execute([$userid, $token]);

    $mail = new PHPMailer(true);
    if ($email) {
      // Configuração do servidor SMTP
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'SEU_EMAIL_AQUI';
      $mail->Password = 'SENHA_DO_APP_AQUI';
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port = 587;

      $mail->setFrom('seu_email@dominio.com', 'Seu Nome');
      $mail->addAddress($email, 'Usuário');

      $mail->isHTML(true);
      $mail->Subject = 'Recuperacao de Senha';
      $mail->Body    = 'Olá. Sou uma dos desenvolvedores desse projeto. Espero que esteja gostando :)
      Clique no link para redefinir sua senha: <br><a href="http://localhost/tccbd/redefinir.php?token=' . $token . '">Redefinir Senha</a>';
      $mail->AltBody = 'Clique no link para redefinir sua senha: http://localhost/tccbd/redefinir.php?token=' . $token;

      $mail->send();
      echo "E-mail enviado com sucesso para: $email";
    } else {
      echo "E-mail inválido.";
    }
  } else {
    echo "Método de requisição inválido.";
  }
}
