<?php
define('host', 'localhost');
define('usuario', 'root');
define('senha', '12345');
define('db','tccdrip');


$conexao = mysqli_connect(host, usuario, senha, db) or die ("Não foi possível conectar");

$connection = 'mysql:dbname=tccdrip;host=localhost';
$user = 'root';
$password = '12345';

$pdo = new PDO($connection, $user, $password);

?>