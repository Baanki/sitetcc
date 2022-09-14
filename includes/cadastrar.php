<?php
session_start();
include("conexao.php");

//TABELA tb_cliente
$emailcli = mysqli_real_escape_string($conexao, $_POST['email_cadastro']);
$nomecli = mysqli_real_escape_string($conexao, $_POST['nome_cadastro']);
$telefonecli = mysqli_real_escape_string($conexao, $_POST['telefone_cadastro']);
$cpfcli = mysqli_real_escape_string($conexao, $_POST['cpf_cadastro']);
$senhacli = mysqli_real_escape_string($conexao, $_POST['senha_cadastro']);
$datacli = mysqli_real_escape_string($conexao, $_POST['data_cadastro']);
//TABELA tb_endereco
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

$sql = "insert into tb_cliente(cli_email, cli_nome, cli_telefone, cli_cpf, cli_senha, cli_data_nasc ,cod_empresa) values 
                                ('$emailcli', '$nomecli', '$telefonecli','$cpfcli','$senhacli','$datacli',1)";

$sql2 = "insert into tb_endereco(end_cep, end_logradouro, end_numero, end_complemento, end_bairro, end_cidade, end_estado) values
                                ('$cepcli', '$logradourocli', '$numerocli', '$complementocli', '$bairrocli', '$cidadecli','$estadocli')";
//CADASTRO CONCLUÍDO
if($conexao -> query($sql2) === true){
    function_alert("Cadastro um realizado");
    if($conexao -> query($sql2) === true){
        function_alert("Cadastro dois realizado");
    };
    //$getcod_cli = "select cod_cliente from tb_cliente where cli_email = '$emailcli'";
    //$getcod_cli_query = mysqli_query($conexao, $getcod_cli);
    //$teste = mysqli_fetch_assoc($getcod_cli_query);
           
    
    }
    $_SESSION['cadastro_concluido'] = true;

$conexao->close();

//header('location:\tcc/index.php');
exit;


function function_alert($msg){
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
?>