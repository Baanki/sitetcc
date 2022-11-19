<?php
include_once('../includesfront/header.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" type="text/css" href="../styles/admin_produtos.css">
</head>
<body>
    <form method='POST'>
        <table>
            <tr>
                <td><label for="nome_produto">Nome do produto:</label></td>
                <td><input type="text" name="nome_produto" require><br></td>
            </tr>
            <tr>
                <td><label for="tipo_produto">Tipo produto:</label></td>
            </tr>
            <tr>
                <td>Camiseta:</td>
                <td><input type="radio" value="Camiseta" name="tipo_produto"></td>
            </tr>
            <tr>
                <td>Jaqueta:</td>
                <td><input type="radio" value="Jaqueta" name="tipo_produto"></td>
            </tr>
            <tr>
                <td>Moletom:</td>
                <td><input type="radio" value="Moletom" name="tipo_produto"></td>
            </tr>
            <tr>
                <td>Calça:</td>
                <td><input type="radio" value="Calca" name="tipo_produto"></td>
            </tr>
            <tr>
                <td>Calçado:</td>
                <td><input type="radio" value="Calcado" name="tipo_produto"></td>
            </tr>
            <tr>
                <td><label for="valor_produto">Valor do produto:</label></td>
                <td><input type="number" name="valor_produto" require><br></td>
            </tr>
            <tr>
                <td><label for="imagem_produto">Link da imagem do produto:</label></td>
                <td><input type="file" name="imagem_produto" ></td>
            </tr>
        </table>
        <input type="submit" name="adicionar_produtos">
    </form>

<?php
$agora = date('d/m/Y H:i');
echo $agora;
    if(isset($_POST['adicionar_produtos'])){
        $agora = date('d/m/Y H:i');
        echo("<script>alert('Produto adicionado')</script>");
        $query = mysqli_query($conexao, "insert into tb_produto(prod_nome, prod_tipo, prod_preco, cod_empresa, prod_imagem) values
                            ('{$_POST['nome_produto']}','{$_POST['tipo_produto']}','{$_POST['valor_produto']}',1,'http://localhost/tcc/img/{$_POST['imagem_produto']}')");
    };
    include_once('../includesfront/footer.php');
?>
</body>