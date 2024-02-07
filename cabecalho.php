<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
</head>
<body>
    <?php 
    include("conectadb.php");
    session_start();
    $nomeusuario = isset($_SESSION['nomeusuario']) ? $_SESSION['nomeusuario'] : null;
    ?>

    <div class="container">
        <ul class="menu">
            <li><a href="cadastra2.php">Cadastrar Usuário</a></li>
            <li><a href="listausuario.php">Listar Usuário</a></li>
            <li><a href="cadastraproduto.php">Cadastrar Produto</a></li>
            <li><a href="listaproduto.php">Listar Produto</a></li>
            <li><a href="cadastracliente.php">Cadastrar Cliente</a></li>
            <li><a href="listacliente.php">Listar Clientes</a></li>
            <li><a href="fornecedor.php">Fornecedor</a></li>
            <li><a href="encomendas.php">Encomendas</a></li>
            
            <?php 
            if($nomeusuario) {
            ?>
            <li><a href="logout.php">Sair</a></li>
            <li class="profile">Olá <?=strtoupper($nomeusuario) ?></li>
            <?php
            } else {
                echo "<script>window.alert('USUÁRIO NÃO AUTENTICADO');
                window.location.href='login.php';</script>";
            }
            ?>
        </ul>
    </div>

    <script src="script.js"></script>
</body>
</html>
