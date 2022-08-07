<?php
session_start();
include('conexao.php');

if (empty($_POST['email_login'])  || empty($_POST['senha_login'])){
    $_SESSION['login_incompleto'] = true;
    header('location: index.php');
    exit();
}

$usuario = mysqli_real_escape_string($conexao, $_POST['email_login']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha_login']);

$query = "select cod_cliente, cli_email from tb_cliente where cli_email = '{$usuario}' and cli_senha = '{$senha}'";

$resultado = mysqli_query($conexao, $query);

$row = mysqli_num_rows($resultado);

if($row == 1){
    $_SESSION['login_completo'] = true;
    header('location: index.php');
    exit();
} else{
    $_SESSION['login_incompleto'] = true;
    header('location: index.php');
    exit();
}

?> 