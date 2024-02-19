<?php
// Inclui o arquivo de cabeçalho
include("cabecalho.php");

// Verifica se o formulário foi submetido (via método POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os valores do formulário e protege contra SQL injection
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $senha = mysqli_real_escape_string($link, $_POST['senha']);
    $login = mysqli_real_escape_string($link, $_POST['login']);

    // Gera uma chave aleatória
    $key = rand(100000, 999999);

    // Verifica se o email ou login já existem no banco de dados
    $sql_check_existing = "SELECT COUNT(usu_id) FROM usuarios
        WHERE usu_email = '$email' OR usu_login = '$login'";
    $result_check_existing = mysqli_query($link, $sql_check_existing);
    $count_existing = mysqli_fetch_array($result_check_existing)[0];

    // Se já existir um usuário com o mesmo email ou login, exibe um alerta e redireciona para a página de login
    if ($count_existing >= 1) {
        echo "<script>window.alert('EMAIL OU LOGIN JÁ EXISTENTE');</script>";
        echo "<script>window.location.href='login.html';</script>";
    } else {
        // Se não existir, insere o novo usuário no banco de dados
        $sql_insert_user = "INSERT INTO usuarios(usu_login, usu_senha, usu_status, usu_key, usu_email)
            VALUES ('$login', '$senha', 's', '$key', '$email')";
        mysqli_query($link, $sql_insert_user);

        // Exibe um alerta de sucesso e redireciona para a página de login
        echo "<script>window.alert('USUÁRIO CADASTRADO COM SUCESSO');</script>";
        echo "<script>window.location.href='login.html';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login2.css">
    <link rel="stylesheet" href="cabecalho.css">
    <title>CADASTRA USUARIO</title>
</head>
<body>
    <div id="cadastra">
        <!-- Formulário de cadastro de usuário -->
        <form action="cadastra2.php" method="post">
            <label for="login">LOGIN</label>
            <input type="text" name="login" id="login" required/>
            <label for="email">EMAIL</label>
            <input type="text" name="email" id="email" placeholder="email@email.com" required/>
            <label for="senha">SENHA</label>
            <input type="password" name="senha" id="senha" placeholder="" required/>
            <input type="submit" value="CADASTRAR"/>
        </form>
    </div>
</body>
</html>
