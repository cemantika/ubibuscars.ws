<?php 
  // Connect to the database
  require("criaConexao.php");
  //Get the bytea data
  $cod=$_GET["cod"];
  $res = pg_query("SELECT encode(foto_perfil, 'base64') AS imagem FROM usuarios WHERE id_usuario=$cod");  
  $raw = pg_fetch_result($res, 'imagem');
  pg_close();   
  // Convert to binary and send to the browser
  header('Content-type: image/jpeg');
  echo base64_decode($raw);  
?>
