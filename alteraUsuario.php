<?php

require("criaConexao.php");

$id = $_POST["id"];
$nome = $_POST["nome"];
$login = $_POST["login"];
$email = $_POST["email"]; 
$nascimento = $_POST["nascimento"];
$curso = $_POST["curso"];
$sexo = $_POST["sexo"];


//Converte a string nascimento em Data
list($d, $m, $y) = explode('/', $nascimento);
$mk=mktime(0, 0, 0, $m, $d, $y);
$myDate=strftime('%Y-%m-%d',$mk);

//Imagem
$arquivo = fopen($_FILES['imagem']['tmp_name'],'r');
$dados = fread($arquivo,filesize($_FILES['imagem']['tmp_name']));
$imagem = file_get_contents($_FILES['imagem']['tmp_name']);
$escaped = bin2hex($imagem);

$query = "UPDATE usuarios SET nome_usuario='$nome', login='$login',email='$email', data_nascimento='$myDate',foto_perfil=decode('{$escaped}' , 'hex'), sexo='$sexo' WHERE id_usuario=$id";

pg_query($con,$query) or die ("Erro ao inserir dados".pg_last_error());

echo "Dados alterados com sucesso";

pg_close();

?>
