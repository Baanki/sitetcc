<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" type="text/css" href="../styles/pix.css">
</head>
<body>
<?php
 include_once('../includesfront/header.php');
 require_once '../vendor/autoload.php';
 $query_info = mysqli_query($conexao, "select * from tb_movimento as mov inner join tb_cliente as cli inner join tb_endereco as end on mov.cod_cliente={$_SESSION['id_cliente']} and
                                                                                                                                    cli.cod_cliente={$_SESSION['id_cliente']} and
                                                                                                                                    end.cod_cliente={$_SESSION['id_cliente']}");
 $info = mysqli_fetch_assoc($query_info);


MercadoPago\SDK::setAccessToken("APP_USR-2892002557288669-043018-392d89248cc43f0e3b1616db3173a9c6-259334307");

$payment = MercadoPago\Payment::find_by_id('51705452164');
$payment->save();
echo "<img style='width:250px;' src='data:image/png;base64, ".$payment->point_of_interaction->transaction_data->qr_code_base64."'>";
echo $payment->status;
echo "<pre>", print_r($payment),"</pre>";
?>
</body>
</html>