<!DOCTYPE html>
<html lang="pt-br">
<?php
session_start();
include("conexao.php");

//TABELA tb_cliente
$emailcli = mysqli_real_escape_string($conexao, $_POST['email_atualizar']);
$nomecli = mysqli_real_escape_string($conexao, $_POST['nome_atualizar']);
$telefonecli = mysqli_real_escape_string($conexao, $_POST['telefone_atualizar']);
$cpfcli = mysqli_real_escape_string($conexao, $_POST['cpf_atualizar']);
$senhacli = mysqli_real_escape_string($conexao, md5($_POST['senha_atualizar']));
$datacli = mysqli_real_escape_string($conexao, $_POST['data_atualizar']);
//TABELA tb_endereco
echo ($_SESSION['id_cliente']);
mysqli_query($conexao, "update tb_cliente set cli_nome = '$nomecli', cli_email = '$emailcli', cli_cpf = '$cpfcli', cli_telefone = '$telefonecli', cli_data_nasc = '$datacli', cli_senha = '$senhacli' where cod_cliente = {$_SESSION['id_cliente']}");

header('location: ../pags/minhaconta.php');
?>
</html>