<script src="https://sdk.mercadopago.com/js/v2"></script>
<?php
require_once '../vendor/autoload.php';

 MercadoPago\SDK::setAccessToken("APP_USR-2892002557288669-043018-392d89248cc43f0e3b1616db3173a9c6-259334307");
 $payment = new MercadoPago\Payment();

 $payment->transaction_amount = 0.10;
 $payment->description = "Título do produto";
 $payment->payment_method_id = "pix";
 $payment->payer = array(
     "email" => "test@test.com",
     "first_name" => "Test",
     "last_name" => "User",
     "identification" => array(
         "type" => "CPF",
         "number" => "19119119100"
      ),
     "address"=>  array(
         "zip_code" => "06233200",
         "street_name" => "Av. das Nações Unidas",
         "street_number" => "3003",
         "neighborhood" => "Bonfim",
         "city" => "Osasco",
         "federal_unit" => "SP"
      )
   );
   $payment->save();
 ?>