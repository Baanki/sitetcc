<?php
define('host', '192.168.0.104');
define('usuario', 'tccnote');
define('senha', '12345');
define('db','tccdrip');


$conexao = mysqli_connect(host, usuario, senha, db) or die ("Não foi possível conectar");

$connection = 'mysql:dbname=tccdrip;host=192.168.0.104';
$user = 'tccnote';
$password = '12345';

$pdo = new PDO($connection, $user, $password);

?>