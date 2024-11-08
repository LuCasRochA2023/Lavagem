<?php
$host = 'localhost';
$db = 'postgres';
$user = 'postgres';
$pass = '123';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    var_dump( "Conexão bem-sucedida!");
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

