<?php
session_start();
include('conexao.php');

if (empty($_POST['email_login'])  || empty($_POST['senha_login'])){
    $_SESSION['login_incompleto'] = true;
    header('location: index.php');
    exit();
}

$email = mysqli_real_escape_string($conexao, $_POST['email_login']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha_login']);

$query = "select cod_cliente, cli_email from tb_cliente where cli_email = '{$email}' and cli_senha = '{$senha}'";
$query2 = mysqli_query($conexao, "select substring(cli_nome, 2, 5) from tb_cliente where cli_email = '{$email}'");
//while ($row = mysqli_fetch_assoc($query2)){
    //$usuario_cli = $row['cli_nome'];
//}
$resultado = mysqli_query($conexao, $query);

$row = mysqli_num_rows($resultado);

if($row == 1){
    $_SESSION['login_completo'] = true;
    $_SESSION['usuario_cli'] = $usuario_cli;
    //header('location: \tcc/index.php');
    exit();
} else{
    $_SESSION['login_incompleto'] = true;
    //header('location: \tcc/index.php');
    exit();
}
?> 