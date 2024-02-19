<?php
include("conectadb.php");

# Selecionar todas as encomendas do banco de dados
$sql = "SELECT * FROM encomendas";
$result = mysqli_query($link, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="encomendas1.css"> 
    <link rel="stylesheet" href="cabecalho.css">
    <title>Listagem de Encomendas</title>
</head>
<body>

<div class="container">
    <h2>Listagem de Encomendas</h2>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço</th>
                <th>Chave</th>
            </tr>
        </thead>
        <tbody>
            <?php
            # Loop através de cada linha de resultado
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['produto']}</td>";
                echo "<td>{$row['quantidade']}</td>";
                echo "<td>{$row['preco']}</td>";
                echo "<td>{$row['chave']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
