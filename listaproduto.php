<?php
    // Incluindo o cabeçalho e abrindo a conexão com o banco de dados
    include("cabecalho.php");

    // Passando uma instrução ao banco de dados
    $sql = "SELECT * FROM produtos WHERE pro_status = 's'";
    $retorno = mysqli_query($link, $sql);
    $ativo = "s";

    // Forçando sempre trazer 'S' na variável para utilizarmos nos radio buttons
    $ativo = "s";

    // Coletando o botão método POST vindo do HTML
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $ativo = $_POST['ativo'];

        // Verificando se o produto está ativo para listagem
        if ($ativo == 's') {
            $sql = "SELECT * FROM produtos WHERE pro_status = 's'";
            $retorno = mysqli_query($link, $sql);
        } elseif ($ativo == 'n') {
            $sql = "SELECT * FROM produtos WHERE pro_status = 'n'";
            $retorno = mysqli_query($link, $sql);
        } else {
            $sql = "SELECT * FROM produtos";
            $retorno = mysqli_query($link, $sql);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="listaproduto.css">
    <link rel="stylesheet" href="cabecalho.css">
    <title>LISTA PRODUTOS</title>
</head>
<body>
    <main class="listaproduto-container">
        <div class="table"> 
            <section class="table-header">
                <h1>Lista de Produtos</h1>
                <div class="form-container">
                    <form action="listaproduto.php" method="post">
                        <input type="radio" name="ativo" class="radio" value="s" id="radioativo"
                        required onclick="submit()" <?= $ativo == 's' ? "checked" : "" ?>>
                        <label class="radio-label" for="radioativo">Ativo</label>
                        <input type="radio" name="ativo" class="radio" value="n" id="radioinativo"
                        required onclick="submit()" <?= $ativo == 'n' ? "checked" : "" ?>>
                        <label class="radio-label" for="radioinativo">Inativo</label>
                        <input type="radio" name="ativo" class="radio" value="todos" id="radiotodos"
                        required onclick="submit()" <?= $ativo == 'todos' ? "checked" : "" ?>>
                        <label class="radio-label" for="radiotodos">Todos</label>
                    </form>
                </div>
            </section>
            <section class="table-body">
                <table>
                    <thead>
                        <tr>
                            <th class="id-column">ID</th>
                            <th class="nome-column">Nome do Produto</th>
                            <th class="quantidade-column">Descrição</th>
                            <th class="custo-column">Custo</th>
                            <th class="preco-column">Preço</th>
                            <th class="alter-column">Alterar Dados</th>
                        </tr>
                    </thead>
                    <?php
                        while ($tbl = mysqli_fetch_array($retorno)) {
                    ?>
                    <tbody>
                        <tr>
                            <td><?=$tbl[0]?></td>
                            <td><?=$tbl[1]?></td> 
                            <td><?=$tbl[2]?></td>
                            <td><?=number_format($tbl[3], 2,',','.')?></td>
                            <td><?=number_format($tbl[4], 2,',','.')?></td>
                            <td><a href="alteraproduto.php?id=<?=$tbl[0] ?>"><button class="btn-alterar"><p class="text">Alterar</p></button></a></td>
                        </tr>
                    </tbody>
                    <?php
                        }
                    ?>
                </table>
            </section>
        </div>
    </main>
</body>
</html>
