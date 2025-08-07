<?php 

    // strip_tags: Corta a execução de tentativas de inserção de scripts via formulário!
    if(isset($_POST['btnEnviar'])){
        $palavra = strip_tags(trim($_POST['palavra']));
        
        $palavra = trim($_POST['palavra']);
        $especiais = array(".", ",", ";", "!", "@", "#", "%", "¨", "*", "(", ")", "+", "-", "=", "§", "$", "/", "|", "\\", ":", "<", ">", "?", "{", "}", "[", "]", "&", "'", "`", "´", " ", "°", "ª", "^", "~", '"', '.',);

        $palavra = str_replace($especiais, "", $palavra);

        echo $palavra;
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste</title>
</head>
<body>
    <form action="teste.php" method="post">
        <label>Digite uma Palavra:</label>
        <input type="text" name="palavra">
        <button name="btnEnviar">Enviar</button>
    </form>
</body>
</html>