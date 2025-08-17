const links = {
    "Mapa Mental": "https://www.lucidchart.com/pages/pt/o-que-e-mapa-mental-e-como-fazer",
    "Estudo Intercalado": "https://planejativo.com/tecnica-de-estudo-intercalado/",
    "SQ3R": "https://updateordie.com/2023/04/21/sq3r-voce-conhece-esse-metodo-de-leitura-e-estudo/",
    "GTD": "https://asana.com/pt/resources/getting-things-done-gtd?utm_campaign=NB--LATAM--ES--Catch-All--All-Device--DSA&utm_source=google&utm_medium=pd_cpc_nb&gad_source=1&gclsrc=aw.ds",
    "Feynman": "https://revistagalileu.globo.com/sociedade/curiosidade/noticia/2024/08/tecnica-feynman-como-estudar-qualquer-assunto-em-4-passos.ghtml",
    "Mnemônica": "https://www.unicesumar.edu.br/blog/tecnica-mnemonica/#:~:text=Uma%20%C3%B3tima%20forma%20de%20usar,melhor%20entendimento%20e%20melhor%20sonoridade.",
    "Pomodoro": "https://conexao.pucminas.br/blog/dicas/metodo-pomodoro-de-estudo/",
    "Autoexplicativo": "https://oficinadamente.com/auto-explicacao-quer-aprender-explique-voce-mesmo/"
};


const quizData = [
    {
        question: "Das opções abaixo, quais você possui maior dificuldade em relação aos estudos?",
        options: {
            a: "Fixação de conteúdo",
            b: "Organização",
            c: "Memória",
            d: "Concentração"
        },
        followUps: {
            a: {
                question: "Para fixar o conteúdo, você precisa de:",
                options: {
                    a: { text: "Fácil Compreensão", response: "Mapa Mental" },
                    b: { text: "Produtividade", response: "Estudo Intercalado" }
                }
            },
            b: {
                question: "Para se organizar melhor, você precisa de:",
                options: {
                    a: { text: "Absorver Info. Relevantes", response: "SQ3R" },
                    b: { text: "Tarefa em curto prazo", response: "GTD" }
                }
            },
            c: {
                question: "Para memorização do conteúdo, você precisa de:",
                options: {
                    a: { text: "Identificação de Lacunas", response: "Feynman" },
                    b: { text: "Acrônimos e Acrósticos", response: "Mnemônica" }
                }
            },
            d: {
                question: "Para manter sua concentração, você precisa de:",
                options: {
                    a: { text: "Otimização de Tempo", response: "Pomodoro" },
                    b: { text: "Dinâmico", response: "Autoexplicativo" }
                }
            }
        }
    }
];

const quiz = document.getElementById("quiz");
const countQuestion = document.getElementById("count-question");
const totalNumberOfQuestions = document.getElementById("total-questions");
const questionTitle = document.getElementById("question");
const answerLabels = document.querySelectorAll(".answer-label");
const nextQuestionBtn = document.getElementById("next-question-btn");
const allInputs = document.querySelectorAll("input[type='radio']");
const submitQuiz = document.getElementById("submit");
const resultEl = document.getElementById("result");
const scoreEl = document.getElementById("score");

let currentQtn = 0;
let followUpQtn = null;

// Função para carregar as perguntas
const loadQuiz = () => {
    countQuestion.innerHTML = `${currentQtn + 1}`;
    totalNumberOfQuestions.innerHTML = "2"; // Total de perguntas
    questionTitle.innerHTML = quizData[currentQtn].question;

    const options = quizData[currentQtn].options;
    answerLabels[0].innerHTML = options.a;
    answerLabels[1].innerHTML = options.b;
    answerLabels[2].innerHTML = options.c;
    answerLabels[3].innerHTML = options.d;

    // Mostrar todas as opções na pergunta principal
    answerLabels[2].style.display = "block";
    answerLabels[3].style.display = "block";

    reset();
};

// Função para resetar as opções selecionadas
const reset = () => {
    allInputs.forEach((input) => {
        input.checked = false;
    });
};

// Botão "Próxima Pergunta"
nextQuestionBtn.addEventListener("click", () => {
    const answer = getSelected();
    if (answer) {
        followUpQtn = answer; // Armazena a alternativa selecionada
        loadFollowUpQuestion();
    } else {
        showModal(); // Mostra o modal se não houver resposta
    }
});

// Função para carregar a pergunta de acompanhamento
const loadFollowUpQuestion = () => {
    const followUp = quizData[currentQtn].followUps[followUpQtn];
    questionTitle.innerHTML = followUp.question;
    const options = followUp.options;

    answerLabels[0].innerHTML = options.a.text;
    answerLabels[1].innerHTML = options.b.text;

    // Garantir que os inputs de rádio tenham valores corretos
    allInputs[0].value = "a"; // Garantir que value seja definido
    allInputs[1].value = "b"; // Garantir que value seja definido

    // Limpar e ocultar opções C e D
    answerLabels[2].innerHTML = "";
    answerLabels[3].innerHTML = "";
    answerLabels[2].style.display = "none";
    answerLabels[3].style.display = "none";

    document.querySelectorAll(".answer-number")[2].style.display = "none";
    document.querySelectorAll(".answer-number")[3].style.display = "none";

    submitQuiz.style.display = "block";
    nextQuestionBtn.style.display = "none";
};

// Botão "Ver Resultado"

submitQuiz.addEventListener("click", () => {
    const followUp = quizData[currentQtn].followUps[followUpQtn];
    const answer = getSelected();

    if (answer) {
        const response = followUp.options[answer].response;
        quiz.style.display = "none";
        resultEl.style.display = "block";
        scoreEl.innerHTML = `Método compatível: <span style="color: var(--detalls);">${response}</span>`;

        // Modificar o comportamento do botão para abrir o link em uma nova janela
        const moreInfoBtn = document.getElementById("more-info-btn");
        moreInfoBtn.onclick = () => {
            window.open(links[response], "_blank"); // Abre o link em uma nova aba
        };
    } else {
        showModal(); // Exibe o modal se não houver resposta
    }
});


// Função para obter a resposta selecionada
const getSelected = () => {
    let answer = null; // Variável inicia como null
    allInputs.forEach((input) => {
        if (input.checked) {
            answer = input.value;
        }
    });
    return answer;
};

// Inicializa o quiz
loadQuiz();

// Modal
const modal = document.getElementById("modal");
const closeModal = document.getElementById("close-modal");

const showModal = () => {
    modal.style.display = "block"; // Exibe o modal
};

closeModal.onclick = () => {
    modal.style.display = "none"; // Fecha o modal ao clicar no botão de fechar
};

window.onclick = (event) => {
    if (event.target === modal) {
        modal.style.display = "none"; // Fecha o modal ao clicar fora dele
    }
};