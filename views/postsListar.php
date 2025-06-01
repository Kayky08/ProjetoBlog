<?php 
    if(!isset($_SESSION)) session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Lista de Posts</title>
</head>
<body class="bg-gray-100 p-6" >
    <h1 class="text-5xl font-bold mb-4 text-center ">Entre Linhas e Telas</h1>

    <?php
        if(!empty($_SESSION['id_usuarios'])){

            switch($_SESSION['tipo']){
                case "administrador":
                    echo "
                    Olá, {$_SESSION['nome']}
                
                    <ul>
                        <li><a href='/ProjetoBlog/listarUsuarios'>Usuarios</a></li>
                        <li><a href='/ProjetoBlog/listarCategorias'>Categorias</a></li>
                        <li><a href='/ProjetoBlog/alterarUsuarios?id={$_SESSION['id_usuarios']}'>Alterar</a></li>
                        <li><a href='/ProjetoBlog/logout'>Logout</a></li>
                    </ul>
                    ";
                break;

                case "comum":
                    echo "
                    Olá, {$_SESSION['nome']}
                
                    <ul>
                        <li><a href='/ProjetoBlog/logout'>Logout</a></li>
                        <li><a href='/ProjetoBlog/alterarUsuarios?id={$_SESSION['id_usuarios']}'>Alterar</a></li>
                    </ul>

                    <a href='/ProjetoBlog/inserirPosts'>Criar um Post</a>
                    ";
                break;
            }
        }
        else{
            echo "Para fazer um post faça o <a href='/ProjetoBlog/login'>Login</a>";
        }

        foreach($postsAgrupados as $post){
            $data = new DateTime($post['datap']);
            $dataFormatada = $data->format('d/m/Y H:i:s');

            echo "        
                <div class='max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-md'>       
                    <p class='font-bold'>{$post['usuario']}</p>
                    <p>{$dataFormatada}</p>

                    <h2 class='text-2xl font-bold mb-6 text-center'>{$post['titulo']}</h2>

                    <p class='mb-6'>{$post['conteudo']}</p>
                </div>
            ";
            
            echo "<p><strong>Tags:</strong> " . implode(', ', $post['tags']) . "</p>";
            echo "<p><strong>Categoria:</strong> {$post['categoria']}</p>";
        }
    ?>
</body>
</html>