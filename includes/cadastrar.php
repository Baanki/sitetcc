<?php
session_start();
include("conexao.php");

$emailcli = mysqli_real_escape_string($conexao, $_POST['email_cadastro']);
$nomecli = mysqli_real_escape_string($conexao, $_POST['nome_cadastro']);
$enderecocli = mysqli_real_escape_string($conexao, $_POST['ende_cadastro']);
$estadocli = mysqli_real_escape_string($conexao, $_POST['estado_cadastro']);
$cidadecli = mysqli_real_escape_string($conexao, $_POST['cidade_cadastro']);
$cepcli = mysqli_real_escape_string($conexao, $_POST['cep_cadastro']);
$cpfcli = mysqli_real_escape_string($conexao, $_POST['cpf_cadastro']);
$senhacli = mysqli_real_escape_string($conexao, $_POST['senha_cadastro']);

$sql = "select count(*) as total from tb_cliente where cli_email = '$emailcli'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);


//SE O USUÁRIO JÁ EXISTIR
if($row['total'] == 1){
    $_SESSION['usuario_existe'] = true;
    header('location:\tcc/index.php');
    exit;
}

$sql = "insert into tb_cliente(cli_email, cli_nome, cli_endereco, cli_cidade, cli_cep, cli_cpf, cli_senha, cod_empresa) values ('$emailcli', '$nomecli', '$enderecocli', '$cidadecli', '$cepcli', '$cpfcli', '$senhacli', '1')";

//CADASTRO CONCLUÍDO
if($conexao -> query($sql) === true){
    $_SESSION['cadastro_concluido'] = true;
}

$conexao->close();

header('location:\tcc/index.php');
exit;
?>