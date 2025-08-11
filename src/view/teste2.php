<?php
$senha = 'senha123';
$senhadigitada = 'senha123';


$senha_criptografada = md5($senha);
$senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);

echo strlen($senha_criptografada);

// if(password_verify($senhadigitada, $senha_criptografada)){
//     echo 'Senha Correta!';
// }else{
//     echo 'Senha Errada!';
// }

echo " $senha_criptografada";

echo "TESTE";