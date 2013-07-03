<?php

require("criaConexao.php");

$id_carona = $_POST["id_carona"];
$id_usuario = $_POST["id_usuario"];
$mensagem = $_POST["mensagem"];


$query = "INSERT INTO usuarios_solicita_caronas (id_carona, id_usuario,mensagem,situacao) VALUES ($id_carona,$id_usuario,'$mensagem','Aguardando resposta')";

pg_query($con,$query) or die ("Erro ao inserir dados".pg_last_error());

echo "Solicitação enviada com sucesso";

pg_close();

?>
