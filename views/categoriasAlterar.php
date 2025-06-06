<?php 
    require_once "layoutCabecalho.php";
?>
    <form action="#" method="post">

        <h1>Altere uma Categoria</h1>

        <input type="hidden" id="id_categorias" name="id_categorias" value="<?php echo $retorno[0]->id_categorias?>">

        <label for="descritivo">Descritivo:</label>
        <input type="text" id="descritivo" name="descritivo" value="<?php echo $retorno[0]->cdescritivo?>">
        <div><?php echo $msg; ?><div>
        <br><br>

        <input type="submit" value="Criar">
    </form>

<?php 
    require_once "layoutRodape.php";
?>