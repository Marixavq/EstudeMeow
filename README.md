# 🎓 EstudeMeow

Projeto desenvolvido como Trabalho de Conclusão de Curso (TCC) no Ensino Médio Integrado ao Técnico em Desenvolvimento de Sistemas (ETEC Parque da Juventude, 2024).

O **EstudeMeow** é uma plataforma web que ajuda estudantes a organizar sua rotina de estudos, unindo ferramentas de planejamento e métodos de estudo em um só lugar.


---

## 📌 Funcionalidades

- 📅 **Calendário de estudos**: agende os dias em que pretende estudar e organize sua rotina.  
- ✅ **To-Do List de tarefas**: registre e acompanhe atividades acadêmicas e prazos.  
- 📖 **Explicação de métodos de estudo**: o site apresenta diferentes técnicas de aprendizado (Pomodoro, mapas mentais, GTD, etc.).  
- 🧩 **Quiz interativo**: sugere o melhor método de estudo de acordo com o perfil do usuário *(desenvolvido por outros integrantes da equipe)*.  
- 🔑 **Sistema de recuperação de senha via e-mail**: envio de link seguro para redefinição de senha.  
- 🎨 **Troca de temas**: escolha entre tema azul, amarelo, rosa e outros, personalizando a interface *(desenvolvido por outros integrantes da equipe)*.  


---

## 🛠 Tecnologias utilizadas

- **PHP** – backend e regras de negócio  
- **MySQL** – banco de dados relacional para persistência de dados  
- **JavaScript** – interatividade (calendário, to-do list, quiz, temas)  
- **HTML5 & CSS3** – estrutura e design das páginas  
- **PHPMailer** – envio de e-mails para recuperação de senha  


---

## 👩‍💻 Minha contribuição

O projeto foi realizado em equipe (8 integrantes).  
Minhas principais responsabilidades foram:

- Modelagem e implementação do **banco de dados MySQL**  
- Desenvolvimento do **backend em PHP**  
- Implementação do **sistema de recuperação de senha via e-mail (com PHPMailer)**  
- Lógica de integração com o **to-do list**  
- Apoio em trechos de **JavaScript**  


---

## ⚙️ Configuração do sistema de e-mails

O recurso de recuperação de senha foi implementado com [PHPMailer](https://github.com/PHPMailer/PHPMailer).

## Como configurar:
1. Instale o PHPMailer:
   ```bash
   composer require phpmailer/phpmailer
Caso prefira, também é possível baixar a biblioteca manualmente.

2. No arquivo responsável pelo envio de e-mails, configure suas credenciais SMTP:

   ```bash
   $mail->setFrom('seu_email@dominio.com', 'Nome do Remetente');
   $mail->addAddress($email, 'Usuário');

   $mail->Host = 'smtp.gmail.com';
   $mail->Username = 'seu_email@dominio.com';
   $mail->Password = 'sua_senha_app'; 
   $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
   $mail->Port = 587;

## 🚀 Como executar o projeto
1. Clone este repositório:

    ```bash
   git clone https://github.com/Marixavq/EstudeMeow
    
2. Configure um servidor local (XAMPP, WAMP ou Laragon).

3. Importe o banco de dados disponível em agenda.sql no MySQL.

4. Configure as credenciais SMTP para habilitar o envio de e-mails.

5. Acesse no navegador:
   ```bash
   http://localhost/estudemeow

## 📖 Observações
Este é um projeto acadêmico, desenvolvido com fins de aprendizado.
Atualmente não está em produção, mas pode servir como base para estudos e futuras melhorias.

