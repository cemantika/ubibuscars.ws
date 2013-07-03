<?php

require("criaConexao.php");

$id = $_POST["id"];


$query = "UPDATE usuarios SET ativo=0 WHERE id_usuario=$id";

pg_query($con,$query) or die ("Erro ao deletar dados".pg_last_error());

pg_close();

?>
