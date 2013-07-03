<?php

require("criaConexao.php");

$id_usuario = $_POST["id_usuario"];
$id_pontoOrigem = $_POST["id_pontoOrigem"];
$id_pontoDestino = $_POST["id_pontoDestino"];
$enderecoOrigem = $_POST["enderecoOrigem"];
$enderecoDestino = $_POST["enderecoDestino"];
$horarioOrigem = $_POST["horarioOrigem"];
$horarioDestino = $_POST["horarioDestino"];
$tipo = $_POST["tipo"]; 
$data= date('Y-m-d H:i:s');


$query = "INSERT INTO caronas (id_usuario,id_parada_origem,id_parada_destino,endereco_origem,horario_origem,endereco_destino,horario_destino,tipo,data) VALUES ($id_usuario,$id_pontoOrigem,$id_pontoDestino,'$enderecoOrigem','$horarioOrigem','$enderecoDestino', '$horarioDestino',$tipo,'$data')";

pg_query($con,$query) or die ("Erro ao inserir dados");

echo "Carona cadastrada com sucesso";

pg_close();

?>
