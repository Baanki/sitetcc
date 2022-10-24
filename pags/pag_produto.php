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
                    <form>
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
                        <input type="submit" value="COMPRAR" class="botao_comprar">
                    </form>
                    <div class="detalhes_produtos">
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<?php
include_once('../includesfront/footer.php')
?>
<html>
