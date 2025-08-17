<?php
include './php/avaliacoes/review.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>review</title>
    <link rel="stylesheet" href="./assets/css/vars.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/review.css">
</head>

<body>

    <div class="container">

        <header>

            <div class="Logo">
                <img src="./assets/images/logo.png" alt="logo">
                <a href="./index.html" class="logo">Estude<span> ᨐᵉᵒ﻿ʷ</span></a>
            </div>

            <div id="menu" class="fas fa-bars"></div>

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

            <nav class="navbar">
                <a href="./index.html">Início</a>
                <a href="./metodos.html">Métodos</a>
                <a href="./list.html">Lista</a>
                <a href="./agenda.php">Calendário</a>
                <a href="./sobre.html">Sobre Nós</a>
                <a href="./review.php">Review</a>
                <a href="./contact.html">Contato</a>
                <a href=""><i class="fa-solid fa-palette palete"></i></a>
            </nav>

        </header>

            <div class="retangulo-roxo">
            <div class="item">
                <a>66+</a>
                  <p>ajudamos estudantes</p>
            </div>

        <img id="themeImage" class="img_temas" src="./assets/images/gatinho_coração.png" alt="logo">

            <div class="item">
                <a>4,5</a>
                    <p>avaliação do site</p>
            </div>
        </div>


        <h1 class="heading">O Que Dizem Nossos Alunos</h1>

        <div class="msg">
            <p class="msg">Leia o que os nossos alunos disseram sobre suas experiências usando o Estude meow. </p>

            <button><a href="./contact.html">deixe sua avaliação</a></button>
        </div>

        <section class="teacher">
    <div class="carousel">
        <button class="prev">&lt;</button> <!-- Botão anterior -->
        <div class="carousel-container">
            <?php
            // Array com os nomes das imagens
            $imagens = ['cat1.jpeg', 'cat2.jpeg', 'cat3.jpeg', 'cat4.png', 'cat5.jpeg', 'cat6.jpeg', 'cat7.jpeg', 'cat8.jpeg', 'cat9.jpeg', 'cat10.jpeg'];

            // Loop pelas avaliações
            foreach ($avaliacoes as $avaliacao): 
                // Escolhe uma imagem aleatória
                $imagemAleatoria = $imagens[array_rand($imagens)];
            ?>
                <div class="carousel-item">
                    <img src="./assets/images/<?php echo $imagemAleatoria; ?>" alt="Imagem Aleatória">
                    <div class="conteudo">
                        <p><?php echo htmlspecialchars($avaliacao['comentario']); ?></p>
                        <div class="stars">
                            <?php for ($i = 0; $i < $avaliacao['estrelas']; $i++): ?>
                                <span>&#9733;</span> <!-- Exibe uma estrela preenchida -->
                            <?php endfor; ?>
                            <?php for ($i = $avaliacao['estrelas']; $i < 5; $i++): ?>
                                <span>&#9734;</span> <!-- Exibe uma estrela vazia -->
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="next">&gt;</button> <!-- Botão próximo -->
    </div>
</section>

            <!-- <div class="carousel-item">
                <img src="./assets/images/student-2.png" alt="Imagem 2">
                <div class="conteudo">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum expedita, in est aperiam
                        eum
                        labore quis maxime dolorem? Voluptate perspiciatis</p>
                    <div class="stars">★★★★☆</div>
                </div>
            </div>

            <div class="carousel-item">
                <img src="./assets/images/student-3.png" alt="Imagem 3">
                <div class="conteudo">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum expedita, in est aperiam
                        eum
                        labore quis maxime dolorem? Voluptate perspiciatis</p>
                    <div class="stars">★★★☆☆</div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="./assets/images/student-4.png" alt="Imagem 4">
                <div class="conteudo">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum expedita, in est aperiam
                        eum
                        labore quis maxime dolorem? Voluptate perspiciatis</p>
                    <div class="stars">★★★★☆</div>
                </div>
            </div>
 -->

        </section>



        <!-- footer section  -->

        <footer>
            <section class="footer">

                <div class="box-container">

                    <div class="box">
                        <h3>Estude meow</h3>
                        <p>Estamos aqui para facilitar seus estudos! Aprenda mais com o Estude Meow, um grupo
                            independente de desenvolvedores com o intuito de tornar seus estudos mais produtivos. :3</p>
                    </div>

                    <div class="box lin">
                        <h3>Links</h3>
                        <a href="./index.html">Início</a>
                        <a href="./metodos.html">Métodos</a>
                        <a href="./list.html">Lista</a>
                        <a href="./agenda.php">Agenda</a>
                        <a href="./sobre.html">Sobre Nós</a>
                        <a href="./review.php">Review</a>
                        <a href="./contact.html">Contato</a>
                    </div>

                    <div class="box">
                        <h3>Redes</h3>
                        <a href="https://www.instagram.com/meowestude?igsh=MTJuMm8yZzJhMW54bg==" target="_blank">instagram</a>
                        <a href="https://www.facebook.com/profile.php?id=61568459753875" target="_blank">facebook</a>
                        <a href="https://criarmeulink.com.br/u/1732835903" target="_blank">email</a>
                    </div>

                    <div class="box">
                        <h3>Contato</h3>
                        <p> <i class="fas fa-phone"></i> +55 (11) 94002-8922 </p>
                        <p> <i class="fas fa-envelope"></i> Meowestude@gmail.com </p>
                        <p> <i class="fas fa-map-marker-alt"></i> Sp BarangaCity
                            Rua Fubanga Town 353469 </p>
                    </div>

                </div>

                <div class="credit"> created by <span> mr. web designer </span> | all rights reserved </div>

            </section>

    </div>
    </footer>
    <!-- custom js file link -->
    <script src="https://kit.fontawesome.com/b549ba979b.js" crossorigin="anonymous"></script>
    <script src="./assets/js/script.js"></script>
    <script src="./assets/js/review.js"></script>
</body>

</html>