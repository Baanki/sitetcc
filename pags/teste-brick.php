<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" type="text/css" href="../styles/teste-brick.css">  
    <link rel="stylesheet" type="text/css" href="../styles/pix.css">  
    <script src="https://sdk.mercadopago.com/js/v2">
    </script>
</head>
<body>
<?php
 include_once('../includesfront/header.php');
 require_once '../vendor/autoload.php';
 
 $id_compra = (int) $_GET['id'];
 ?>
<?php
MercadoPago\SDK::setAccessToken("APP_USR-2892002557288669-043018-392d89248cc43f0e3b1616db3173a9c6-259334307");

$payment = MercadoPago\Payment::find_by_id($id_compra);
$payment->save();


if ($payment->status === "approved"){
    mysqli_query($conexao,"update tb_movimento set compra_status = 'Aprovado'");
    ?>
    <div class="container_pagamento_concluido">
        <h1 class="titulo_pagamento">Pagamento realizado com sucesso</h1>
        <h2 class="titulo_pagamento">Obrigado pela preferência</h2>
    </div>
    <?php
}else{
    
    ?>
    <div class="container_pagamento_pendente">
        <h1 class="titulo_pagamento">Pagamento Pendente...</h1>
    <div class="container_pagamento">
        <h1 class="titulo_pagamento">Faça o pagamento para continuar</h1>
        <h2 class="subtitulo_pagamento">Leia o Código QR para concluir seu pagamento</h2>
        <div class="qrcode">
        <?php
        echo "<img style='width:250px;' src='data:image/png;base64, ".$_SESSION['codigo_qr_64']."'>";
        //echo "<pre>", print_r($payment),"</pre>";

        ?>
                <input type="text" name="qrcode" id="qrcode" class="input_qrcode" value="<?php echo $_SESSION['codigo_qr']?>">
                <button class="botao_copiar" onclick="copiar_texto()">Clique aqui para copiar o código</button>
            </div>
        <div class="tutorial">
                <h1 class="titulo_tutorial">Como fazer pagamentos com Pix:</h1>
                    <ol class="conteudo_tutorial">1) Acesse o aplicativo do seu banco</ol>
                    <ol class="conteudo_tutorial">2) Procure por pagamentos por Pix</ol>
                    <ol class="conteudo_tutorial">3) Procure a opção Pagar QR Code</ol>
                    <ol class="conteudo_tutorial">4) Aproxime a câmera do celular no QR Code ao lado</ol>
                <h1 class="titulo_tutorial">Como fazer pagamentos com Internet Banking:</h1>
                <ol class="conteudo_tutorial">1) Copie o código ao lado</ol>
                <ol class="conteudo_tutorial">2) Acesse o Internet Banking ou aplicativo do seu banco</ol>
                <ol class="conteudo_tutorial">3) Procure por pagamentos por Pix</ol>
                <ol class="conteudo_tutorial">4) Procure a opção Copia e Cola e cole o código</ol>
                <button style="top: 5.5em" class="botao_concluir" onclick="recarregar_pagina()">Clique aqui quando finalizar o pix para concluir o pagamento</button>  
        </div>
        </div>
    </div>
    <?php
}

?>
</body>
<script>
    function copiar_texto() {
        let textoCopiado = document.getElementById("qrcode");
        textoCopiado.select();
        textoCopiado.setSelectionRange(0, 99999)
        document.execCommand("copy");
    }
    function recarregar_pagina(){
        document.location.reload(true);
    }
</script>