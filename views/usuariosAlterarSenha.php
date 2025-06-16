<?php 
    require_once "layoutCabecalho.php";
?>

    <form class="max-w-4xl mx-auto m-10 bg-white p-8 rounded-2xl shadow-md" action="" method="post">
        <h1 class="text-center text-3xl mt-5 mb-5 font-bold text-green-400">Altere sua Senha</h1>

        <input type="hidden" id="id" name="id" value="<?php echo $retorno[0]->id_usuarios;?>">

        <div>
            <label for="senha" class="block text-sm font-medium text-gray-600">Senha:</label>
            <input type="password" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" id="senha" name="senha">
            <div class="text-center text-red-400"><?php echo $msg[0]; ?></div>
        </div>

        <div>
            <label for="vsenha" class="block text-sm font-medium text-gray-600">Confirme a senha:</label>
            <input type="password" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" id="vsenha" name="vsenha">
            <div class="text-center text-red-400"><?php echo $msg[1]; ?></div>
        </div>

        <div class="flex justify-center">
            <button type="submit" class="bg-green-400 text-white m-5 py-2 px-4 rounded-lg hover:bg-green-300 transition-colors">Enviar</button>
        </div>
    </form>

<?php
    require_once "layoutRodape.php";
?>