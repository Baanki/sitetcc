<?php
include_once('../includesfront/header.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" type="text/css" href="../styles/indexeprodutos.css">
</head>

<body>
    <div class="filtros">
        <div class="filtros_itens">
            <input type="checkbox" name="tamanho_p" class="checkbox_filtros">
                <p class="nomes_checkbox">P</p>  
        </div>
        <div class="filtros_itens">
            <input type="checkbox" name="tamanho_p" class="checkbox_filtros">
                <p class="nomes_checkbox">M</p>  
        </div>
        <div class="filtros_itens">
            <input type="checkbox" name="tamanho_p" class="checkbox_filtros">
                <p class="nomes_checkbox">G</p>  
        </div>
        <div class="filtros_itens">
            <input type="checkbox" name="tamanho_p" class="checkbox_filtros">
                <p class="nomes_checkbox">GG</p>  
        </div>
        <div class="filtros_itens">
            <input type="checkbox" name="tamanho_p" class="checkbox_filtros">
                <p class="nomes_checkbox">GGG</p>  
        </div>
    </div>
    <div class="ordenar">
        <p class="ordenar_title">ORDENAR</p>
        


    </div>
    <section class="produtos">
        <h1 class="produtos_lancamento">LANÇAMENTOS</h1>
        <div class="produtos_grid">
        <?php
            $query = "select cod_produto,prod_nome,prod_imagem,prod_preco from tb_produto where prod_data <= (select max(prod_data) from tb_produto) and prod_tipo = 'Moletom' order by prod_data desc limit 8";
            $puxarprodutos = mysqli_query($conexao, $query);
            if ($puxarprodutos === false){
            echo("Erro ao puxar do banco de dados");
        }           
            while ($row = mysqli_fetch_assoc($puxarprodutos)){
                   $nome = $row['prod_nome'];
                    $img = $row['prod_imagem'];
                    $preco = $row['prod_preco'];
                    ?>
                    <div class="produto_itens">
                    <picture>
                        <a href="#">
                            <img src="<?php echo($img)?>" class="produto_imagem">
                        </a>
                    </picture>
                    <p class="produto_nome"><?php echo($nome)?></p>
                    <p class="produto_preco">R$ <?php echo($preco)?></p>
                </div>
                <?php 
                }
                ?>      
        </div>    
    </section>
    <?php
    include_once('../includesfront/footer.php');
    ?>
</body>