<?php 
    require_once "layoutCabecalho.php";
?>

<div class="flex items-center flex-col mt-10 max-w-4xl mx-auto mb-10 bg-white p-8 rounded-2xl shadow-md">
    <div class="bg-green-400 w-50 h-50 rounded-full"><img src="" alt=""></div>
    <p class="m-5"><?php echo $_SESSION['nome'];?></p>
    <p class="mb-5"><?php echo $_SESSION['email'];?></p>
    <a href="/ProjetoBlog/alterarUsuarios?id=<?php echo $_SESSION['id_usuarios'];?>">Editar Perfil</a>
</div>

    <?php
        foreach($posts as $post){
            $data = new DateTime($post->datap);
            $dataFormatada = $data->format('d/m/Y H:i:s');

            echo "        
                <div class='max-w-4xl mx-auto mb-10 bg-white p-8 rounded-2xl shadow-md'>
            ";       

            if(!empty($_SESSION['nome']) && $_SESSION['nome'] == $post->usuario){
                echo "<div class='flex justify-end gap-10 m-5'>
                        <a class=' bg-red-400 p-2 rounded-xl text-white hover:bg-red-300' href='/ProjetoBlog/deletarPosts?id={$post->id_posts}'>Excluir</a>
                        <a class=' bg-blue-400 p-2 rounded-xl text-white hover:bg-blue-300' href='/ProjetoBlog/alterarPosts?id={$post->id_posts}'>Alterar</a>
                      </div>";
            }

            echo "
                    <div class='flex justify-between'>    
                        <p class='font-bold'>{$post->usuario}</p>
                        <p>{$dataFormatada}</p>
                    </div>

                    <h2 class='text-green-400 text-3xl font-bold mb-6 text-center m-5'>{$post->titulo}</h2>

                    <div class='flex justify-center'>
                        <img class='m-5 rounded-xl' src='{$post->imagem}'>
                    </div>

                    <p class='mb-6 text-justify'>{$post->conteudo}</p>
                
                    <p class='text-green-400'><strong>Tags: </strong>{$post->tags}</p>
                    <p class='text-green-400'><strong>Categoria:</strong> {$post->categoria}</p>
                </div>
            ";
        }
    ?>

<?php 
    require_once "layoutRodape.php";
?>