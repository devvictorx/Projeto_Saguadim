
<?php
include("cabecalho.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];
    $curso = $_POST['curso'];
    $sala = $_POST['sala'];
    $status = $_POST['status'];

    //*INSERIR INSTRUÇÕES NO BANCO  
    $sql = "SELECT COUNT(cli_id) FROM clientes WHERE cli_email = '$email' OR cli_nome = '$nome'";
    $resultado = mysqli_query($link, $sql);
    $resultado = mysqli_fetch_array($resultado) [0];
    //*GRAVA LOG  
    $sql = '"'.$sql.'"';
    $sqllog = "INSERT INTO tab_log (tab_query, tab_data) VALUES ($sql, NOW())";
    mysqli_query($link, $sqllog);
    //*VERIFICA SE EXISTE
    if($resultado >= 1){
        echo"<script>window.alert('CLIENTE JÁ CADASTRADO');</script>";
        echo"<script>window.location.href='cadastracliente.php';</script>";
    }
    else{
        $sql = "INSERT INTO clientes(cli_nome, cli_email, cli_telefone, cli_cpf, cli_curso, cli_sala, cli_status) 
                VALUES('$nome','$email','$telefone','$cpf','$curso','$sala', 's')";
        mysqli_query($link, $sql);

         //*GRAVA LOG
        $sql ='"'.$sql.'"';
        $sqllog ="INSERT INTO tab_log (tab_query, tab_data) VALUES ($sql, NOW())";
        mysqli_query($link, $sqllog);

        echo"<script>window.alert('CLIENTE CADASTRADO');</script>";
        echo"<script>window.location.href='listacliente.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <link rel="stylesheet" href="cadastracliente.css">
        <title>CADASTRO DE CLIENTE</title>
    </head>
    <body>
        <div class="cadastrausuario-container">
            <div class="wrapper">
                <form action="cadastracliente.php" method="post">
                    <h1>Cadastrar Cliente</h1>
                    <div class="input-box" id="input-box-name">
                        <input id="login-name" type="text" name="nome" placeholder="Nome">
                        <i class='bx bxs-user'></i>
                    </div>
                    <div class="input-box" id="input-box-email">
                        <input id="login-email" type="email" name="email" placeholder="Email">
                        <i class='bx bxs-mail'></i>
                    </div>
                    <div class="input-box" id="input-box-email">
                        <input id="login-email" type="number" name="telefone" placeholder="(00) 0000-0000">
                        <i class='bx bxs-mail'></i>
                    </div>
                    <div class="input-box" id="input-box-email">
                        <input id="login-email" type="text" name="cpf" placeholder="000-000-000-00">
                        <i class='bx bxs-mail'></i>
                    </div>
                    <div class="input-box" id="input-box-email">
                        <input id="login-email" type="text" name="curso" placeholder="Curso">
                        <i class='bx bxs-mail'></i>
                    </div>
                    <div class="input-box" id="input-box-email">
                        <input id="login-email" type="text" name="sala" placeholder="Sala">
                        <i class='bx bxs-mail'></i>
                    </div>
                    
                    <button type="submit" class="btn">Cadastrar</button>
                </form>
            </div>
        </div>
    </body>
</html>