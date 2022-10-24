<?php
include_once('../includesfront/header.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" type="text/css" href="../styles/indexeprodutos.css">
    <script src="../scripts/carousel.js" defer></script>
</head>

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
        <?php
            $query = 'select cod_produto,prod_nome,prod_imagem,prod_preco from tb_produto where prod_data <= (select max(prod_data) from tb_produto) order by prod_data desc limit 8';
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
                        <a href="pag_produto.php?id=<?php echo $row['cod_produto'];?>">
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
    <div class="carousel_marca">
        <div class="carousel">
            <div class="container_carousel" id="img">
                <img src="../img/img1carrossel.jpg" class="imagem_carousel">
                <img src="../img/img2carrossel.jpg" class="imagem_carousel">
                <img src="../img/img3carrossel.jpg" class="imagem_carousel">
            </div>  
        </div>
    </div>
    <?php
    include_once('../includesfront/footer.php');
    ?>
</body>


<script>

</script>
</html>