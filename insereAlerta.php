<?php

require("criaConexao.php");

$id_usuario = $_POST["id_usuario"];
$alerta = $_POST["alerta"];


$query = "UPDATE usuarios SET alertas = array_append(alertas, '".$alerta."') WHERE id_usuario=".$id_usuario;

pg_query($con,$query) or die ("Erro ao atualizar dados".pg_last_error());

echo "Alerta adicionado com sucesso.";

pg_close();

?>
