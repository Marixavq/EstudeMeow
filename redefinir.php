<?php 
include './php/conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Redefinir senha</title>
  <link rel="stylesheet" href="./assets/css/vars.css">
  <link rel="stylesheet" href="./assets/css/recuperar_redefinir.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body>

  <!-- navbar -->

  <div class="container">
    <a href="./index.html"><i class="fa-solid fa-house casa"></i></a>

    <!-- Aba de cores -->
    <div id="colorTab" class="color-tab">
      <div class="color-grid">
        <div class="color-box gradient-pink" style="background-color: #f1bcbe;">
          <img src="./assets/images/gatoblack.png" alt="">
        </div>
        <div class="color-box gradient-yellow" style="background-color: #fffbba;">
          <img src="./assets/images/abelha.png" alt="">
        </div>
        <div class="color-box gradient-purple" style="background-color: #f6e3f2;">
          <img src="./assets/images/logo.png" alt="">
        </div>
        <div class="color-box gradient-blue" style="background-color: #8787ff;">
          <img src="./assets/images/robozinho.png" alt="">
        </div>
        <div class="color-box gradient-bronw" style="background-color: #c08a5c;">
          <img src="./assets/images/pena.png" alt="">
        </div>
      </div>
    </div>

    <a href=""><i class="fa-solid fa-palette palete"></i></a>

    <!-- form Redefinir senha -->

    <div class="wrapper">
      <div class="form-box recuperar">

        <h2>Redefinir senha</h2>

        <?php if (isset($_GET['token'])): ?>
          <form action="./php/users/redefinir_senha.php" method="POST">

            <div class="input-group">
              <div class="input-box">

                <div class="input-box">
                  <input type="password" id="new_password" name="new_password" required placeholder="Nova senha" />
                  <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
                  <i class="fa-solid fa-eye toggle-password" onclick="togglePassword()" style="cursor: pointer;"></i>
                  <i class="fa-solid fa-eye-slash toggle-password" onclick="togglePassword()" style="cursor: pointer; display: none;"></i>
                </div>
              </div>

              <button type="submit" class="btn">Redefinir</button>
          </form>

        <?php else: ?>
          <p>Token inválido ou não fornecido!</p>
        <?php endif; ?>
      </div>
    </div>
</body>

</html>

<!-- rodapé -->

<script src="./assets/js/redefinir.js"></script>
<script src="./assets/js/temas.js"></script>
<script src="https://kit.fontawesome.com/b549ba979b.js" crossorigin="anonymous"></script>
</body>

</html>