<?php
include_once('../includesfront/header.php');

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" type="text/css" href="../styles/minhaconta.css">
    <script type="text/javascript" src="../api/cepatualizar.js"></script>
    <script>
    $(document).ready(function(){
                $('#telefone_atualizar').mask('(99) 99999-9999');
                $('#data_atualizar').mask('99/99/9999');
                $('#cpf_atualizar').mask('999.999.999-99');
                $('#cep_atualizar').mask('99999-999');
            }); 
    </script>
</head>
<body>
<section class="minhaconta">
    <div class="div_minhaconta">
        <div class="infos_dados" style="width:25%">
            <form action="../includesback/atualizar_cadastro.php" method="POST">
            <?php
            $query_cliente = mysqli_query($conexao, "select * from tb_cliente as cli inner join tb_endereco as end on cli.cod_cliente = {$_SESSION['id_cliente']} and end.cod_cliente = {$_SESSION['id_cliente']}");
            $infos_cliente = mysqli_fetch_assoc($query_cliente);
            ?>
                <label class="texto_campo">Nome:</label>
                <input type="text" class="input_minhaconta" name="nome_atualizar" value="<?php echo($infos_cliente['cli_nome']);?>">
                <label class="texto_campo">Email:</label>
                <input type="email" class="input_minhaconta" name="email_atualizar" value="<?php echo($infos_cliente['cli_email']);?>">
                <label class="texto_campo">CPF:</label>
                <input type="text" class="input_minhaconta" name="cpf_atualizar" id="cpf_atualizar" value="<?php echo($infos_cliente['cli_cpf']);?>">
                <label class="texto_campo">Telefone:</label>
                <input type="text" class="input_minhaconta" name="telefone_atualizar" id="telefone_atualizar" value="<?php echo($infos_cliente['cli_telefone']);?>">
                <label class="texto_campo">Data de nascimento:</label>
                <input type="text" class="input_minhaconta" id="data_atualizar" name="data_atualizar" value="<?php echo($infos_cliente['cli_data_nasc']);?>">
                <label class="texto_campo">Nova senha:</label>
                <input type="password" name="senha_atualizar" class="input_minhaconta" value="">
                <input type="submit" value="Atualizar informações">
            </form>
        </div>
        <div class="infos_dados" style="width:19%">
            <h1 class="texto_campo">Endereço</h1>
            <p class="texto_campo">CEP:</p><?php echo ($infos_cliente['end_cep'])?><br>
            <p class="texto_campo">Estado:</p> <?php echo ($infos_cliente['end_estado'])?><br>
            <p class="texto_campo">Cidade:</p> <?php echo ($infos_cliente['end_cidade'])?><br>
            <p class="texto_campo">Bairro:</p> <?php echo ($infos_cliente['end_bairro'])?><br>
            <p class="texto_campo">Rua:</p> <?php echo ($infos_cliente['end_logradouro'])?><br>
            <p class="texto_campo">Número:</p> <?php echo ($infos_cliente['end_numero'])?><br>
            <p class="texto_campo">Complemento</p> <?php echo ($infos_cliente['end_complemento'])?>
        </div>
        <form action="../includesback/atualizar_endereco.php" method="POST">
        <div class="infos_dados" style="width: 30%">
                <label for="cep_atualizar" class="texto_campo">CEP:</label>
                <input type="text" class="input_minhaconta"  id="cep_atualizar" name="cep_atualizar" onblur="pesquisacep(this.value); ">
                <label for="cidade_atualizar" class="texto_campo">Cidade:</label>
                <input type="text" class="input_minhaconta"  name="cidade_atualizar" id="cidade_atualizar">

                <label for="logradouro_atualizar" class="texto_campo">Rua:</label>
                <input type="text" class="input_minhaconta" name="logradouro_atualizar" id="logradouro_atualizar">
                <label class="texto_campo">Complemento:</label>
                <input type="text" class="input_minhaconta" name="data_atualizar">
                <input type="submit" value="Atualizar informações">
            
        </div>
            <div class="infos_dados" style="width: 15%; margin-left: 0px">
            <label for="estado_cadastro" class="texto_campo">Estado:</label>
            <input class="input_minhaconta" type="text" name="estado_atualizar" id="estado_atualizar" style="width: 3em">
            <label for="bairro_atualizar" class="texto_campo">Bairro:</label>
            <input type="text" class="input_minhaconta" name="bairro_atualizar" id="bairro_atualizar">
            <label for="cep_atualizar" class="texto_campo">Número:</label>
            <input type="text" class="input_minhaconta" name="numero_atualizar" style="width: 3em">
        </div>
        </form>
        <form method="POST">
        <button onclick="return confirm('Tem certeza que deseja deletar está conta? Essa ação não pode ser revertida')" name="deletar_conta" style="position: relative; background-color: red; top: 10em; left: -28em">Deletar Conta</button>
    </form>
    </div>

</section>



<br>

<?php
if(isset($_POST['deletar_conta'])){
    mysqli_query($conexao, "delete from tb_movimento where cod_cliente = {$_SESSION['id_cliente']}");
    mysqli_query($conexao, "delete from tb_cliente where cod_cliente = {$_SESSION['id_cliente']}");
    session_destroy();
    echo("<script>alert('Conta Deletada')</script>");
    echo "<script>document.location='index.php'</script>";
};

include_once('../includesfront/footer.php')
?>
</body>
</html>