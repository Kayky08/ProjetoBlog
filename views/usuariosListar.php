<?php 
    require_once "layoutCabecalho.php"
?>
    <h1 class="text-center text-3xl mt-5 mb-5 font-bold text-green-400">Lista de Usuarios</h1>

    <table class="min-w-full divide-y divide-gray-200 bg-white border border-green-500">
        <thead>
            <tr class="border border-green-500 bg-green-300">
                <th class='px-4 py-2 text-center font-semibold text-white'>Codigo</th>
                <th class='px-4 py-2 text-center font-semibold text-white'>Nome</th>
                <th class='px-4 py-2 text-center font-semibold text-white'>Tipo</th>
                <th class='px-4 py-2 text-center font-semibold text-white'>Email</th>
                <th class='px-4 py-2 text-center font-semibold text-white'>Senha</th>
                <th colspan="2" class='px-4 py-2 text-center font-semibold text-white'>Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php 
            foreach($retorno as $dado){
                echo "
                    <tr>
                        <td class='px-4 py-2 text-center text-sm text-gray-800'>{$dado->id_usuarios}</td>
                        <td class='px-4 py-2 text-sm text-gray-800'>{$dado->nome}</td>
                        <td class='px-4 py-2 text-sm text-gray-800'>{$dado->tipo}</td>
                        <td class='px-4 py-2 text-sm text-gray-800'>{$dado->email}</td>
                        <td class='px-4 py-2 text-sm text-gray-800'>{$dado->senha}</td>

                        <td class='flex justify-center px-4 py-3 space-x-2'>
                            <a class='px-3 py-1 text-sm text-white bg-blue-400 rounded hover:bg-blue-300' href='/ProjetoBlog/alterarUsuarios?id={$dado->id_usuarios}'>Alterar</a>
                            <a class='px-3 py-1 text-sm text-white bg-red-400 rounded hover:bg-red-300' href='/ProjetoBlog/deletarUsuarios?id={$dado->id_usuarios}'>Excluir</a>
                        </td>

                    </tr>
                ";
            }
            ?>
        </tbody>
    </table>

    <br>

    <div class="flex justify-center"><a class="text-2xl p-2 text-white bg-green-400 rounded hover:bg-green-300" href="/ProjetoBlog/inserirUsuarios">Criar um Usuario</a></div>
</body>
</html>