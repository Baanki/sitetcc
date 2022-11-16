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
    $pedidos = mysqli_query($conexao, 'select * from tb_movimento');
    ?>
    <div class="container_admin_pedidos">
        <table class="tabela_admin_pedidos">
            <tr >
                <th class="coluna">Nome do Cliente:</th>
                <th class="coluna">Produtos e seus tamanhos</th>
                <th class="coluna">Pendencia do pagamento</th>
            </tr>
        <?php
            foreach($pedidos as $p => $value){
                $query = mysqli_query($conexao, "select cli_nome from tb_cliente where cod_cliente = {$value['cod_cliente']}");
                $cli_nome = mysqli_fetch_assoc($query);
                    echo '<tr><td class="coluna">'.$cli_nome['cli_nome'].'</td>';    
                $query2 = mysqli_query($conexao, "select cod_produto, compra_tamanho from tb_produto_movimento where cod_movimento = {$value['cod_movimento']}");
                    echo '<td class="coluna">';
                foreach ($query2 as $produtos => $prod){
                    $query3 = mysqli_query($conexao, "select prod_nome, compra_tamanho from tb_produto as prod inner join tb_produto_movimento as prod_mov on prod.cod_produto = {$prod['cod_produto']} and prod_mov.cod_produto = {$prod['cod_produto']}");
                    $prod_nome = mysqli_fetch_assoc($query3);
                    echo $prod_nome['prod_nome'];
                    echo ' - Tamanho:';
                    echo $prod_nome['compra_tamanho'];
                    echo '<br>';
                };
                    echo '</td>';
                echo '<td class="coluna">'.$value['compra_status'].'</td>';
                
                ?>
                
                
                
                <?php
            }
        ?>


    </div>
</body>
<?php
include_once('../includesfront/footer.php');
?>