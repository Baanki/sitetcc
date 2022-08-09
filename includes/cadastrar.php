<?php
session_start();
include("conexao.php");

$emailcli = mysqli_real_escape_string($conexao, $_POST['email_cadastro']);
$nomecli = mysqli_real_escape_string($conexao, $_POST['nome_cadastro']);
$telefonecli = mysqli_real_escape_string($conexao, $_POST['telefone_cadastro']);
$cpfcli = mysqli_real_escape_string($conexao, $_POST['cpf_cadastro']);
$senhacli = mysqli_real_escape_string($conexao, $_POST['senha_cadastro']);
//BANCO DATAS AQUI
$cepcli = mysqli_real_escape_string($conexao, $_POST['cep_cadastro']);
$logradourocli = mysqli_real_escape_string($conexao, $_POST['logradouro_cadastro']);
$numerocli = mysqli_real_escape_string($conexao, $_POST['numero_casa_cadastro']);
$complementocli = mysqli_real_escape_string($conexao, $_POST['complemento_cadastro']);
$bairrocli = mysqli_real_escape_string($conexao, $_POST['bairro_cadastro']);
$cidadecli = mysqli_real_escape_string($conexao, $_POST['cidade_cadastro']);
$estadocli = mysqli_real_escape_string($conexao, $_POST['estado_cadastro']);



$sql = "select count(*) as total from tb_cliente where cli_email = '$emailcli'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);


//SE O USUÁRIO JÁ EXISTIR
if($row['total'] == 1){
    $_SESSION['usuario_existe'] = true;
    header('location:\tcc/index.php');
    exit;
}

$sql = "insert into tb_cliente(cli_email, cli_nome, cli_telefone, cli_cpf, cli_senha, cli_cep, cli_logradouro, cli_num_casa, cli_complemento, cli_bairro, cli_cidade, cli_estado, cod_empresa) values 
                                ('$emailcli', '$nomecli', '$telefonecli','$cpfcli','$senhacli','$cepcli','$logradourocli','$numerocli','$complementocli','$bairrocli','$cidadecli','$estaddocli','1')";

//CADASTRO CONCLUÍDO
if($conexao -> query($sql) === true){
    $_SESSION['cadastro_concluido'] = true;
}

$conexao->close();

header('location:\tcc/index.php');
exit;
?>