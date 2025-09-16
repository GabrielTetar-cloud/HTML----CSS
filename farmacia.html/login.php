<?php
    session_start();
    require 'contact_bd.php';

    // Cria conexão
    $conn = new mysqli($host, $username, $pasword, $bdbname);

    // Verifica conexão
    if ($conn->connect_error) {
        die("<strong>Falha de conexão: </strong>" . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuario = $conn->real_escape_string($_POST['Login']);
        $senha   = $conn->real_escape_string($_POST['Senha']);

        $sql = "SELECT ID_Usuario, nome FROM usuario WHERE login = '$usuario' AND senha = MD5('$senha')";

        if ($result = $conn->query($sql)) {
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $_SESSION['login']       = $usuario;
                $_SESSION['ID_Usuario']  = $row['ID_Usuario'];
                $_SESSION['nome']        = $row['nome'];

                unset($_SESSION['nao_autenticado']);
                unset($_SESSION['mensagem_header']);
                unset($_SESSION['mensagem']);

                header('Location: ClienteListar.php');
                exit();
            } else {
                $_SESSION['nao_autenticado'] = true;
                $_SESSION['mensagem_header'] = "Login";
                $_SESSION['mensagem']        = "ERRO: Login ou senha inválidos.";
                header('Location: index1.html');
                exit();
            }
        } else {
            echo "<p>Erro ao acessar o banco de dados: " . $conn->error . "</p>";
        }

        $conn->close();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Farmacia São João - Login</title>
    <link rel="icon" type="image/png" href="imagens/favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/stlem.css">
    
</head>
<body>
    <header>
         <h1>
               Login do Usuário
            </h1>
           

</header>
    <main>
        
        <form class="form-group" method="post" action="login.php">
            <p>
                <label ><b>Login</b></label>
                <input  name="Login" type="text" required>
            </p>
            <p>
                <label ><b>Senha</b></label>
                <input name="Senha" type="password" required>
            </p>
            <p >
                <button class="w3-btn w3-theme" type="submit">Entrar</button>
            </p>
        </form>

        <?php
        if (isset($_SESSION['nao_autenticado']) && $_SESSION['nao_autenticado'] == true) {
            echo "<div class='w3-panel w3-red w3-center'><p><b>" . $_SESSION['mensagem'] . "</b></p></div>";
        }
        ?>
    </div>
</body>
</html>