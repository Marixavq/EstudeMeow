const texto = document.querySelector('input');
const btnInsert = document.querySelector('.divInsert button');
const btnDeleteAll = document.querySelector('.header button');
const ul = document.querySelector('ul');

var itensDB = [];

// Função para mostrar notificações
function showNotification(message, type = 'success') {
  const container = document.getElementById('notification-container');

  // Cria o elemento da notificação
  const notification = document.createElement('div');
  notification.className = `notification ${type}`;
  notification.textContent = message;

  // Adiciona a notificação ao contêiner
  container.appendChild(notification);

  // Remove a notificação após 3 segundos
  setTimeout(() => {
    notification.classList.add('hide');
    setTimeout(() => {
      notification.remove();
    }, 500);
  }, 3000);
}

// Botão para excluir todas as tarefas
btnDeleteAll.onclick = () => {
  // Mensagem de confirmação
  if (confirm('Tem certeza que deseja excluir todas as tarefas?')) {
    fetch('./php/to-do-list/excluir_todas_tarefas.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' }
    })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          itensDB = [];
          updateDB();
          showNotification(data.message, 'success');
        } else {
          showNotification(data.message, 'error');
        }
      })
      .catch(error => {
        console.error('Erro ao excluir todas as tarefas:', error);
        showNotification('Erro ao excluir todas as tarefas!', 'error');
      });
  }
};


// Adicionar tarefa com Enter ou Tab
texto.addEventListener('keydown', e => {
  if ((e.key === 'Enter' || e.key === 'Tab') && texto.value !== '') {
    e.preventDefault(); // Evita o comportamento padrão do Tab
    setItemDB();
  }
});

// Botão de adicionar tarefa
btnInsert.onclick = () => {
  if (texto.value !== '') {
    setItemDB();
    showNotification('Tarefa adicionada com sucesso!', 'success');
  } else {
    showNotification('Digite uma descrição para a tarefa!', 'error');
  }
};

// Adicionar item ao banco de dados
function setItemDB() {
  if (itensDB.length >= 20) {
    showNotification('Limite máximo de 20 itens atingido!', 'error');
    return;
  }

  const descricao = texto.value;
  const status = '';

  fetch('./php/to-do-list/adicionar_tarefa.php', {
    method: 'POST',
    body: JSON.stringify({ descricao, status }),
    headers: { 'Content-Type': 'application/json' }
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        itensDB.push({ item: descricao, status: '', id: data.tarefa_id });
        updateDB();
        showNotification(data.message, 'success');
      } else {
        showNotification(data.message, 'error');
      }
    });
}

// Atualizar lista de tarefas no localStorage
function updateDB() {
  localStorage.setItem('todolist', JSON.stringify(itensDB));
  loadItens();
}

// Carregar tarefas da lista
function loadItens() {
  ul.innerHTML = '';

  fetch('./php/to-do-list/listar_tarefas.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' }
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        itensDB = data.tarefas;
        itensDB.forEach((item, i) => {
          insertItemTela(item.descricao, item.status, i, item.id);
        });
      }
    })
    .catch(error => {
      console.error('Erro ao carregar tarefas:', error);
      showNotification('Erro ao carregar tarefas!', 'error');
    });
}

// Inserir tarefa na tela
function insertItemTela(text, status, i, id) {
  const li = document.createElement('li');

  li.innerHTML = `
    <div class="divLi">
      <input type="checkbox" ${status} data-i=${i} onchange="done(this, ${i}, ${id});" />
      <span data-si=${i}>${text}</span>
      <button onclick="removeItem(${i}, ${id})" data-i=${i}><i class='bx bx-trash'></i></button>
      <button onclick="editItem(${i}, ${id})" data-i=${i}><i class='bx bx-edit'></i></button>
    </div>
  `;
  ul.appendChild(li);

  texto.value = '';
}

// Função para excluir uma tarefa
function removeItem(i, id) {
  if (confirm('Tem certeza que deseja excluir esta tarefa?')) {
    fetch('./php/to-do-list/excluir_tarefa.php', {
      method: 'POST',
      body: JSON.stringify({ id }),
      headers: { 'Content-Type': 'application/json' }
    })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          itensDB.splice(i, 1);
          updateDB();
          showNotification(data.message, 'success');
        } else {
          showNotification(data.message, 'error');
        }
      });
  }
}

// Editar uma tarefa
function editItem(i, id) {
  const novaDescricao = prompt('Nova descrição da tarefa:', itensDB[i].item);
  if (novaDescricao) {
    fetch('./php/to-do-list/editar_tarefa.php', {
      method: 'POST',
      body: JSON.stringify({ id, descricao: novaDescricao }),
      headers: { 'Content-Type': 'application/json' }
    })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          itensDB[i].item = novaDescricao;
          updateDB();
          showNotification(data.message, 'success');
        } else {
          showNotification(data.message, 'error');
        }
      })
      .catch(error => {
        console.error('Erro ao editar tarefa:', error);
        showNotification('Erro ao editar tarefa!', 'error');
      });
  }
}

function done(chk, i, id) {
  const status = chk.checked ? 1 : 0; // Usar 1 para concluído e 0 para não concluído

  // Atualizar visualmente a tarefa
  const descricaoElemento = document.querySelector(`[data-si="${i}"]`);
  if (status === 1) {
    descricaoElemento.classList.add('line-through'); // Aplica o risco
  } else {
    descricaoElemento.classList.remove('line-through'); // Remove o risco
  }

  // Enviar para o backend para atualizar o status no banco de dados
  fetch('./php/to-do-list/editar_tarefa.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ id, status })
  })
    .then(response => response.json())
    .then(data => {
      if (!data.success) {
        alert(data.message);
      }
    })
    .catch(error => {
      console.error('Erro ao atualizar o status da tarefa:', error);
      alert('Erro ao atualizar o status!');
    });
}

loadItens();