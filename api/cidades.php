<?php
require_once '../includes/conexao.php';

$query = "select cid_nome from tb_cidade where cod_estado = ?";

$id = $_GET["cod_estado"] ?? 0;

$result = $pdo->prepare($query);
$result->execute([$id]);

$dados = $result->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($dados)


?>