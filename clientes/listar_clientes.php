<?php
include '../includes/config.php';

$sql = "SELECT id, nome, email FROM clientes";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets//css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Listar Clientes</title>
</head>

<body>
    <?php include('../includes/navbar.php'); ?>

    <div class="container">
        <h1>Listar Clientes</h1>
        <a href="./adicionar_cliente.php" class="btn btn-primary botao-criar-cliente">
            Criar Cliente <i class="bi bi-list"></i>
        </a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["nome"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";

                        echo "<td>";
                        echo '<a href="editar_cliente.php?id=' . $row["id"] . '" class="btn btn-warning">Editar</a>';
                        echo '<a href="excluir_cliente.php?id=' . $row["id"] . '" class="btn btn-danger botao-listar">Excluir</a>';
                        echo '<a href="../vendas/listar_vendas.php?id_cliente=' . $row['id'] . '" class="btn btn-primary botao-listar">Listar Notas</a>';
                        echo "</td>";
                        
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Nenhum cliente encontrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>