<?php 
include("conectadb.php");
session_start();


$nomeusuario = isset($_SESSION['nomeusuario']) ? $_SESSION['nomeusuario'] : "";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
</head>
<body>
    <div class="container">
        <ul class="menu">
            <li><a href="backofficecliente.php">HOME</a></li>
            <li><a href="encomendascliente.php">Encomendas</a></li>
            <link rel="stylesheet" href="cabecalho2.css">
            <?php 
            if($nomeusuario) {
            ?>
            <li><a href="logincliente.html">Sair</a></li>
            <li class="profile">Olá <?=strtoupper($nomeusuario) ?></li>
            <?php
            } else {
                echo "<script>window.alert('USUÁRIO NÃO AUTENTICADO');
                window.location.href='logincliente.html';</script>";
            }
            ?>
        </ul>
    </div>

    <script src="script.js"></script>
</body>
</html>
