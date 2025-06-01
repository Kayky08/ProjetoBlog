<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
</head>
<body>
    <h1>Lista de Categorias</h1>

    <a href="/ProjetoBlog/">Voltar</a>
    <br><br>

    <table border="1px">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>descritivo</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php 
            foreach($retorno as $dado){
                echo "
                    <tr>
                        <td>{$dado->id_categorias}</td>
                        <td>{$dado->cdescritivo}</td>
                        <td><a href='/ProjetoBlog/alterarCategorias?id={$dado->id_categorias}'>Alterar</a></td>
                        <td><a href='/ProjetoBlog/deletarCategorias?id={$dado->id_categorias}'>Excluir</a></td>
                    </tr>
                ";
            }
            ?>
        </tbody>
    </table>

    <br>

    <a href="/ProjetoBlog/inserirCategorias">Criar uma Categoria</a>
</body>
</html>