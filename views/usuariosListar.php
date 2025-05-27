<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
</head>
<body>
    <h1>Lista de Usuarios</h1>

    <a href="/ProjetoBlog/">Voltar</a>
    <br><br>

    <table border="1px">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Email</th>
                <th>Senha</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php 
            foreach($retorno as $dado){
                echo "
                    <tr>
                        <td>{$dado->id_usuarios}</td>
                        <td>{$dado->nome}</td>
                        <td>{$dado->tipo}</td>
                        <td>{$dado->email}</td>
                        <td>{$dado->senha}</td>
                        <td><a href='/ProjetoBlog/alterarUsuarios?id={$dado->id_usuarios}'>Alterar</a></td>
                        <td><a href='/ProjetoBlog/deletarUsuarios?id={$dado->id_usuarios}'>Excluir</a></td>
                    </tr>
                ";
            }
            ?>
        </tbody>
    </table>

    <br>

    <a href="/ProjetoBlog/inserirUsuarios">Criar um Usuario</a>
</body>
</html>