<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" type="text/css" href="../styles/pix.css">
</head>
<body>
<?php
 include_once('../includesfront/header.php');
 require_once '../vendor/autoload.php';
 MercadoPago\SDK::setAccessToken("APP_USR-4824210125034889-112015-2c8ba47b6654e5bef3ec032ac5931f36-442749057");
 if(empty($_SESSION['login_cliente'])){
    echo "<script>document.location='index.php'</script>";
};
?>
 <h1 class="title_carrinho">Meus pedidos</h1>

<style>
    td{
        border:solid 1px black;
    }
    img{
        height: 150px;
    }
    .pedidos_tabela{
        float: left;
    }
</style>
<?php
$query_movimento = mysqli_query($conexao, "select * from tb_movimento as mov inner join tb_cliente as cli on mov.cod_cliente = {$_SESSION['id_cliente']} and         
                                                                                                            cli.cod_cliente = {$_SESSION['id_cliente']} order by mov_data desc");
$movimentos = mysqli_fetch_assoc($query_movimento);
foreach($query_movimento as $m => $mov){
    ?>
    <table>
    <tr class="carrinho_linha">
        <th class="carrinho_coluna">Data e hora da compra</th>
        <th class="carrinho_coluna">Produtos</th>
        <th class="carrinho_coluna">Total</th>
        <th class="carrinho_coluna">Pagamento</th>
    </tr>
    <?php
    echo("<tr><td>{$mov['mov_data']}</td>");
        $query_produto_movimento = mysqli_query($conexao, "select * from tb_produto_movimento where cod_movimento = {$mov['cod_movimento']}");
            $produto_movimento = mysqli_fetch_assoc($query_produto_movimento);
            echo("<td style='width:auto'>");
            foreach($query_produto_movimento as $qpm => $prod_mov){
                $query_produtos = mysqli_query($conexao, "select * from tb_produto where cod_produto = {$prod_mov['cod_produto']}");
                $produtos = mysqli_fetch_assoc($query_produtos);
                foreach($query_produtos as $p => $prod){
                    echo("<div class='pedidos_tabela'>");
                        echo("<img src='{$prod['prod_imagem']}'><br>");
                        echo("Quantidade:{$prod_mov['compra_qtd']}<br>");
                        echo("Valor:{$prod['prod_preco']}<br>");
                        echo("<Tamanho:{$prod_mov['compra_tamanho']}<br>");   
                    echo("</div>");
                }
                
                
            }
            echo("</td>");
            echo ("<td>{$mov['mov_valor_total']}</td>");
            echo("<br>");
            echo("</td>");
            $id_compra = $mov['id_compra'];
            $payment = MercadoPago\Payment::find_by_id($id_compra);
            if($payment->status === 'pending'){
                ?><td>Compra Pendente<br>
                <form action="teste-brick.php?id=<?php echo $id_compra?>" method="POST">
                    <button>Efetuar o pagamento</button><br>
                </form>
                <?php
            }else{
            echo("<td>");
            echo("Pagamento Efetuado");      
            echo("</td>");
            
        }

    echo ("</table>");       
};
    echo ("<br>");






 $query_info = mysqli_query($conexao, "select * from tb_movimento as mov inner join tb_cliente as cli inner join tb_endereco as end on mov.cod_cliente={$_SESSION['id_cliente']} and
                                                                                                                                    cli.cod_cliente={$_SESSION['id_cliente']} and
                                                                                                                                    end.cod_cliente={$_SESSION['id_cliente']}");
 $info = mysqli_fetch_assoc($query_info);


?>

</body>
</html>