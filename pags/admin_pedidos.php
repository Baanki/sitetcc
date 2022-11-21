<?php
include_once('../includesfront/header.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" type="text/css" href="../styles/admin_pedidos.css">
</head>
<body>
    <?php
    require_once '../vendor/autoload.php';
    MercadoPago\SDK::setAccessToken("APP_USR-4824210125034889-112015-2c8ba47b6654e5bef3ec032ac5931f36-442749057");
    $movimentos = mysqli_query($conexao, 'select * from tb_movimento order by mov_data desc');
    ?>
    <style>
        table{
            border: solid 1px black;
            margin-bottom: 2em;
        }
        .imagem_pedidos{
                    width: 100px;
                }
    </style>
    <div class="container_admin_pedidos">
        
        <?php
            foreach($movimentos as $movimento => $mov){
                $query_cliente = mysqli_query($conexao, "select * from tb_cliente where cod_cliente = {$mov['cod_cliente']}");
                $cliente = mysqli_fetch_assoc($query_cliente);
                ?>
                <table class="tabela_admin_pedidos">
                    <tr>
                        <th class="coluna">Nome do Cliente:</th>
                        <th class="coluna">Produtos e seus tamanhos</th>
                        <th class="coluna">Pendencia do pagamento</th>
                    </tr>
                <?php
                    echo("<tr>");
                foreach($query_cliente as $cliente => $cli){
                    echo("<td>");
                    echo $cli['cli_nome'];
                    echo("</td>");
                    echo("<td>");
                    $query_prod_mov = mysqli_query($conexao, "select * from tb_produto_movimento where cod_movimento = {$mov['cod_movimento']}");
                    $prod_mov = mysqli_fetch_assoc($query_prod_mov);
                    foreach($query_prod_mov as $pv => $prod_mov){
                        $query_produtos = mysqli_query($conexao, "select * from tb_produto where cod_produto = {$prod_mov['cod_produto']}");
                        foreach($query_produtos as $prod => $p){
                            echo ($p['prod_nome']);
                            echo ("<br>");
                        }
                        
                    }
                    echo("<td>");
                        $id_compra = ($mov['id_compra']);
                        $payment = MercadoPago\Payment::find_by_id($id_compra);
                        echo ($payment->status);
                        echo("</td>");
                    echo("</td>");
                }
                    echo("</tr>");
                    echo("</table>");
            }
        ?>


    </div>
<?php
//include_once('../includesfront/footer.php');
?>
</body>
