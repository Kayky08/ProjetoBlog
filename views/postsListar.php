<?php 
    require_once "layoutCabecalhoInicio.php";

?>
    <form class="max-w-4xl mx-auto mb-10 bg-white p-8 rounded-2xl shadow-md" action="/ProjetoBlog/filtrar" method="post">
        <div class="flex justify-center itens-center">
            <select class="w-full border border-gray-300 rounded-lg m-5 h-10 px-4 py-2 text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500" name="categoria" id="categoria">
            "<option value='0'>Filtre por uma Categoria</option>";
            
            <?php 
                foreach($categorias as $categoria){
                    echo "<option value='{$categoria->id_categorias}'>{$categoria->cdescritivo}</option>";
                }
            ?>
            </select>
            
            <div class="flex w-100 justify-between flex-col">
            <button type="submit" class="bg-green-400 m-5 text-center text-white py-2 px-4 rounded-lg hover:bg-green-300 transition-colors">Filtrar</button>
            <?php 
                if($_POST){
                    echo "<a href='/ProjetoBlog/' class='bg-blue-400 m-5 text-center text-white py-2 px-4 rounded-lg hover:bg-blue-300 transition-colors'>Limpar filtros</a>";
                }
            ?>
            </div>
        </div>
    </form>

    <?php
        foreach($postsAgrupados as $post){
            $data = new DateTime($post['datap']);
            $dataFormatada = $data->format('d/m/Y H:i:s');

            echo "        
                <div class='max-w-4xl mx-auto mb-10 bg-white p-8 rounded-2xl shadow-md'>
            ";       

            if(!empty($_SESSION['tipo']) && $_SESSION['tipo'] == 'administrador'){
                echo "<div class='flex justify-end m-5'><a class=' bg-red-400 p-2 rounded-xl text-white' href='/ProjetoBlog/deletarPosts?id={$post['id']}'>Excluir</a></div>";
            }

            echo "
                    <div class='flex justify-between'>    
                        <p class='font-bold uppercase'>{$post['usuario']}</p>
                        <p>{$dataFormatada}</p>
                    </div>

                    <h2 class='text-green-400 text-3xl font-bold mb-6 text-center m-5'>{$post['titulo']}</h2>

                    <p class='mb-6 text-justify'>{$post['conteudo']}</p>
                
                    <p class='text-green-400'><strong>Tags: </strong>" . implode(', ', $post['tags']) . "</p>
                    <p class='text-green-400'><strong>Categoria:</strong> {$post['categoria']}</p>
                </div>
            ";
        }
    ?>
<?php 
    require_once "layoutRodape.php";
?>