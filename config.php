<?php
define('ROOT_DIR', __DIR__); // Define a constante ROOT_DIR com o caminho absoluto para o diretório raiz do seu projeto

//conexao com o banco de dados e a url armazenada na variavel $base

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$db_name = 'shitforum';
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';

$pdo = new PDO("mysql:dbname=".$db_name.";host=".$db_host, $db_user, $db_pass);


?>