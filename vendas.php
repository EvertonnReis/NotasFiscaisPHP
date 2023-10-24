<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cliente = $_POST['id_cliente'];
    $valor_nota = $_POST['valor_nota'];
    $numero_nota = $_POST['numero_nota'];
    $data_emissao = $_POST['data_emissao'];

    $sql = "INSERT INTO vendas (id_cliente, valor_nota, numero_nota, data_emissao) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("idss", $id_cliente, $valor_nota, $numero_nota, $data_emissao);
    $stmt->execute();

    $email_cliente = "SELECT email FROM clientes WHERE id = ?";
    $email_cliente_stmt = $conn->prepare($email_cliente);
    $email_cliente_stmt->bind_param("i", $id_cliente);
    $email_cliente_stmt->execute();
    $email_cliente_result = $email_cliente_stmt->get_result();

    if ($email_cliente_result->num_rows == 1) {
        $cliente_email = $email_cliente_result->fetch_assoc()['email'];

        $to = $cliente_email;
        $subject = "Nova venda registrada";
        $message = "Uma nova venda foi registrada para você, responsável pelo ID: $id_cliente";

        if (mail($to, $subject, $message)) {
            echo "E-mail enviado com sucesso.";
        } else {
            echo "Falha ao enviar o e-mail.";
        }

        header("Location: listar_vendas.php");
        exit();
    } else {
        echo "Cliente não encontrado.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Inserir Nova Venda</title>
</head>

<body>
    <?php include('navbar.php'); ?>

    <div class="container">
        <h1>Inserir Nova Venda</h1>
        <form method="POST">
            <div class="form-group">
                <label for="id_cliente">ID do Cliente:</label>
                <input type="number" class="form-control" name="id_cliente" required>
            </div>
            <div class="form-group">
                <label for="valor_nota">Valor da Nota:</label>
                <input type="text" class="form-control" name="valor_nota" required>
            </div>
            <div class="form-group">
                <label for="numero_nota">Número da Nota:</label>
                <input type="text" class="form-control" name="numero_nota" required>
            </div>
            <div class="form-group">
                <label for="data_emissao">Data de Emissão:</label>
                <input type="date" class="form-control" name="data_emissao" required>
            </div>
            <button type="submit" class="btn btn-primary">Inserir Venda</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>