<?php
    # Inclui o arquivo de cabeçalho para conexão com o banco de dados
    include("cabecalho.php");

    # Define a instrução SQL para selecionar clientes ativos por padrão
    $sql = "SELECT * FROM clientes WHERE cli_status = 's'";
    $retorno = mysqli_query($link, $sql);
    $contador = 0; # Inicializa um contador para acompanhar as linhas

    # Define o valor padrão para o radio button
    $ativo = "s";

    # Verifica se foi enviado um POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $ativo = $_POST['ativo'];

        # Verifica o status do cliente e ajusta a consulta SQL
        if ($ativo == 's') {
            $sql = "SELECT * FROM clientes WHERE cli_status = 's'";
            $retorno = mysqli_query($link, $sql);
        } elseif ($ativo == 'n') {
            $sql = "SELECT * FROM clientes WHERE cli_status = 'n'";
            $retorno = mysqli_query($link, $sql);
        } else {
            $sql = "SELECT * FROM clientes";
            $retorno = mysqli_query($link, $sql);
        }
    }
?>


<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="listacliente.css">
    <link rel="stylesheet" href="cabecalho.css">
    <title>LISTA CLIENTES</title>
</head>
<body>
<main class="listausuario-container">
    <div class="table">
        <section class="table-header">
            <h1>Lista de Clientes</h1>
            <div class="form-container">
                <form action="listacliente.php" method="post">
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
                    <th class="nome-column">Nome</th>
                    <th class="email-column">E-mail</th>
                    <th class="telefone-column">Telefone</th>
                    <th class="status-column">Status</th>
                    <th class="alter-column">Alterar dados</th>
                </tr>
                </thead>

                <?php
                while ($tbl = mysqli_fetch_array($retorno)) {
                    $contador++;
                    $classe = ($contador % 2 == 0) ? 'even' : 'odd';
                    ?>
                    <tbody>
                    <tr class="<?= $classe ?>">
                        <td><?= isset($tbl['id']) ? $tbl['id'] : '' ?></td>
                        <td><?= isset($tbl['nome']) ? $tbl['nome'] : '' ?></td>
                        <td><?= isset($tbl['email']) ? $tbl['email'] : '' ?></td>
                        <td><?= isset($tbl['telefone']) ? $tbl['telefone'] : '' ?></td>
                        <td>
                            <p class="status <?= isset($tbl['cli_status']) && $tbl['cli_status'] == 's' ? 'ativo' : 'inativo' ?>">
                                <?= isset($tbl['cli_status']) && $tbl['cli_status'] == 's' ? 'Ativo' : 'Inativo' ?>
                            </p>
                        </td>
                        <td><a href="alteracliente.php?id=<?= isset($tbl['id']) ? $tbl['id'] : '' ?>"><button class="btn-alterar"><p class="text">Alterar</p></button></a></td>
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
