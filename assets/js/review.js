// Seleção de elementos principais
const paletteIcon = document.querySelector('.palete');
const colorTab = document.getElementById('colorTab');
const button = document.querySelector('.btn'); // Seletor para o botão
const themeImage = document.getElementById('themeImage'); // Imagem a ser atualizada

// Alterna a exibição da aba de cores ao clicar na paleta
paletteIcon.onclick = (event) => {
    event.preventDefault();
    colorTab.style.display = colorTab.style.display === 'block' ? 'none' : 'block';

    // Verificar status de login ao clicar
    document.getElementById('colorTab').addEventListener('click', function () {
        fetch('./php/users/login_status.php')
            .then(response => response.text())
            .then(status => {
                if (status === 'logged_in') {
                    colorTab.style.display = 'block';
                } else {
                    window.location.href = 'login.html';
                }
            })
            .catch(error => console.error('Erro ao verificar login:', error));
    });
};

// Fecha a aba de cores ao clicar fora dela
window.onclick = (event) => {
    if (!colorTab.contains(event.target) && event.target !== paletteIcon) {
        colorTab.style.display = 'none';
    }
};

// Mapeia temas para as imagens correspondentes
const themeImages = {
    'gradient-pink': './assets/images/gatoblack.png',
    'gradient-yellow': './assets/images/abelha.png',
    'gradient-purple': './assets/images/gatinho_coração.png',
    'gradient-blue': './assets/images/robo.png',
    'gradient-bronw': './assets/images/pena.png',
};

// Adiciona evento de clique para mudar a cor e a imagem
document.querySelectorAll('.color-box').forEach((box) => {
    box.addEventListener('click', function () {
        // Remove gradientes antigos do <html>
        document.documentElement.classList.remove('gradient-pink', 'gradient-yellow', 'gradient-purple', 'gradient-blue', 'gradient-bronw');

        // Adiciona o gradiente selecionado
        const selectedClass = this.classList[1];
        document.documentElement.classList.add(selectedClass);

        // Atualiza o botão com o tema
        if (button) {
            button.className = `btn ${selectedClass}`;
        }

        // Atualiza a imagem de acordo com o tema
        if (themeImage && themeImages[selectedClass]) {
            themeImage.src = themeImages[selectedClass];
        }

        // Salva o tema no localStorage
        localStorage.setItem('selectedTheme', selectedClass);

        // Fecha o popover após a seleção
        colorTab.style.display = 'none';
    });
});

// Restaura tema e imagem do localStorage ao carregar a página
window.onload = () => {
    const savedTheme = localStorage.getItem('selectedTheme');
    if (savedTheme) {
        // Aplica o tema salvo
        document.documentElement.classList.add(savedTheme);

        // Atualiza o botão
        if (button) {
            button.className = `btn ${savedTheme}`;
        }

        // Atualiza a imagem
        if (themeImage && themeImages[savedTheme]) {
            themeImage.src = themeImages[savedTheme];
        }
    }
};