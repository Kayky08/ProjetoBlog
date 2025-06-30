<?php 
    require_once "layoutCabecalho.php";
?>

    <form class="max-w-4xl mx-auto m-10 bg-white p-8 rounded-2xl shadow-md" action="" method="post" enctype="multipart/form-data">
        <h1 class="text-center text-3xl mt-5 mb-5 font-bold text-green-400">Edite seu perfil</h1>

        <input type="hidden" id="id" name="id" value="<?php echo $retorno[0]->id_usuarios;?>">

        <div>
            <label for="nome" class="block text-sm font-medium text-gray-600">Nome: </label>
            <input type="text" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" id="nome" name="nome" value="<?php echo $retorno[0]->nome;?>">
            <div class="text-center text-red-400"><?php echo $msg[0]; ?></div>
        </div>

            <?php 
                if($_SESSION['tipo'] == 'administrador'){
                    echo "
                        <div>
                            <label class='block text-sm font-medium text-gray-700 mb-1' for='tipo'>Tipo do Usuario: </label>
                            <select class='w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500' name='tipo' id='tipo'>
                                <option  value='0'>Altere o tipo do Usuario</option>
                                <option  value='administrador'>Administrador</option>
                                <option  value='comum' selected>Comum</option>
                            </select>
                            <div class='text-center text-red-400'>{$msg[1]}</div>
                        </div>
                    ";
                }
            ?>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-600">E-mail:</label>
            <input type="email" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" id="email" name="email" value="<?php echo $retorno[0]->email;?>">
            <div class="text-center text-red-400"><?php echo $msg[2]; ?></div>
        </div>

        <input type="hidden" name="imagemAtual" id="imagemAtual" value="<?php echo $retorno[0]->imagem;?>">

        <div class="flex justify-center">
            <label class="m-5 cursor-pointer bg-green-400 hover:bg-green-300 text-white font-bold py-2 px-4 rounded-lg" for="imagem">Imagem: 
            <input type="file" name="imagem" id="imagem" accept="image/*">
            </label>
        </div>

        <div class="text-center text-red-400"><?php echo $msg[3]; ?></div>
        
        <div class="flex justify-center">
            <button type="submit" class="bg-green-400 text-white m-5 py-2 px-4 rounded-lg hover:bg-green-300 transition-colors">Enviar</button>
        </div>
    </form>
</body>
</html>