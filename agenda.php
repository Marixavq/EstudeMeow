<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estude Meow</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/vars.css">
    <link rel="stylesheet" href="./assets/css/agenda.css">

</head>

<body>

    <div class="container-fluid">

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


        <div class="card-body">
            <h1 class="titulo">Calendário<h1>
        </div>

        <span id="msg"></span>

        <div class="card-body">
            <div id='calendar'></div>
        </div>

        <!-- Modal Visualizar -->
        <div class="modal fade" id="visualizarModal" tabindex="-1" aria-labelledby="visualizarModalLabel"
            aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        <h1 class="modal-title fs-5" id="visualizarModalLabel">Visualizar o Evento</h1>

                        <h1 class="modal-title fs-5" id="editarModalLabel" style="display: none;">Editar o Evento</h1>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <span id="msgViewEvento"></span>

                        <div id="visualizarEvento">

                            <dl class="row">

                                <dt class="col-sm-3">ID: </dt>
                                <dd class="col-sm-9" id="visualizar_id"></dd>

                                <dt class="col-sm-3">Título: </dt>
                                <dd class="col-sm-9" id="visualizar_title"></dd>

                                <dt class="col-sm-3">Observação: </dt>
                                <dd class="col-sm-9" id="visualizar_obs"></dd>

                                <dt class="col-sm-3">Início: </dt>
                                <dd class="col-sm-9" id="visualizar_start"></dd>

                                <dt class="col-sm-3">Fim: </dt>
                                <dd class="col-sm-9" id="visualizar_end"></dd>

                            </dl>

                            <button type="button" class="botaoEditar" id="btnViewEditEvento">Editar</button>

                            <button type="button" class="botaoApagar" id="btnApagarEvento">Apagar</button>

                        </div>

                        <div id="editarEvento" style="display: none;">

                            <span id="msgEditEvento"></span>

                            <form method="POST" id="formEditEvento">

                                <input type="hidden" name="edit_id" id="edit_id">

                                <div class="row mb-3">
                                    <label for="edit_title" class="col-sm-2 col-form-label">Título</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="edit_title" class="form-control" id="edit_title"
                                            placeholder="Título do evento">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="edit_obs" class="col-sm-2 col-form-label">Observação</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="edit_obs" class="form-control" id="edit_obs"
                                            placeholder="Observação do evento">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="edit_start" class="col-sm-2 col-form-label">Início</label>
                                    <div class="col-sm-10">
                                        <input type="datetime-local" name="edit_start" class="form-control" id="edit_start">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="edit_end" class="col-sm-2 col-form-label">Fim</label>
                                    <div class="col-sm-10">
                                        <input type="datetime-local" name="edit_end" class="form-control" id="edit_end">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="edit_color" class="col-sm-2 col-form-label">Cor</label>
                                    <div class="col-sm-10">
                                        <select name="edit_color" class="form-control" id="edit_color" onchange="updateColorEdit()">
                                            <option value="" style="background: transparent;">Selecione</option>
                                            <option style="background-color:#FFD700;" value="#FFD700"></option>
                                            <option style="background-color:#0071c5;" value="#0071c5"></option>
                                            <option style="background-color:#FF4500;" value="#FF4500"></option>
                                            <option style="background-color:#8B4513;" value="#8B4513"></option>
                                            <option style="background-color:#1C1C1C;" value="#1C1C1C"></option>
                                            <option style="background-color:#436EEE;" value="#436EEE"></option>
                                            <option style="background-color:#A020F0;" value="#A020F0"></option>
                                            <option style="background-color:#40E0D0;" value="#40E0D0"></option>
                                            <option style="background-color:#228B22;" value="#228B22"></option>
                                            <option style="background-color:#8B0000;" value="#8B0000"></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <input type="hidden" name="edit_user_id" id="edit_user_id" value="<?php echo $_SESSION['user_id']; ?>">
                                </div>

                                <button type="button" name="btnViewEvento" class="botaoCancelar"
                                    id="btnViewEvento">Cancelar</button>

                                <button type="submit" name="btnEditEvento" class="botaoEditar"
                                    id="btnEditEvento">Salvar</button>

                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Cadastrar -->
        <div class="modal fade" id="cadastrarModal" tabindex="-1" aria-labelledby="cadastrarModalLabel" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="cadastrarModalLabel">Cadastrar o Evento</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <span id="msgCadEvento"></span>

                        <form method="POST" id="formCadEvento">

                            <div class="row mb-3">
                                <label for="cad_title" class="col-sm-2 col-form-label">Título</label>
                                <div class="col-sm-10">
                                    <input type="text" name="cad_title" class="form-control" id="cad_title"
                                        placeholder="Título do evento">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="cad_obs" class="col-sm-2 col-form-label">Observação</label>
                                <div class="col-sm-10">
                                    <input type="text" name="cad_obs" class="form-control" id="cad_obs"
                                        placeholder="Observação do evento">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="cad_start" class="col-sm-2 col-form-label">Início</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" name="cad_start" class="form-control" id="cad_start">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="cad_end" class="col-sm-2 col-form-label">Fim</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" name="cad_end" class="form-control" id="cad_end">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="cad_color" class="col-sm-2 col-form-label">Cor</label>
                                <div class="col-sm-10">
                                    <select name="cad_color" class="form-control" id="cad_color" onchange="updateColorCad()">
                                        <option value="" style="background: transparent;">Selecione</option>
                                        <option style="background-color:#FFD700;" value="#FFD700"></option>
                                        <option style="background-color:#8A9ADB;" value="#8A9ADB"></option>
                                        <option style="background-color:#FF4500;" value="#FF4500"></option>
                                        <option style="background-color:#8B4513;" value="#8B4513"></option>
                                        <option style="background-color:#1C1C1C;" value="#1C1C1C"></option>
                                        <option style="background-color:#436EEE;" value="#4399EE"></option>
                                        <option style="background-color:#A020F0;" value="#A020F0"></option>
                                        <option style="background-color:#40E0D0;" value="#40E0D0"></option>
                                        <option style="background-color:#228B22;" value="#228B22"></option>
                                        <option style="background-color:#8B0000;" value="#8B0000"></option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <input type="hidden" name="cad_user_id" id="cad_user_id" value="<?php echo $_SESSION['user_id']; ?>">
                            </div>

                            <button type="submit" name="btnCadEvento" class="botaoCadastrar"
                                id="btnCadEvento">Cadastrar</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>

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
                        <a href="./agenda.php">Calendário</a>
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



    <script>
        function updateColorCad() {
            // Seleciona o campo do dropdown
            const select = document.getElementById('cad_color');
            // Obtém a cor da opção selecionada
            const selectedOption = select.options[select.selectedIndex];
            const color = selectedOption.value;

            // Define a cor de fundo no dropdown
            select.style.backgroundColor = color || 'transparent'; // Caso "Selecione" seja escolhido, deixa transparente
        }

        function updateColorEdit() {
            // Seleciona o campo do dropdown
            const select = document.getElementById('edit_color');
            // Obtém a cor da opção selecionada
            const selectedOption = select.options[select.selectedIndex];
            const color = selectedOption.value;

            // Define a cor de fundo no dropdown
            select.style.backgroundColor = color || 'transparent'; // Caso "Selecione" seja escolhido, deixa transparente
        }
    </script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script src='./assets/js/js-agenda/index.global.min.js'></script>
    <script src='./assets/js/js-agenda/core/locales-all.global.min.js'></script>
    <script src='./assets/js/js-agenda/bootstrap5/index.global.min.js'></script>
    <script src='./assets/js/agenda.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    <script src="https://kit.fontawesome.com/b549ba979b.js" crossorigin="anonymous"></script>
    <script src="./assets/js/temas.js"></script>
    <script src="./assets/js/script.js"></script>

</body>
</html>