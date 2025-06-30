<?php 
    require_once "layoutCabecalho.php";
?>

<div class="flex items-center flex-col mt-10 max-w-4xl mx-auto mb-10 bg-white p-8 rounded-2xl shadow-md">
    <div><img class="bg-green-400 w-50 h-50 m-5 rounded-full" src="<?php echo $_SESSION['imagem']?>"></div>
    <p class="m-3 text-3xl font-bold text-green-400"><?php echo $_SESSION['nome'];?></p>
    <p class="mb-10 text-xl"><?php echo $_SESSION['email'];?></p>
    <a class="bg-green-400 text-white py-2 px-4 rounded-lg hover:bg-green-300 transition-colors" href="/ProjetoBlog/alterarUsuarios?id=<?php echo $_SESSION['id_usuarios'];?>">Editar Perfil</a>
    <a class="bg-green-400 text-white mt-3 py-2 px-4 rounded-lg hover:bg-green-300 transition-colors" href="/ProjetoBlog/alterarSenha?id=<?php echo $_SESSION['id_usuarios'];?>">Alterar Senha</a>
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
                        <div class='flex items-center justify-around'>
                            <img class='w-10 h-10 rounded-full' src='{$post->fotoUsuario}'>
                            <p class='font-bold m-5'>{$post->usuario}</p>
                        </div>

                        <div class='flex items-center'>
                            <p>{$dataFormatada}</p>
                        </div>
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