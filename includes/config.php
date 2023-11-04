<?php
    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASSWORD', '');
    define('BASE', 'crudcontabilivre');

    $conn = new mysqli(HOST, USER, PASSWORD, BASE);

    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    } else {
    }