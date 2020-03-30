<?php
try {
    $opcoes = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    $dsn = "mysql:dbname=sistema_escolar;host=localhost";
    $dbuser = "root";
    $dbpass = "root";

    $pdo = new PDO($dsn, $dbuser, $dbpass, $opcoes);
} catch (PDOException $e) {
    echo "Erro: ".$e->getMessage();
    exit;
}
