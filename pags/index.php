<?php
include_once('../includesfront/header.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" type="text/css" href="../styles/index.css">
    <script src="../scripts/carousel.js" defer></script>
</head>
<?php





    $query = 'select prod_nome from tb_produto where cod_produto=1';
    $aaa = mysqli_query($conexao, $query);
    $query2 = 'select prod_preco from tb_produto where cod_produto=1';
    $aaa2 = mysqli_query($conexao, $query2);
    $query3 = 'select prod_imagem from tb_produto where cod_produto=1';
    $aaa3 = mysqli_query($conexao, $query3);
    while ($row = mysqli_fetch_assoc($aaa) and $row2 = mysqli_fetch_assoc($aaa2) and $row3 = mysqli_fetch_assoc($aaa3)){
        $nome = $row['prod_nome'];
        $preco = $row2['prod_preco'];
        $img = $row3['prod_imagem'];
    }
    
?>
<body>
    <div class="carousel_marca">
        <div class="carousel">
            <div class="container_carousel" id="img">
                <img src="../img/img1carrossel.jpg" class="imagem_carousel">
                <img src="../img/img2carrossel.jpg" class="imagem_carousel">
                <img src="../img/img3carrossel.jpg" class="imagem_carousel">
            </div>  
        </div>
    </div>
    <section class="produtos">
        <h1 class="produtos_lancamento">LANÇAMENTOS</h1>
        <div class="produtos_grid">
            <div class="produto_itens">
                <picture>
                    <a href="#">
                        <img src="http://localhost/tcc/img/teste_produto.jpg" class="produto_imagem">
                    </a>
                </picture>
                <p class="produto_nome"><?php echo($nome)?></p>
                <p class="produto_preco">R$ <?php echo($preco)?></p>
            </div>
            <div class="produto_itens">
                <picture>
                    <a href="#">
                        <img src="<?php echo($img) ?>" class="produto_imagem">
                    </a>
                </picture>
                <p class="produto_nome">Moletom Pica</p>
                <p class="produto_preco">R$500,00</p>
            </div>
            <div class="produto_itens">
                <picture>
                    <a href="#">
                        <img src="../img/teste_produto3.jpg" class="produto_imagem">
                    </a>
                </picture>
                <p class="produto_nome">Moletom Pica</p>
                <p class="produto_preco">R$500,00</p>
            </div>
            <div class="produto_itens">
                <picture>
                    <a href="#">
                        <img src="../img/teste_produto3.jpg" class="produto_imagem">
                    </a>
                </picture>
                <p class="produto_nome">Moletom Pica</p>
                <p class="produto_preco">R$500,00</p>
            </div>
        </div>    
    </section>
</body>


<script>

</script>
</html>