<?php 
    require_once "layoutCabecalho.php";
?>
    <h1 class="text-center text-3xl mt-5 mb-5 font-bold text-green-400">Lista de Categorias</h1>

    <div class="flex justify-center"><a class="text-2xl m-5 p-2 text-white bg-green-400 rounded-lg hover:bg-green-300" href="/ProjetoBlog/inserirCategorias">Criar uma Categoria</a></div>

    <table class="min-w-full divide-y bg-white divide-gray-200 border border-green-500">
        <thead>
            <tr class="border border-green-500 bg-green-300">
                <th class='px-4 py-2 text-center font-semibold text-white'>Codigo</th>
                <th class='px-4 py-2 text-center font-semibold text-white'>Descritivo</th>
                <th colspan="2" class='px-4 py-2 text-center font-semibold text-white'>Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php 
            foreach($retorno as $dado){
                echo "
                    <tr>
                        <td class='px-4 py-2 text-center text-sm text-gray-800'>{$dado->id_categorias}</td>
                        <td class='px-4 py-2 text-center text-sm text-gray-800'>{$dado->cdescritivo}</td>
            
                        <td class='flex justify-center px-4 py-3 space-x-2'>
                            <a class='px-3 py-1 text-sm text-white bg-blue-400 rounded hover:bg-blue-300' href='/ProjetoBlog/alterarCategorias?id={$dado->id_categorias}'>Alterar</a>
                            <a class='px-3 py-1 text-sm text-white bg-red-400 rounded hover:bg-red-300' href='/ProjetoBlog/alterarCategorias?id={$dado->id_categorias}'>Excluir</a>
                        </td>
                    </tr>
                ";
            }
            ?>
        </tbody>
    </table>
<?php
    require_once "layoutRodape.php";
?>