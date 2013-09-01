<?php

require("criaConexao.php");

$id_carro_particular = $_POST["id_carro_particular"];
$nome = $_POST["nome"];
$lugares = $_POST["lugares"];

$query = "UPDATE carros_particulares SET nome='$nome', lugares='$lugares' WHERE id_carro_particular=$id_carro_particular";

pg_query($con,$query) or die ("Erro ao inserir dados".pg_last_error());

echo "Dados alterados com sucesso";

pg_close();

?>
