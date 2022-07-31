<?php
require_once '../conexao.php';

$query = "select cod_estado, est_nome from tb_estado";

$result = $pdo->prepare($query);
$result->execute();

$dados = $result->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($dados)
?>