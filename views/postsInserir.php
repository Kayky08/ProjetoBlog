<?php 
    require_once "layoutCabecalho.php";
?>
    <form class="max-w-4xl mx-auto mt-10 mb-10 bg-white p-8 rounded-2xl shadow-md" action="#" method="post">
        <h1 class="text-center text-3xl mb-5 font-bold text-green-400">Crie um Post</h1>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1" for="categoria">Categoria: </label>
            <select class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500" name="categoria" id="categoria">
                <option  value="0">Escolha uma categoria</option>
                <?php 
                    foreach($categorias as $categoria){
                        echo "
                            <option value='{$categoria->id_categorias}'>{$categoria->cdescritivo}</option>
                        ";
                    }
                ?>
            </select>
            <div class="text-center text-red-400"><?php echo $msg[3]; ?></div>
        </div>
    
        <label class="block text-sm font-medium text-gray-600" for="titulo">Titulo:</label>
        <input class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" type="text" id="titulo" name="titulo">
        <div class="text-center text-red-400"><?php echo $msg[0]; ?></div>

        <label class="block text-sm font-medium text-gray-600" for="conteudo">Conteudo:</label>
        <textarea class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="conteudo" id="conteudo" rows="10" column="200"></textarea>
        <div class="text-center text-red-400"><?php echo $msg[1]; ?></div>

        <label class="block text-sm font-medium text-gray-600" for="tags">Tag (separadas por virgula):</label>
        <input class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" type="text" id="tags" name="tags">
        <div class="text-center text-red-400"><?php echo $msg[2]; ?></div>

        <div class="flex justify-center">
            <button type="submit" class="bg-green-400 text-white m-5 py-2 px-4 rounded-lg hover:bg-green-300 transition-colors">Enviar</button>
        </div>
    </form>
</body>
</html>