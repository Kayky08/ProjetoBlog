<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criando um Post</title>
</head>
<body>
    <h1>Crie um Post</h1>

    <form action="#" method="post">
        <label for="titulo">Titulo:</label>
        <input type="text" id="titulo" name="titulo">
        <div><?php echo $msg[0]; ?></div>
        <br><br>

        <label for="conteudo">Conteudo:</label><br>
        <textarea name="conteudo" id="conteudo" rows="10" column="200"></textarea>
        <div><?php echo $msg[1]; ?></div>
        <br><br>

        <label for="tags">Tag (separadas por virgula):</label>
        <input type="text" id="tags" name="tags">
        <div><?php echo $msg[2]; ?></div>
        <br><br>

        <input type="submit" value="Postar">
    </form>
</body>
</html>