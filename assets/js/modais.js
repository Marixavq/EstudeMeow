// Função para abrir o modal
const OpenModal = (modalId) => {
  document.body.classList.add('modal-open'); // Bloqueia interação fora do modal
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.add('show');
  }
};

// Função para fechar o modal
const CloseModal = (modalId) => {
  document.body.classList.remove('modal-open'); // Restaura interação
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.remove('show');
  }
};

// Adiciona os eventos de clique
document.addEventListener('DOMContentLoaded', () => {
  // Seleciona todos os links que abrem modais
  const modalTriggers = document.querySelectorAll('.card__button');

  // Seleciona todos os botões de fechamento dos modais
  const modalCloses = document.querySelectorAll('.popup-box .close');

  // Adiciona evento de clique em cada link
  modalTriggers.forEach(trigger => {
    trigger.addEventListener('click', (e) => {
      e.preventDefault(); // Previne o redirecionamento do link
      const modalId = trigger.id.replace('modalOpen', 'modal'); // Converte ID do link no ID do modal
      openModal(modalId);
    });
  });

  // Adiciona evento de clique em cada botão de fechar
  modalCloses.forEach(closeBtn => {
    const modalId = closeBtn.closest('.popup-outer').id;
    closeBtn.addEventListener('click', () => closeModal(modalId));
  });

  // Fecha o modal ao clicar fora da caixa do modal
  const modals = document.querySelectorAll('.popup-outer');
  modals.forEach(modal => {
    modal.addEventListener('click', (e) => {
      // Verifica se o clique foi na área fora do modal (não na caixa)
      if (e.target === modal) {
        closeModal(modal.id);
      }
    });
  });
});

// Modais dos Métodos

// Modal Mnemônica
const modalMnemonica = document.getElementById('modalMnemonica');
const openMnemonica = document.getElementById('modalOpenMnemonica');
const closeMnemonica = document.getElementById('closeMnemonica');

openMnemonica.addEventListener('click', (event) => {
  event.preventDefault();
  openModal(modalMnemonica);
});

closeMnemonica.addEventListener('click', () => {
  closeModal(modalMnemonica);
});

// Repita para os outros modais...

// Modal Pomodoro
const modalPomodoro = document.getElementById('modalPomodoro');
const openPomodoro = document.getElementById('modalOpenPomodoro');
const closePomodoro = document.getElementById('closePomodoro');

openPomodoro.addEventListener('click', (event) => {
  event.preventDefault();
  openModal(modalPomodoro);
});

closePomodoro.addEventListener('click', () => {
  closeModal(modalPomodoro);
});

// Modal Mapa Mental
const modalMapaMental = document.getElementById('modalMapaMental');
const openMapaMental = document.getElementById('modalOpenMapaMental');
const closeMapaMental = document.getElementById('closeMapaMental');

openMapaMental.addEventListener('click', (event) => {
  event.preventDefault();
  openModal(modalMapaMental);
});

closeMapaMental.addEventListener('click', () => {
  closeModal(modalMapaMental);
});

// Modal GTD
const modalGTD = document.getElementById('modalGTD');
const openGTD = document.getElementById('modalOpenGTD');
const closeGTD = document.getElementById('closeGTD');

openGTD.addEventListener('click', (event) => {
  event.preventDefault();
  openModal(modalGTD);
});

closeGTD.addEventListener('click', () => {
  closeModal(modalGTD);
});

// Modal Intercalado
const modalIntercalado = document.getElementById('modalIntercalado');
const openIntercalado = document.getElementById('modalOpenIntercalado');
const closeIntercalado = document.getElementById('closeIntercalado');

openIntercalado.addEventListener('click', (event) => {
  event.preventDefault();
  openModal(modalIntercalado);
});

closeIntercalado.addEventListener('click', () => {
  closeModal(modalIntercalado);
});

// Modal Auto Explicativo
const modalAutoExplicativo = document.getElementById('modalAutoExplicativo');
const openAutoExplicativo = document.getElementById('modalOpenAutoExplicativo');
const closeAutoExplicativo = document.getElementById('closeAutoExplicativo');

openAutoExplicativo.addEventListener('click', (event) => {
  event.preventDefault();
  openModal(modalAutoExplicativo);
});

closeAutoExplicativo.addEventListener('click', () => {
  closeModal(modalAutoExplicativo);
});

// Modal Feynman
const modalFeynman = document.getElementById('modalFeynman');
const openFeynman = document.getElementById('modalOpenFeynman');
const closeFeynman = document.getElementById('closeFeynman');

openFeynman.addEventListener('click', (event) => {
  event.preventDefault();
  openModal(modalFeynman);
});

closeFeynman.addEventListener('click', () => {
  closeModal(modalFeynman);
});

// Modal SQ3R
const modalSQ3R = document.getElementById('modalSQ3R');
const openSQ3R = document.getElementById('modalOpenSQ3R');
const closeSQ3R = document.getElementById('closeSQ3R');

openSQ3R.addEventListener('click', (event) => {
  event.preventDefault();
  openModal(modalSQ3R);
});

closeSQ3R.addEventListener('click', () => {
  closeModal(modalSQ3R);
});

// Modal Quiz

const modalQuiz = document.getElementById('modalQuiz');
const openQuiz = document.getElementById('modalOpenQuiz');
const closeQuiz = document.getElementById('closeQuiz');

openQuiz.addEventListener('click', (event) => {
  event.preventDefault();
  openModal(modalQuiz);
});

closeQuiz.addEventListener('click', () => {
  closeModal(modalQuiz);
});

// visualização do modal

// Abre o modal
const openModal = (modalId) => {
  document.body.classList.add('modal-open'); // Bloqueia interação fora do modal
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.add('show');
  }
};

// Fecha o modal
const closeModal = (modalId) => {
  document.body.classList.remove('modal-open'); // Restaura interação
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.remove('show');
  }
};

