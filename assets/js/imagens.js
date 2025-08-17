// Seleção de elementos
const paletteIcon = document.querySelector('.palete');
const colorTab = document.getElementById('colorTab');
const themeImage = document.getElementById('themeImage'); // Garantir que a imagem exista

// Alterna a exibição da aba de cores ao clicar na paleta
paletteIcon.onclick = (event) => {
    event.preventDefault();

    // Exibe ou oculta a paleta de cores
    colorTab.style.display = colorTab.style.display === 'block' ? 'none' : 'block';
};

// Fecha a aba ao clicar fora dela
window.onclick = (event) => {
    if (!colorTab.contains(event.target) && event.target !== paletteIcon) {
        colorTab.style.display = 'none';
    }
};

// Função para atualizar o tema e a imagem na seção home
function updateThemeAndImage(selectedClass) {
    // Seleção da seção 'home', navbar e rodapé
    const homeSection = document.querySelector('.home');
    const navbar = document.querySelector('header');
    const footer = document.querySelector('footer');

    // Remove gradientes antigos
    homeSection.classList.remove('gradient-pink', 'gradient-yellow', 'gradient-purple', 'gradient-blue', 'gradient-bronw');
    navbar.classList.remove('theme-image');
    footer.classList.remove('theme-image');
    navbar.style.backgroundImage = ''; // Reseta a imagem de fundo
    footer.style.backgroundImage = ''; // Reseta a imagem de fundo

    // Adiciona a classe do gradiente no html
    document.documentElement.classList.add(selectedClass); // Aplica o tema no <html>

    let imageUrl = '';
    switch (selectedClass) {
        case 'gradient-pink':
            imageUrl = './assets/images/fundo_pink.jpeg';
            homeSection.style.backgroundSize = 'contain';
            homeSection.style.backgroundPosition = 'center';
            homeSection.style.backgroundRepeat = 'no-repeat';
            homeSection.style.height = '100vh';
            break;
        case 'gradient-yellow':
            imageUrl = './assets/images/fundo_yellow.jpeg';
            homeSection.style.backgroundSize = 'contain';
            homeSection.style.backgroundPosition = 'center';
            homeSection.style.backgroundRepeat = 'no-repeat';
            homeSection.style.height = '100vh';
            break;
        case 'gradient-blue':
            imageUrl = './assets/images/fundo_blue.jpeg';
            navbar.classList.add('theme-image');
            footer.classList.add('theme-image');
            navbar.style.backgroundImage = `url(${imageUrl})`;
            footer.style.backgroundImage = `url(${imageUrl})`;
            homeSection.style.backgroundSize = 'cover';
            homeSection.style.backgroundPosition = 'center';
            homeSection.style.height = '100%';
            break;
        case 'gradient-bronw':
            imageUrl = './assets/images/fundo_bronw.jpeg';
            navbar.classList.add('theme-image');
            footer.classList.add('theme-image');
            navbar.style.backgroundImage = `url(${imageUrl})`;
            footer.style.backgroundImage = `url(${imageUrl})`;
            homeSection.style.backgroundSize = 'cover';
            homeSection.style.backgroundPosition = 'center';
            homeSection.style.height = '100%';
            break;
        default:
            imageUrl = '';
            break;
    }

    homeSection.style.backgroundImage = `url(${imageUrl})`;

    // Atualiza a imagem do tema (se aplicável)
    if (themeImage) {
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
    }

    // Salva o tema no localStorage
    localStorage.setItem('selectedTheme', selectedClass);
}

// Adiciona evento de clique para mudar a cor e o gradiente
document.querySelectorAll('.color-box').forEach((box) => {
    box.addEventListener('click', function () {
        // Remove classes de gradiente anteriores do <html>
        document.documentElement.classList.remove('gradient-pink', 'gradient-yellow', 'gradient-purple', 'gradient-blue', 'gradient-bronw');

        // Adiciona a classe do gradiente do elemento clicado ao <html>
        const selectedClass = this.classList[1]; // Assumindo que a segunda classe é a do gradiente
        document.documentElement.classList.add(selectedClass);

        // Atualiza as imagens de fundo e outras propriedades
        updateThemeAndImage(selectedClass);

        // Fecha o popover após a seleção
        colorTab.style.display = 'none';
    });
});

// Restaurar tema e imagem de fundo ao carregar a página
window.onload = () => {
    const savedTheme = localStorage.getItem('selectedTheme');
    if (savedTheme) {
        // Aplica todas as propriedades ao carregar a página
        updateThemeAndImage(savedTheme);
    }
};