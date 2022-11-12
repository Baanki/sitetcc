<script src="https://sdk.mercadopago.com/js/v2"></script>
<?php
$id = (int) $_GET['id'];
echo ($id);
  include_once('apipix.php');
  require_once '../vendor/autoload.php';
  $response = array(
    
    'status' => $payment->status,
    'status_detail' => $payment->status_detail,
    'id' => $payment->id
);
echo json_encode($response);
?>