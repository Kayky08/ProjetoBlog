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
    foreach($postsAgrupados as $post){
        echo "
            <h2>{$post['titulo']}</h2>
            <h6>{$post['datap']}</h6>
            <p>{$post['conteudo']}</p>
        ";
        
        echo "<p><strong>Tags:</strong> " . implode(', ', $post['tags']) . "</p>";
    }
    ?>

    <a href="/ProjetoBlog/inserir">Criar um Post</a>
</body>
</html>