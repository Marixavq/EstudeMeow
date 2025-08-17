// Seleção de elementos
const paletteIcon = document.querySelector('.palete');
const colorTab = document.getElementById('colorTab');
const button = document.querySelector('.btn'); // Seletor para o botão

// Alterna a exibição da aba de cores ao clicar na paleta
paletteIcon.onclick = (event) => {
    event.preventDefault();
    
    // Verificar o status do login ao tentar exibir a paleta
    fetch('./php/users/login_status.php')
        .then(response => response.text())
        .then(status => {
            if (status === 'logged_in') {
                // Usuário logado, exibe o modal de cores
                colorTab.style.display = colorTab.style.display === 'block' ? 'none' : 'block';
            } else {
                // Caso não esteja logado, redireciona para a tela de login
                window.location.href = 'login.html';
            }
        })
        .catch(error => console.error('Erro ao verificar login:', error));
};

// Fecha a aba ao clicar fora dela
window.onclick = (event) => {
    if (!colorTab.contains(event.target) && event.target !== paletteIcon) {
        colorTab.style.display = 'none';
    }
};

// Adiciona evento de clique para mudar a cor e o gradiente
document.querySelectorAll('.color-box').forEach((box) => {
    box.addEventListener('click', function () {
        // Remove classes de gradiente anteriores do <html>
        document.documentElement.classList.remove('gradient-pink', 'gradient-yellow', 'gradient-purple', 'gradient-blue', 'gradient-bronw');

        // Adiciona a classe do gradiente do elemento clicado ao <html>
        const selectedClass = this.classList[1]; // Assumindo que a segunda classe é a do gradiente
        document.documentElement.classList.add(selectedClass);

        // Atualiza o botão com a classe correspondente
        const button = document.querySelector('.btn');
        if (button) {
            button.className = `btn ${selectedClass}`; // Adiciona a classe de tema ao botão
        }

        // Salva o tema no localStorage
        localStorage.setItem('selectedTheme', selectedClass);

        // Fecha o popover após a seleção
        colorTab.style.display = 'none';
    });
});

// Restaurar tema salvo no localStorage
window.onload = () => {
    const savedTheme = localStorage.getItem('selectedTheme');
    if (savedTheme) {
        // Aplica o tema salvo ao <html>
        document.documentElement.classList.add(savedTheme);

        // Atualiza o botão, se existir
        const button = document.querySelector('.btn');
        if (button) {
            button.className = `btn ${savedTheme}`;
        }
    }
};

// Seleção do elemento da imagem
const themeImage = document.getElementById('themeImage');

// Adiciona evento de clique para mudar a cor e também atualizar a imagem
document.querySelectorAll('.color-box').forEach((box) => {
    box.addEventListener('click', function () {
        // Remove classes de gradiente anteriores do <html>
        document.documentElement.classList.remove('gradient-pink', 'gradient-yellow', 'gradient-purple', 'gradient-blue', 'gradient-bronw');

        // Adiciona a classe do gradiente do elemento clicado ao <html>
        const selectedClass = this.classList[1]; // Assumindo que a segunda classe é a do gradiente
        document.documentElement.classList.add(selectedClass);

        // Atualiza a imagem de acordo com o tema
        switch (selectedClass) {
            case 'gradient-pink':
                themeImage.src = './assets/images/minapc_pink.png';
                break;
            case 'gradient-yellow':
                themeImage.src = './assets/images/minapc_yellow.png';
                break;
            case 'gradient-purple':
                themeImage.src = './assets/images/minapc.png'; // Imagem padrão
                break;
            case 'gradient-blue':
                themeImage.src = './assets/images/minapc_blue.png';
                break;
            case 'gradient-bronw':
                themeImage.src = './assets/images/minapc_bronw.png';
                break;
        }

        // Salva o tema no localStorage
        localStorage.setItem('selectedTheme', selectedClass);

        // Fecha o popover após a seleção
        colorTab.style.display = 'none';
    });
});

// Restaurar tema salvo no localStorage
window.onload = () => {
    const savedTheme = localStorage.getItem('selectedTheme');
    if (savedTheme) {
        // Aplica o tema salvo ao <html>
        document.documentElement.classList.add(savedTheme);

        // Atualiza a imagem ao carregar a página
        switch (savedTheme) {
            case 'gradient-pink':
                themeImage.src = './assets/images/minapc_pink.png';
                break;
            case 'gradient-yellow':
                themeImage.src = './assets/images/minapc_yellow.png';
                break;
            case 'gradient-purple':
                themeImage.src = './assets/images/minapc.png'; // Imagem padrão
                break;
            case 'gradient-blue':
                themeImage.src = './assets/images/minapc_blue.png';
                break;
            case 'gradient-bronw':
                themeImage.src = './assets/images/minapc_bronw.png';
                break;
        }
    }
};