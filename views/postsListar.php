<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Posts</title>
</head>
<body>
    <h1>Lista de Posts</h1>

    <?php 
        foreach($retorno as $dado){
            echo"<h2>{$dado->titulo}</h2>
                 <h6>{$dado->datap}</h6>
                
                 <p>{$dado->conteudo}</p>
            ";
        }
    ?>

    <a href="/ProjetoBlog/inserir">Criar um Post</a>
</body>
</html>