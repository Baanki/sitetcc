<?php
include_once('../includesfront/header.php');

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" type="text/css" href="../styles/pag_produtos.css">
</head>
<body>
    <?php
    $id = $_GET['id'];
    $query = mysqli_query($conexao, "select * from tb_produto where cod_produto = $id");
    $sql = mysqli_fetch_assoc($query);
    $nome_produto = $sql['prod_nome'];
    $preco_produto = $sql['prod_preco'];
    $img_produto = $sql['prod_imagem'];
    $cod_produto = $sql['cod_produto'];
    
    ?>
    <section class="pag_produto">
        <div class="div_pag_produto">
            <div class="content_produto">
                <picture>
                    <img class="imagem_produto" src="<?php echo($img_produto)?>">
                </picture>
                <div class="info_produto">
                    <h1 class="nome_produto"><?php echo($nome_produto)?></h1>
                    <h2 class="preco_produto">R$<?php echo($preco_produto)?></h2>
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
                        <input type="number" value="" class="qtd_comprar">
                        <a href="carrinho.php?adicionar=<?php echo($cod_produto);?>" class="botao_comprar">COMPRAR</a>
                    <div class="desc_produtos">
                        <h1 class="desc_titulo">Descrição</h1>
                        <p class="desc_texto">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<?php
include_once('../includesfront/footer.php');
?>
<html>
