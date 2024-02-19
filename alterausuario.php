<?php
include("cabecalho.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];
    $status = $_POST['status'];

    // Atualiza os dados no banco de dados
    $sql = "UPDATE usuarios SET usu_login = '$login', usu_senha = '$senha', usu_email = '$email', usu_status = '$status'";

    $sql .= " WHERE usu_id = $id";

    mysqli_query($link, $sql);

    echo "<script>window.alert('usuario alterado com sucesso!');</script>";
    echo "<script>window.location.href='listausuario.php';</script>";
}

$id = $_GET['id'];
$sql = "SELECT * FROM usuarios WHERE usu_id = '$id'";
$retorno = mysqli_query($link, $sql);

while ($tbl = mysqli_fetch_array($retorno)) {
    $login = $tbl[1];
    $senha = $tbl[2];
    $email = $tbl[5];
    $status = $tbl[3];
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="alterausuario.css">
        <link rel="stylesheet" href="cabecalho.css">
        
        <title>ALTERA USUÁRIO</title>
    </head>
    <body>
        <div class="alterausuario-container">
            <div class="wrapper">
                <form action="alterausuario.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?=$id?>">
                    <h3>Usuário</h3>
                    <div class="input-box" id="input-box-name">
                        <input type="text" name="login" id="login" value="<?=$login?>">
                    </div>
                    <h3>Senha</h3>
                    <div class="input-box" id="input-box-name">
                        <input type="password" name="senha" id="senha" value="<?=$senha?>">
                    </div>
                    <h3>E-mail</h3>
                    <div class="input-box" id="input-box-preco">
                        <input type="email" name="email" id="email" value="<?=$email?>">
                    </div>
                    <h3>Status: <?= $status == 's' ? "Ativo" : "Inativo" ?></h3>
                    <div id="form-container">
                        <input type="radio" name="status" class="radio" value="s" id="radioativo" <?= $status == 's' ? "checked" : "" ?>>
                        <label class="radio-label" for="radioativo">Ativo</label>
                        <input type="radio" name="status" class="radio" value="n" id="radioinativo" <?= $status == 'n' ? "checked" : "" ?>>
                        <label class="radio-label" for="radioinativo">Inativo</label>
                    </div>
                    <button type="submit" class="btn">Alterar</button>
                </form>
            </div>
        </div>
    </body>
</html>