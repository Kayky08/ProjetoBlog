<?php 
    if(!isset($_SESSION)) session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Posts</title>
</head>
<body>
    <h1>Lista de Posts</h1>

    <a href="/ProjetoBlog/">Voltar</a>
    <br><br>

    <?php
        if(!isset($_SESSION)) session_start();

        if(!empty($_SESSION['id_usuarios'])){

            switch($_SESSION['tipo']){
                case "administrador":
                    echo "
                    Olá, {$_SESSION['nome']}
                
                    <ul>
                        <li><a href='/ProjetoBlog/listarUsuarios'>Usuarios</a></li>
                        <li><a href='/ProjetoBlog/logout'>Logout</a></li>
                    </ul>
                    ";

                    foreach($postsAgrupados as $post){
                        echo "        
                            <h2>{$post['titulo']}</h2>
                            <h4>{$post['usuario']}</h4>
                            <h6>{$post['datap']}</h6>
                            <p>{$post['conteudo']}</p>

                            <a href='/ProjetoBlog/deletarPosts?id={$post['id']}'>Excluir</a>
                        ";
                        
                        echo "<p><strong>Tags:</strong> " . implode(', ', $post['tags']) . "</p>";
                        echo "<p><strong>Categoria:</strong>{$post['categoria']}</p>";
                    }
                break;

                case "comum":
                    echo "
                    Olá, {$_SESSION['nome']}
                
                    <ul>
                        <li><a href='/ProjetoBlog/logout'>Logout</a></li>
                    </ul>

                    <a href='/ProjetoBlog/inserirPosts'>Criar um Post</a>
                    ";

                    foreach($postsAgrupados as $post){
                        echo "        
                            <h2>{$post['titulo']}</h2>
                            <h4>{$post['usuario']}</h4>
                            <h6>{$post['datap']}</h6>
                            <p>{$post['conteudo']}</p>
                        ";
                        
                        echo "<p><strong>Tags:</strong> " . implode(', ', $post['tags']) . "</p>";
                        echo "<p><strong>Categoria:</strong>{$post['categoria']}</p>";
                    }
                break;
            }
        }
        else{
            echo "Para fazer um post faça o <a href='/ProjetoBlog/login'>Login</a>";

            foreach($postsAgrupados as $post){
                echo "        
                    <h2>{$post['titulo']}</h2>
                    <h4>{$post['usuario']}</h4>
                    <h6>{$post['datap']}</h6>
                    <p>{$post['conteudo']}</p>
                ";
                
                echo "<p><strong>Tags:</strong> " . implode(', ', $post['tags']) . "</p>";
                echo "<p><strong>Categoria:</strong>{$post['categoria']}</p>";
            }
        }
    ?>
</body>
</html>