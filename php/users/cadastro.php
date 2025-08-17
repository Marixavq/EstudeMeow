<?php
include_once '../conexao.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["email"]) && isset($_POST["password"])) {

        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {
            $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password); 

            // Executa a query
            if ($stmt->execute()) {
                echo "<script>alert('Cadastro realizado com sucesso');</script>";
                echo "<script>location.href='../../index.html';</script>";
            } else {
                echo "<script>alert('Não foi possível cadastrar');</script>";
                echo "<script>location.href='cadastro.html';</script>";
            }
        } catch (PDOException $e) {
            die("Erro na consulta: " . $e->getMessage());
        }
    }
}
