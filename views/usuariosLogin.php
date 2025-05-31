<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    	<h1>Identificação</h1><br>

        <div><?php echo $msg[2];?></div>

		<form action="#" method="POST">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email">
            <div><?php echo $msg[0];?></div>
			<br><br>

			<label for="senha">Senha</label>
			<input type="password" id="senha" name="senha">
			<div><?php echo $msg[1];?></div>
			<br><br>

    		<a href="/ProjetoBlog/inserirUsuarios">Caso não tenha um login, faça o cadastro aqui</a>
			<br><br>

			<input type="submit" value="Enviar">
		</form>
</body>
</html>