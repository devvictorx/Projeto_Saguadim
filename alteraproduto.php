<?php
include("cabecalho.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $custo = $_POST['custo'];
    $preco = $_POST['preco'];
    $status = $_POST['status'];

    // Atualiza os dados no banco de dados
    $sql = "UPDATE produtos SET pro_nome = '$nome', pro_descricao = '$descricao', pro_custo = '$custo', pro_preco = '$preco', pro_status = '$status'";

    $sql .= " WHERE pro_id = $id";

    mysqli_query($link, $sql);

    echo "<script>window.alert('Produto alterado com sucesso!');</script>";
    echo "<script>window.location.href='listaproduto.php';</script>";
}

$id = $_GET['id'];
$sql = "SELECT * FROM produtos WHERE pro_id = '$id'";
$retorno = mysqli_query($link, $sql);

while ($tbl = mysqli_fetch_array($retorno)) {
    $nome = $tbl[1];
    $descricao = $tbl[2];
    $custo = $tbl[3];
    $preco = $tbl[4];
    $status = $tbl[5];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="alteraproduto1.css">
        <link rel="stylesheet" href="cabecalho.css">
        <title>ALTERA PRODUTO</title>
    </head>
    <body>
        <div class="alteraproduto-container">
            <div class="wrapper">
                <form action="alteraproduto.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?=$id?>">
                    <h3>Nome do Produto</h3>
                    <div class="input-box" id="input-box-name">
                        <input type="text" name="nome" id="nome" value="<?=$nome?>">
                    </div>
                    <h3>Descrição</h3>
                    <div class="input-box" id="input-box-descricao">
                        <textarea name="descricao" id="descricao"><?=$descricao?></textarea>
                    </div>
                    <h3>Custo</h3>
                    <div class="input-box" id="input-box-custo">
                        <input type="text" name="custo" id="custo" value="<?=$custo?>">
                    </div>
                    <h3>Preço</h3>
                    <div class="input-box" id="input-box-preco">
                        <input type="text" name="preco" id="preco" value="<?=$preco?>">
                    </div>
                    <h3>Status: <?= $status == '' ?></h3>
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
