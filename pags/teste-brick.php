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
                       onReady: () => {
                       // callback chamado quando o Brick estiver pronto
                       },
                       onError: (error) => {
                       // callback chamado para todos os casos de erro do Brick
                       },
                   },
               };
               window.statusScreenBrickController = await bricksBuilder.create('statusScreen', 'statusScreenBrick_container', settings);
           };
           
           renderStatusScreenBrick(bricksBuilder);
       </script>
    </div>
</body>