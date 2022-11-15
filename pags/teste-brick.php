<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" type="text/css" href="../styles/carrinho.css">  
    <script src="https://sdk.mercadopago.com/js/v2">
        const mp = new MercadoPago("APP_USR-72478b91-c695-44c7-88ce-65840ae5bf40");
    </script>
<?php
 include_once('../includesfront/header.php');
 require_once '../vendor/autoload.php';
 
 $id_compra = (int) $_GET['id'];
 ?>
<?php
$service_url = "https://api.mercadopago.com/v1/payments/$id_compra";
$autorizacao = 'Bearer APP_USR-2892002557288669-043018-392d89248cc43f0e3b1616db3173a9c6-259334307';
$curl = curl_init($service_url);
//curl_setopt($curl, CURLOPT_URL,"https://api.mercadopago.com/v1/payments/51496454879");

$header = array();
$header[] = 'Content-lenght: 0';
$header[] = 'Content-type: aplicattion/json';
$header[] = 'Authorization: Bearer APP_USR-2892002557288669-043018-392d89248cc43f0e3b1616db3173a9c6-259334307';

curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
curl_setopt($curl, CURLOPT_USERPWD,$autorizacao);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
$curl_response = curl_exec($curl);
$response = json_decode($curl_response, true);

//var_dump($response);
$teste_status = $response["status"];
echo $id_compra;
echo $teste_status;
if ($teste_status === "approved"){
    mysqli_query($conexao,"update tb_produto_movimento set compra_status = 'Aprovado'");
    echo("PAGAMENTO APROVADO");
}else{
    echo("PAGAMENTO NÃO APROVADO");
    
};
echo("<br>");
 if(isset($_POST['botao_pix'])){
    $_SESSION['pagamento_pix'] = true;
 }
 if(isset($_SESSION['pagamento_pix'])){
    echo ($_SESSION['descricao_pagamento']);
    echo("<br>");
?>
<script>
    $payment = MercadoPago\Payment();
</script>
<body>
    <div id="statusScreenBrick_container">
    <script>
           const mp = new MercadoPago('APP_USR-72478b91-c695-44c7-88ce-65840ae5bf40');
           const bricksBuilder = mp.bricks();
        
           const renderStatusScreenBrick = async (bricksBuilder) => {
           const settings = {
                   initialization: {
                       paymentId: '<?php echo($id_compra)?>', // id do pagamento gerado pelo mercado pago
                   },
                   customization: {
                visual: {
                    style: {
                        theme: 'dark' // 'default' |'dark' | 'bootstrap' | 'flat'
                    },
                },
            },
                   callbacks: {
                    
                       onReady: (cardFormData) => {
                        
                       // callback chamado quando o Brick estiver pronto
                       },
                       onError: (error) => {
                       // callback chamado para todos os casos de erro do Brick
                       },
                   },
               };
               window.statusScreenBrickController = await bricksBuilder.create('statusScreen', 'statusScreenBrick_container', settings);
           };
           
           //renderStatusScreenBrick(bricksBuilder);

        
       </script>
    </div>
    <?php
    }else echo ("não foi");
    ?>
</body>