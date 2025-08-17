document.addEventListener('DOMContentLoaded', function () {

    var calendarEl = document.getElementById('calendar');

    const cadastrarModal = new bootstrap.Modal(document.getElementById("cadastrarModal"));

    const visualizarModal = new bootstrap.Modal(document.getElementById("visualizarModal"));

    const msgViewEvento = document.getElementById('msgViewEvento');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: './php/eventos/listar_evento.php',

        themeSystem: 'bootstrap5',

        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },

        locale: 'pt-br',

        navLinks: true,
        selectable: true,
        selectMirror: true,
        dayMaxEvents: false,
        editable: true,
        droppable: true,

        eventClick: function (info) {

            document.getElementById("visualizarEvento").style.display = "block";
            document.getElementById("visualizarModalLabel").style.display = "block";

            document.getElementById("editarEvento").style.display = "none";
            document.getElementById("editarModalLabel").style.display = "none";

            document.getElementById("visualizar_id").innerText = info.event.id;
            document.getElementById("visualizar_title").innerText = info.event.title;
            document.getElementById("visualizar_obs").innerText = info.event.extendedProps.obs;
            document.getElementById("visualizar_start").innerText = info.event.start.toLocaleString();
            document.getElementById("visualizar_end").innerText = info.event.end !== null ? info.event.end.toLocaleString() : info.event.start.toLocaleString();

            document.getElementById("edit_id").value = info.event.id;
            document.getElementById("edit_title").value = info.event.title;
            document.getElementById("edit_obs").value = info.event.extendedProps.obs;
            document.getElementById("edit_start").value = converterData(info.event.start);
            document.getElementById("edit_end").value = info.event.end !== null ? converterData(info.event.end) : converterData(info.event.start);
            document.getElementById("edit_color").value = info.event.backgroundColor;

            visualizarModal.show();
        },

        select: async function (info) {

            document.getElementById("cad_start").value = converterData(info.start);
            document.getElementById("cad_end").value = converterData(info.start);

            cadastrarModal.show();
        }
    });

    calendar.render();

    function converterData(data) {

        const dataObj = new Date(data);

        const ano = dataObj.getFullYear();

        const mes = String(dataObj.getMonth() + 1).padStart(2, '0');

        const dia = String(dataObj.getDate()).padStart(2, '0');

        const hora = String(dataObj.getHours()).padStart(2, '0');

        const minuto = String(dataObj.getMinutes()).padStart(2, '0');

        return `${ano}-${mes}-${dia} ${hora}:${minuto}`;
    }

    const formCadEvento = document.getElementById("formCadEvento");

    const msg = document.getElementById("msg");

    const msgCadEvento = document.getElementById("msgCadEvento");

    const btnCadEvento = document.getElementById("btnCadEvento");

    if (formCadEvento) {

        formCadEvento.addEventListener("submit", async (e) => {

            e.preventDefault();

            btnCadEvento.value = "Salvando...";

            const dadosForm = new FormData(formCadEvento);

            const dados = await fetch("./php/eventos/cadastrar_evento.php", {
                method: "POST",
                body: dadosForm
            });

            const resposta = await dados.json();

            if (!resposta['status']) {

                msgCadEvento.innerHTML = `<div class="alert alert-danger" role="alert">${resposta['msg']}</div>`;

            } else {

                msg.innerHTML = `<div class="alert alert-success" role="alert">${resposta['msg']}</div>`;

                msgCadEvento.innerHTML = "";

                formCadEvento.reset();

                const novoEvento = {
                    id: resposta['id'],
                    title: resposta['title'],
                    color: resposta['color'],
                    start: resposta['start'],
                    end: resposta['end'],
                    obs: resposta['obs']
                }

                calendar.addEvent(novoEvento);

                removerMsg();

                cadastrarModal.hide();
            }

            btnCadEvento.value = "Cadastrar";

        });
    }


    function removerMsg() {
        setTimeout(() => {
            document.getElementById('msg').innerHTML = "";
        }, 3000)
    }

    const btnViewEditEvento = document.getElementById("btnViewEditEvento");

    if (btnViewEditEvento) {

        btnViewEditEvento.addEventListener("click", async () => {

            document.getElementById("visualizarEvento").style.display = "none";
            document.getElementById("visualizarModalLabel").style.display = "none";

            document.getElementById("editarEvento").style.display = "block";
            document.getElementById("editarModalLabel").style.display = "block";

            var userId = document.getElementById('visualizar_user_id').innerText;

            var editUserId = document.getElementById('edit_user_id');

            const resposta = await dados.json();

            if (resposta['status']) {

                var opcoes = '<option value="">Selecione</option>';

                for (var i = 0; i < resposta.dados.length; i++) {
                    opcoes += `<option value="${resposta.dados[i]['id']}" ${userId == resposta.dados[i]['id'] ? 'selected' : ""}>${resposta.dados[i]['name']}</option>`;
                }

                editUserId.innerHTML = opcoes;

            }
            else {
                editUserId.innerHTML = `<option value=''>${resposta['msg']}</option>`;
            }
        });
    }

    const btnViewEvento = document.getElementById("btnViewEvento");

    if (btnViewEvento) {
        btnViewEvento.addEventListener("click", () => {

            document.getElementById("visualizarEvento").style.display = "block";
            document.getElementById("visualizarModalLabel").style.display = "block";

            document.getElementById("editarEvento").style.display = "none";
            document.getElementById("editarModalLabel").style.display = "none";
        });
    }

    const formEditEvento = document.getElementById("formEditEvento");

    const msgEditEvento = document.getElementById("msgEditEvento");

    const btnEditEvento = document.getElementById("btnEditEvento");

    if (formEditEvento) {

        formEditEvento.addEventListener("submit", async (e) => {

            e.preventDefault();

            btnEditEvento.value = "Salvando...";

            // Receber os dados do formulário
            const dadosForm = new FormData(formEditEvento);

            const dados = await fetch("./php/eventos/editar_evento.php", {
                method: "POST",
                body: dadosForm
            });

            const resposta = await dados.json();

            if (!resposta['status']) {

                msgEditEvento.innerHTML = `<div class="alert alert-danger" role="alert">${resposta['msg']}</div>`;
            } else {

                msg.innerHTML = `<div class="alert alert-success" role="alert">${resposta['msg']}</div>`;

                msgEditEvento.innerHTML = "";

                formEditEvento.reset();

                const eventoExiste = calendar.getEventById(resposta['id']);

                if (eventoExiste) {
                    eventoExiste.setProp('title', resposta['title']);
                    eventoExiste.setProp('color', resposta['color']);
                    eventoExiste.setExtendedProp('obs', resposta['obs']);
                    eventoExiste.setStart(resposta['start']);
                    eventoExiste.setEnd(resposta['end']);
                }

                removerMsg();

                visualizarModal.hide();
            }

            btnEditEvento.value = "Salvar";
        });
    }

    const btnApagarEvento = document.getElementById("btnApagarEvento");

    if (btnApagarEvento) {

        btnApagarEvento.addEventListener("click", async () => {

            const confirmacao = window.confirm("Tem certeza de que deseja apagar este evento?");

            if (confirmacao) {

                var idEvento = document.getElementById("visualizar_id").textContent;

                const dados = await fetch("./php/eventos/apagar_evento.php?id=" + idEvento);


                if (!dados.ok) {
                    console.error('Erro ao apagar evento: ', dados.statusText);
                    return;
                }

                const respostaTexto = await dados.text();
                let resposta;

                try {
                    resposta = JSON.parse(respostaTexto);
                } catch (e) {
                    console.error('Erro ao tentar parsear JSON: ', e);
                    return;
                }

                if (!resposta['status']) {

                    msgViewEvento.innerHTML = `<div class="alert alert-danger" role="alert">${resposta['msg']}</div>`;
                } else {

                    msg.innerHTML = `<div class="alert alert-success" role="alert">${resposta['msg']}</div>`;

                    msgViewEvento.innerHTML = "";

                    const eventoExisteRemover = calendar.getEventById(idEvento);

                    if (eventoExisteRemover) {
                        eventoExisteRemover.remove();
                    }

                    removerMsg();

                    visualizarModal.hide();

                }
            }
        });
    }

});

