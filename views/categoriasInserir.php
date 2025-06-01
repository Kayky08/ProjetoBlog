<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criando uma Categoria</title>
</head>
<body>
    <h1>Crie uma Categoria</h1>

    <a href="/ProjetoBlog/listarCategorias">Voltar</a>
    <br><br>

    <form action="#" method="post">
        <label for="descritivo">Descritivo:</label>
        <input type="text" id="descritivo" name="descritivo">
        <div><?php echo $msg; ?><div>
        <br><br>

        <input type="submit" value="Criar">
    </form>
</body>
</html>