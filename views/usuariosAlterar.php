<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre um Usuario</title>
</head>
<body>
    <h1>Edite seu perfil</h1>

    <form action="" method="post">
        <input type="hidden" id="id" name="id" value="<?php echo $retorno[0]->id_usuarios;?>">

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $retorno[0]->nome;?>">
        <div><?php echo $msg[0]; ?></div>
        <br><br>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" value="<?php echo $retorno[0]->email;?>">
        <div><?php echo $msg[1]; ?></div>
        <br><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" value="<?php echo $retorno[0]->senha;?>">
        <div><?php echo $msg[2]; ?></div>
        <br><br>

        <label for="vsenha">Confirme a senha:</label>
        <input type="password" id="vsenha" name="vsenha" value="<?php echo $retorno[0]->senha;?>">
        <div><?php echo $msg[3]; ?></div>
        <br><br>

        <input type="submit" value="Postar">
    </form>
</body>
</html>