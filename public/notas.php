<?php
include '../includes/config.php';

if (isset($_GET['id_cliente'])) {
    $id_cliente = $_GET['id_cliente'];

    $cliente_sql = "SELECT c.id, c.nome, c.email FROM clientes c WHERE c.id = ?";
    $cliente_stmt = $conn->prepare($cliente_sql);
    $cliente_stmt->bind_param("i", $id_cliente);
    $cliente_stmt->execute();
    $cliente_result = $cliente_stmt->get_result();

    if ($cliente_result->num_rows == 1) {
        $cliente = $cliente_result->fetch_assoc();

        $notas_sql = "SELECT n.id, n.valor_nota, n.data_emissao FROM vendas n WHERE n.id_cliente = ?";
        $notas_stmt = $conn->prepare($notas_sql);
        $notas_stmt->bind_param("i", $id_cliente);
        $notas_stmt->execute();
        $notas_result = $notas_stmt->get_result();

        $valor_total = 0;
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <title>Listar Notas do Cliente</title>
        </head>
        <body>
            <?php include('../includes/navbar.php'); ?>

            <div class="container"> 
                <h2>Informações do Cliente</h2>
                <p>ID do Cliente: <?php echo $cliente['id']; ?></p>
                <p>Nome: <?php echo $cliente['nome']; ?></p>
                <p>Email: <?php echo $cliente['email']; ?></p>
                <h2>Notas do Cliente</h2>

                <?php
                if ($notas_result->num_rows > 0) {
                ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID da Venda</th>
                            <th>Valor da Nota</th>
                            <th>Data de Emissão</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($nota = $notas_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $nota['id'] . "</td>";
                            echo "<td>" . $nota['valor_nota'] . "</td>";
                            echo "<td>" . $nota['data_emissao'] . "</td>";
                            echo "</tr>";
                            $valor_total += $nota['valor_nota'];
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                } else {
                    echo "<p>Nenhuma nota encontrada para este cliente.</p>";
                }
                ?>
                <h2>Valor Total das Notas</h2>
                <p><?php echo number_format($valor_total, 2, ',', '.'); ?></p>
            </div>

            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        </body>
        </html>
        <?php
    } else {
        echo "Cliente não encontrado.";
    }
} else {
    echo "ID do cliente não especificado.";
    echo "<br>";
    echo "Entre na página de Listar Clientes e acesse pelo botão Listar Notas";
    echo "<br>";
    echo "Obrigado";
    
}
?>
