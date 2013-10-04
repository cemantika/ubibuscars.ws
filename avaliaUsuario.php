<?php 

require("criaConexao.php");


$id_carona = $_POST["id_carona"];
$id_avaliador = $_POST["id_avaliador"];
$id_avaliado = $_POST["id_avaliado"];
$mensagem = $_POST["mensagem"];
$nota = $_POST["nota"];



$query =  "INSERT INTO avaliacao (id_avaliacao, id_carona,id_avaliador,id_avaliado,nota,avaliacao) VALUES (nextval('sq_avaliacao'),$id_carona,$id_avaliador,$id_avaliado,$nota,'$mensagem') ";

pg_query($con,$query) or die ($mensagem."Erro ao avaliar usuario".pg_last_error());

echo "Avaliação concluida";

pg_close();
?>