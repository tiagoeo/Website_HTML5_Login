<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost";
        $username = "root";
        $password = "root";

        if (isset($_POST['nome']) and isset($_POST['email']) and isset($_POST['senha1']) and isset($_POST['senha2'])){
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha;
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
            }else{
                $senha = sha1($senha1.'Website').md5($senha1.'JKBootstrap').sha1($senha1.'2024');
            }

            # REGISTRO
            try {
                $conn = new PDO("mysql:host=$servername;dbname=websitedb", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $cadastro = "INSERT INTO cadastro (nome, email, senha) VALUES (:param1, :param2, :param3);";
                
                $cadastro = $conn->prepare($cadastro);

                $cadastro->bindValue("param1", $nome);
                $cadastro->bindValue("param2", $email);
                $cadastro->bindValue("param3", $senha);

                $cadastro->execute();

                if (isset($cadastro) and $cadastro != false){
                    echo "Cadastro efetuado com sucesso!";
                }else{    
                    echo "Falha ao realizar o cadastro!";
                }

                $conn = null;
                exit();
                
            } catch(PDOException $e) {
                echo "Falha na conexão: " . $e->getMessage();
            }
            exit();

        }else if (isset($_POST['email']) and isset($_POST['senha'])){
            $email = $_POST['email'];
            $senha1 = $_POST['senha'];

            # VALIDAÇÃO
            if (empty($email)) {
                echo("Email em branco.");
                exit();
            }
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                echo("Email não é válido.");
                exit();
            }

            if (empty($senha1)) {
                echo("Senha em branco.");
                exit();
            }

            $senha = sha1($senha1.'Website').md5($senha1.'JKBootstrap').sha1($senha1.'2024');
            
            # LOGIN
            try {
                $conn = new PDO("mysql:host=$servername;dbname=websitedb", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $login = "SELECT cadastro.nome FROM cadastro WHERE email = :param1 && senha = :param2;";
                
                $login = $conn->prepare($login);

                $login->bindValue("param1", $email);
                $login->bindValue("param2", $senha);

                $login->execute();

                $result = $login->fetch();

                if (isset($result) and $result != false){
                    header('Content-Type: text/html; charset=utf-8');
                    echo "Login efetuado com sucesso!, seja bem vindo <b>".mb_convert_case(($result['nome']), MB_CASE_TITLE, 'UTF-8');
                }else{    
                    echo "Falha ao realizar o login!";
                }

                $conn = null;
                exit();
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