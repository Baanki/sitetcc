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
$queryadm = mysqli_query($conexao, "select cod_empresa from tb_empresa where emp_login = '{$email}' and emp_senha = '{$senha}'");


$resultado = mysqli_query($conexao, $query);
$cod_cliente = mysqli_fetch_assoc($resultado);

$row = mysqli_num_rows($resultado);
$rowadm = mysqli_num_rows($queryadm);

if($rowadm == 1){
    $_SESSION['login_adm'] = true;
    header('location: \tcc/pags/index.php');
    
}elseif($row == 1){ 
    $_SESSION['id_cliente'] = $cod_cliente['cod_cliente'];
    $_SESSION['login_cliente'] = true;
    header('location: \tcc/pags/index.php');
    exit();
    
}else{
    $_SESSION['login_incompleto'] = true;
    header('location: \tcc/pags/index.php');
    exit();

}
?>