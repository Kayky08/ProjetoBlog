<?php 
    require_once "layoutCabecalho.php";
?>
    <form class="max-w-4xl m-10 mx-auto mb-10 bg-white p-8 rounded-2xl shadow-md" action="#" method="post">
        <h1 class="text-center text-3xl mt-5 mb-5 font-bold text-green-400">Crie uma Categoria</h1>    

        <label class="block text-sm font-medium text-gray-600" for="descritivo">Descritivo:</label>
        <input class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" type="text" type="text" id="descritivo" name="descritivo">
        <div><?php echo $msg; ?><div>

        <div class="flex justify-center">
            <button type="submit" class="bg-green-400 text-white m-5 py-2 px-4 rounded-lg hover:bg-green-300 transition-colors">Enviar</button>
        </div>
    </form>

<?php 
    require_once "layoutRodape.php";
?>