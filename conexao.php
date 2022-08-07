<?php
define('host', 'localhost');
define('usuario', 'tccnote');
define('senha', '12345');
define('db','tccdrip');


$conexao = mysqli_connect(host, usuario, senha, db) or die ("Não foi possível conectar");

//$query = sprintf("SELECT * FROM `tb_cliente` ORDER BY `tb_cliente`.`cli_nome` ASC");
//$usuario = mysqli_query($query, $conexao) or die(mysqli_error());

$connection = 'mysql:dbname=tccdrip;host=localhost';
$user = 'tccnote';
$password = '12345';

$pdo = new PDO($connection, $user, $password);

?>