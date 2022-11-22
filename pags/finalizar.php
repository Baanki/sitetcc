<?php
include_once('../includesfront/header.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" type="text/css" href="../styles/finalizar.css">
    <script src="https://sdk.mercadopago.com/js/v2"></script>
</head>
<body>
    <script>const mp = new MercadoPago('APP_USR-72478b91-c695-44c7-88ce-65840ae5bf40');</script>
    <?php
    $query_dados_cliente = mysqli_query($conexao, "select * from tb_cliente where cod_cliente = {$_SESSION['id_cliente']}");
    $dados_cliente = mysqli_fetch_assoc($query_dados_cliente);
    $query_endereco_cliente = mysqli_query($conexao, "select * from tb_endereco where cod_cliente = {$_SESSION['id_cliente']}");
    $endereco_cliente = mysqli_fetch_assoc($query_endereco_cliente);
  
    ?>
    <div class="container_geral">
      <div class="container_informacoes_cliente">
        <div class="informacoes_compra">
          <p class="titulo_informacoes">Dados do cliente</p>
          <p class="dados_cliente">Nome: <?php echo $dados_cliente['cli_nome']?></p>
          <p class="dados_cliente">Email: <?php echo $dados_cliente['cli_email']?></p>
          <p class="dados_cliente">CPF: <?php echo $dados_cliente['cli_cpf']?></p>
          <p class="dados_cliente">Telefone: <?php echo $dados_cliente['cli_telefone']?></p>
          <p class="dados_cliente">&nbsp;</p>
          <a href="minhaconta.php" class="botao_alterar">Editar</a>
        </div>
        <div class="informacoes_compra">
          <p class="titulo_informacoes">Endereco do cliente</p>
          <p class="dados_cliente"><?php echo $endereco_cliente['end_logradouro']?></p>
          <p class="dados_cliente"><?php echo $endereco_cliente['end_numero']?></p>
          <p class="dados_cliente"><?php echo $endereco_cliente['end_complemento']?></p>
          <p class="dados_cliente"><?php echo $endereco_cliente['end_bairro']?></p>
          <p class="dados_cliente"><?php echo $endereco_cliente['end_cidade']?>/<?php echo $endereco_cliente['end_estado']?> - <?php echo $endereco_cliente['end_cep']?></p>
          <a href="minhaconta.php" class="botao_alterar">Editar</a>
        </div>
        <div class="informacoes_compra">
          <p class="titulo_informacoes">Método de pagamento</p>   
            <p class="dados_cliente">Pix</p>
        </div>
      </div>
      <div class="informacoes_compra_produto">
        <div class="container_carrinho">
          <p class="titulo_informacoes">Produtos</p>
          <table class="carrinho_tabela">
          <tr class="carrinho_linha">
                <th class="carrinho_coluna">Produto</th>
                <th class="carrinho_coluna">Nome</th>
                <th class="carrinho_coluna"  style="padding: 0px">Quantidade</th>
                <th class="carrinho_coluna">Preço</th>
                <th class="carrinho_coluna">Subtotal</th>
            </tr>
            <?php
            $total_compra = 0;
            foreach ($_SESSION['carrinho'] as $key => $value){
              echo '<tr><td class="carrinho_coluna"><img id="imagem_carrinho" src="'.$value['imagem'].'"?></td>
                        <td class="carrinho_coluna" style="width: 16em">'.$value['nome'].'<br> Tamanho: '.$value['tamanho'].'</td>
                          
                        <td class="carrinho_coluna" style="padding-left: 3em; padding-right: 3em">'.$value['quantidade'].'</td>
                        <td class="carrinho_coluna" style="padding-left: 2em; padding-right: 2em">'.$value['preco'].'</td>
                        <td class="carrinho_coluna" style="padding-left: 4em; padding-right: 4em">R$'.$value['subtotal'].'</td>
                    </tr>
                    ';   $total_compra += $value['subtotal']; 
                    
            };
            ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="carrinho_coluna" style="font-weight: bold;">Total</><br>R$<?php echo $total_compra?>
                <form id="form-checkout" method="post">
                <button class="botao_pagamento" name="pagamento" type="submit">Ir para o Pagamento</button></td>
                </form>
            </tr>
          </table>
        </div>
      </div>
    </div>
<?php
  if(isset($_POST['pagamento'])){
    $verificacao_query = mysqli_query($conexao, "select * from tb_movimento where cod_cliente ={$_SESSION['id_cliente']} and compra_status = 'pendente'");
      $verificacao = mysqli_num_rows($verificacao_query);
      if($verificacao >= 1){
        echo ("<script>alert('Você já possui um pagamento pendente, para ver seus pagamentos pendendes acesse a página Meus Pedidis')</script>")
        ?>
                        
        <?php
      }else{
        $query = "insert into tb_movimento(mov_valor_total,compra_status,cod_cliente,cod_empresa) values ('$total_compra','pendente','{$_SESSION['id_cliente']}',1)";
          mysqli_query($conexao, $query);
          $query_cod_movimento = mysqli_query($conexao, "select cod_movimento from tb_movimento where cod_cliente = {$_SESSION['id_cliente']}");
          $fetch = mysqli_fetch_assoc($query_cod_movimento);
          $_SESSION['cod_movimento'] = $fetch['cod_movimento'];
          $query_cod_movimento = mysqli_query($conexao, "select cod_movimento from tb_movimento where cod_cliente = {$_SESSION['id_cliente']} and compra_status ='pendente'");
          $cod_movimento = mysqli_fetch_assoc($query_cod_movimento);

        foreach($_SESSION['carrinho'] as $key => $value){
          $query = "insert into tb_produto_movimento(compra_qtd,compra_preco,cod_produto,cod_movimento,compra_img,compra_tamanho) values('{$value['quantidade']}','{$value['preco']}','{$value['cod_produto']}','{$cod_movimento['cod_movimento']}','{$value['imagem']}','{$value['tamanho']}')";
          mysqli_query($conexao, $query);
          echo "<script>document.location='pix.php'</script>";
        }

  }
}
include_once('../includesfront/footer.php');   

?>
</body>