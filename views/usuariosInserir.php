<?php 
    require_once "layoutCabecalho.php";
?>
    <form action="#" class="max-w-4xl mx-auto mt-10 mb-10 bg-white p-8 rounded-2xl shadow-md" method="post">
        
        <h1 class="text-center text-3xl mb-5 font-bold text-green-400">Cadastre um Usuario</h1>

        <label class="block text-sm font-medium text-gray-700 mb-1" for="nome">Nome:</label>
        <input class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" type="text" id="nome" name="nome">
        <div class="text-center text-red-400"><?php echo $msg[0]; ?></div>

        <label class="block text-sm font-medium text-gray-700 mb-1" for="email">E-mail:</label>
        <input class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" type="email"  id="email" name="email">
        <div class="text-center text-red-400"><?php echo $msg[1]; ?></div>

        <label class="block text-sm font-medium text-gray-700 mb-1" for="senha">Senha:</label>
        <input class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" type="password" id="senha" name="senha">
        <div class="text-center text-red-400"><?php echo $msg[2]; ?></div>

        <label class="block text-sm font-medium text-gray-700 mb-1" for="vsenha">Confirme a senha:</label>
        <input class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" type="password" id="vsenha" name="vsenha">
        <div class="text-center text-red-400"><?php echo $msg[3]; ?></div>

        <input type="hidden" id="tipo" name="tipo" value="comum">

        <div class="flex justify-center">
            <button type="submit" class="bg-green-400 text-white m-5 py-2 px-4 rounded-lg hover:bg-green-300 transition-colors">Enviar</button>
        </div>
    </form>

</body>
</html>