<?php
include("conectadb.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $produto = $_POST['produto'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];
    
    # Gerar chave aleatória
    $key = rand(100000, 999999);

    # Inserir instruções no banco
    $sql = "INSERT INTO encomendas (produto, quantidade, preco, chave) 
            VALUES ('$produto', '$quantidade', '$preco', '$key')";

    # Gravar log
    $sql = '"' . $sql . '"';
    $sqllog = "INSERT INTO tab_log (tab_query, tab_data)
               VALUES ($sql, NOW())";
    mysqli_query($link, $sqllog);

    echo "<script>window.alert('ENCOMENDA REGISTRADA COM SUCESSO');</script>";
    echo "<script>window.location.href='pagina_encomendas.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="encomendas.css"> 
    <title>Registro de Encomenda</title>
</head>
<body>

<div class="container">
    <h2>Registro de Encomenda</h2>
    
    <form action="" method="post">
        <label for="produto">Produto:</label>
        <input type="text" name="produto" required>

        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" required>

        <label for="preco">Preço:</label>
        <input type="text" name="preco" required>

        <button type="submit">Registrar Encomenda</button>
    </form>
</div>

</body>
</html>
