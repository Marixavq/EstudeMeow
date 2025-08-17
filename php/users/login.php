 <?php
    include_once '../conexao.php';

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if (empty($_POST["email"]) || empty($_POST["password"])) {
            header("Location: ../index.php");
            exit();
        }
        session_start();

        $_SESSION['user_id'] = $user_id;

        $email = $_POST["email"];
        $password = $_POST["password"];

        try {
            $sql = "SELECT id, name, password FROM users WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':email', $email);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_OBJ);

                if (password_verify($password, $row->password)) {

                    $_SESSION["user_id"] = $row->id;
                    $_SESSION["name"] = $row->name;

                    header("Location: ../../index.html");
                    exit();
                } else {
                    echo "<script>alert('Usuário e/ou senha incorreto(s)');</script>";
                    echo "<script>location.href='../../login.html';</script>";
                    exit();
                }
            } else {
                echo "<script>alert('Usuário e/ou senha incorreto(s)');</script>";
                echo "<script>location.href='../../login.html';</script>";
                exit();
            }
        } catch (PDOException $e) {
            die("Erro na consulta: " . $e->getMessage());
        }
    }
    ?>


