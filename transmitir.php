<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost";
        $username = "root";
        $password = "root";

        if (isset($_POST['nome']) and isset($_POST['email']) and isset($_POST['senha1']) and isset($_POST['senha2'])){
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha1 = $_POST['senha1'];
            $senha2 = $_POST['senha2'];

            # VALIDAÇÃO
            if (empty($nome)) {
              echo("Nome em branco.");
              exit();
            }

            if (empty($email)) {
                echo("Email em branco.");
                exit();
            }
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                echo("Email não é válido.");
                exit();
            }

            if (empty($senha1)) {
                echo("Senha1 em branco.");
                exit();
            }
            if (empty($senha2)) {
                echo("Senha2 em branco.");
                exit();
            }
            if ($senha1 != $senha2){
                echo("Senhas diferentes.");
                exit();
            }

            # REGISTRO
            try {
                $conn = new PDO("mysql:host=$servername;dbname=websitedb", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Conectado ao Bando Mysql";
            } catch(PDOException $e) {
                echo "Falha na conexão: " . $e->getMessage();
            }
            exit();

        }else if (isset($_POST['email']) and isset($_POST['senha'])){
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            # VALIDAÇÃO
            if (empty($email)) {
                echo("Email em branco.");
                exit();
            }
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                echo("Email não é válido.");
                exit();
            }

            if (empty($senha)) {
                echo("Senha em branco.");
                exit();
            }
            
            # LOGIN
            try {
                $conn = new PDO("mysql:host=$servername;dbname=websitedb", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Conectado ao Bando Mysql";
            } catch(PDOException $e) {
                echo "Falha na conexão: " . $e->getMessage();
            }
            exit();
        }else{
            exit();
        }
    }else{
        exit();
    }
?>