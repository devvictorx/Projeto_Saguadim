<?php
// Inclui o arquivo de conexão com o banco de dados
include("conectadb.php");

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recupera os dados do formulário
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];
    $curso = $_POST['curso'];
    $sala = $_POST['sala'];
    $saldo = $_POST['saldo'];
    $status = $_POST['status'];

    // Monta a instrução SQL para atualizar os dados do cliente
    $sql = "UPDATE clientes SET cli_nome = '$nome', cli_email = '$email', cli_telefone = '$telefone', cli_cpf = '$cpf',
    cli_curso = '$curso', cli_sala = '$sala', cli_saldo = '$saldo', cli_status = '$status'";
    
    $sql .= " WHERE cli_id = $id";

    // Executa a instrução SQL
    mysqli_query($link, $sql);

    // Exibe um alerta e redireciona para a página de lista de clientes
    echo "<script>window.alert('Cliente alterado com sucesso!');</script>";
    echo "<script>window.location.href='listacliente.php';</script>";
}

// Recupera o ID do cliente da URL
$id = $_GET['id'];

// Seleciona os dados do cliente pelo ID
$sql = "SELECT * FROM clientes WHERE cli_id = '$id'";
$retorno = mysqli_query($link, $sql);

// Obtém os dados do cliente
while ($tbl = mysqli_fetch_array($retorno)) {
    $nome =  $tbl[1];
    $email =  $tbl[2];
    $telefone =  $tbl[3];
    $cpf =  $tbl[4];
    $curso =  $tbl[5];
    $sala =  $tbl[6];
    $saldo =  $tbl[8];
    $status =  $tbl[7];
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="alteracliente.css">
        <link rel="stylesheet" href="cabecalho.css">
        
        <title>ALTERA USUÁRIO</title>
    </head>
    <body>
        <div class="alteracliente-container">
            <div class="wrapper">
                <form action="alteracliente.php" method="post" enctype="multipart/form-data">
                    <!-- Input hidden para armazenar o ID do cliente -->
                    <input type="hidden" name="id" value="<?=$id?>">
                    <h3>Cliente</h3>
                    <div class="input-box" id="input-box-name">
                        <input type="text" name="nome" id="nome" value="<?=$nome?>">
                    </div>
                    <h3>E-mail</h3>
                    <div class="input-box" id="input-box-preco">
                        <input type="email" name="email" id="email" value="<?=$email?>">
                    </div>
                    <h3>Telefone</h3>
                    <div class="input-box" id="input-box-name">
                        <input type="number" name="telefone" id="telefone" value="<?=$telefone?>">
                    </div>
                    <h3>CPF</h3>
                    <div class="input-box" id="input-box-email">
                        <input id="login-email" type="text" name="cpf" placeholder="000-000-000-00">
                        <i class='bx bxs-mail'></i>
                    </div>
                    <h3>Curso</h3>
                    <div class="input-box" id="input-box-email">
                        <input id="login-email" type="text" name="curso" placeholder="Curso">
                        <i class='bx bxs-mail'></i>
                    </div>
                    <h3>Sala</h3>
                    <div class="input-box" id="input-box-email">
                        <input id="login-email" type="text" name="sala" placeholder="Sala">
                        <i class='bx bxs-mail'></i>
                    </div>
                    <h3>Saldo</h3>
                    <div class="input-box" id="input-box-email">
                        <input id="login-email" type="number" name="saldo" placeholder="Saldo">
                        <i class='bx bxs-mail'></i>
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
