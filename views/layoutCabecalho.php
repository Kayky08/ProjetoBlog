<?php 
    if(!isset($_SESSION)) session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./src/output.css" rel="stylesheet">
    <title>Entre Linhas e Telas</title>
</head>
<body class="bg-gray-100 p-6 font-mono" >

    <h1 class="text-green-400 text-7xl font-bold mb-4 text-center">Entre Linhas e Telas</h1>

    <?php
        if(!empty($_SESSION['id_usuarios'])){

            switch($_SESSION['tipo']){
                case "administrador":
                    echo "
                    <ul class='flex justify-center gap-10 mt-10'>
                    <li><a class='hover:bg-green-400 hover:text-white font-bold transition h-10 p-2 rounded-2xl' href='/ProjetoBlog/'>Posts</a></li>
                        <li><a class='hover:bg-green-400 hover:text-white font-bold transition h-10 p-2 rounded-2xl' href='/ProjetoBlog/listarUsuarios'>Usuarios</a></li>
                        <li><a class='hover:bg-green-400 hover:text-white font-bold transition h-10 p-2 rounded-2xl' href='/ProjetoBlog/listarCategorias'>Categorias</a></li>
                        <li><a class='hover:bg-green-400 hover:text-white font-bold transition h-10 p-2 rounded-2xl' href='/ProjetoBlog/alterarUsuarios?id={$_SESSION['id_usuarios']}'>Editar perfil</a></li>
                        <li><a class='hover:bg-red-400 hover:text-white font-bold transition h-10 p-2 rounded-2xl' href='/ProjetoBlog/logout'>Logout</a></li>
                    </ul>
                    ";
                break;

                case "comum":
                    echo "
                        <ul class='flex justify-center gap-10 mt-10'>
                            <li><a class='hover:bg-green-400 hover:text-white font-bold transition h-10 p-2 rounded-2xl' href='/ProjetoBlog/alterarUsuarios?id={$_SESSION['id_usuarios']}'>Editar perfil</a></li>
                            <li><a class='hover:bg-red-400 hover:text-white font-bold transition h-10 p-2 rounded-2xl' href='/ProjetoBlog/logout'>Logout</a></li>
                        </ul>
                    ";
                break;
            }
        }
        else{
            echo "<div ><a class='hover:bg-green-300 flex justify-center mx-auto mb-10 mt-10 align-middle w-100 rounded-2xl p-5 bg-green-400 text-white' href='/ProjetoBlog/login'>Para fazer um post faça o Login</a></div>";
        }
    ?>