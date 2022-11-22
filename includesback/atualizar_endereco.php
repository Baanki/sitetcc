<!DOCTYPE html>
<html lang="pt-br">
<?php
session_start();
include("conexao.php");


$cepcli = mysqli_real_escape_string($conexao, $_POST['cep_atualizar']);
$logradourocli = mysqli_real_escape_string($conexao, $_POST['logradouro_atualizar']);
$numerocli = mysqli_real_escape_string($conexao, $_POST['numero_atualizar']);
$complementocli = mysqli_real_escape_string($conexao, $_POST['complemento_atualizar']);
$bairrocli = mysqli_real_escape_string($conexao, $_POST['bairro_atualizar']);
$cidadecli = mysqli_real_escape_string($conexao, $_POST['cidade_atualizar']);
$estadocli = mysqli_real_escape_string($conexao, $_POST['estado_atualizar']);

mysqli_query($conexao, "update tb_endereco set end_cep = '$cepcli', end_estado = '$estadocli', end_cidade = '$cidadecli', end_bairro = '$bairrocli', end_logradouro = '$logradourocli', end_numero = '$numerocli', end_complemento = '$complementocli' where cod_cliente = {$_SESSION['id_cliente']}");

header('location: ../pags/minhaconta.php');



?>
</html>