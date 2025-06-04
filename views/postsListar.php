<?php 
    require_once "layoutCabecalhoInicio.php";

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

                    <h2 class='text-red-400 text-3xl font-bold mb-6 text-center m-5'>{$post['titulo']}</h2>

                    <p class='mb-6 text-justify'>{$post['conteudo']}</p>
                
                    <p class='text-green-400'><strong>Tags: </strong>" . implode(', ', $post['tags']) . "</p>
                    <p class='text-green-400'><strong>Categoria:</strong> {$post['categoria']}</p>
                </div>
            ";
        }
    
    require_once "layoutRodape.php";
?>