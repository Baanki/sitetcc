
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" type="text/css" href="../styles/carrinho.css">
    
<?php
 include_once('../includesfront/header.php');
 require_once '../vendor/autoload.php';
 unset($_SESSION['carrinho']);
 isset($_SESSION['pagamento_pix']);
 $infos_compra_query = mysqli_query($conexao, "select * from tb_movimento as mov inner join tb_cliente as cli inner join tb_endereco as ende on mov.cod_cliente = {$_SESSION['id_cliente']} and cli.cod_cliente = {$_SESSION['id_cliente']} and ende.fk_cod_cliente = {$_SESSION['id_cliente']};");
 $infos_compra = mysqli_fetch_assoc($infos_compra_query);

 MercadoPago\SDK::setAccessToken("APP_USR-2892002557288669-043018-392d89248cc43f0e3b1616db3173a9c6-259334307");
 $payment = new MercadoPago\Payment();

 $payment->transaction_amount = $infos_compra['mov_valor_total'];
 $payment->description = "";
 $payment->payment_method_id = "pix";
 $payment->payer = array(
     "email" => $infos_compra['cli_email'],
     "first_name" => $infos_compra['cli_nome'],
     "identification" => array(
         "type" => "CPF",
         "number" => $infos_compra['cli_cpf'],
      ),
     "address"=>  array(
         "zip_code" => $infos_compra['end_cep'],
         "street_name" => $infos_compra['end_logradouro'],
         "street_number" => $infos_compra['end_numero'],
         "neighborhood" => $infos_compra['end_bairro'],
         "city" => $infos_compra['end_cidade'],
         "federal_unit" => $infos_compra['end_estado'],
      )
   );
   $payment->save();

 echo "<img style='width:250px;' src='data:image/png;base64, ".$payment->point_of_interaction->transaction_data->qr_code_base64."'>";
 //echo "<pre>", print_r($payment),"</pre>";
 echo ($payment->id);
 $_SESSION['status'] = $payment->status;
 echo $_SESSION['status'];
?>
</head>
<body>
    <form method="POST">
        <input type="submit" name="botao_pix">
    </form>
   <?php
   if (isset($_POST['botao_pix'])){
    echo "<script>document.location='teste-brick.php?id=$payment->id'</script>";
   }
   ?>
    <a href="teste-brick.php?id=<?php echo($payment->id);?>">Cluncouiu</a>