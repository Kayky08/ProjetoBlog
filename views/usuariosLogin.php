<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./src/output.css" rel="stylesheet">
    <title>Login</title>
</head>
<body class="bg-gray-100 p-6 font-mono">
    <h1 class="text-green-400 text-7xl font-bold mb-4 text-center">Entre Linhas e Telas</h1>

		<form class="max-w-4xl mx-auto mt-10 mb-10 bg-white p-8 rounded-2xl shadow-md" action="#" method="POST">
			<h1 class="text-green-400 text-3xl font-bold mb-4 text-center">Login</h1><br>

            <label for="email" class="block text-sm font-medium text-gray-600">E-mail</label>
            <input type="email" placeholder="Digite seu E-mail" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" id="email" name="email">
            <div class="text-center text-red-400"><?php echo $msg[0];?></div>

			<label for="senha" class="block text-sm font-medium text-gray-600">Senha</label>
			<input type="password" placeholder="Digite sua Senha" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" id="senha" name="senha">
			<div class="text-center text-red-400"><?php echo $msg[1];?></div>

			<div class="text-center m-5">
    			<p>Caso não tenha um login, faça o <a class="hover:bg-green-400 px-2 py-2 rounded-lg hover:text-white" href="/ProjetoBlog/inserirUsuarios"> cadastro aqui</a></p>
			</div>

        	<div class="text-center text-red-400"><?php echo $msg[2];?></div>

			<div class="flex justify-center">
            	<button type="submit" class="bg-green-400 text-white m-5 py-2 px-4 rounded-lg hover:bg-green-300 transition-colors">Enviar</button>
        	</div>
		</form>
</body>
</html>