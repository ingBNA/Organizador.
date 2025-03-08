<html>

<form action="index.php?controller=documento&action=subirDocumento" method="POST" enctype="multipart/form-data">
    <label for="archivo">Seleccione archivo</label>
    <input type="file" name="archivo" id="archivo" required>
    <button type="submit">Subir</button>

</form>
<!--Mostramos el mensaje de exito o error-->
<?php if(!empty($mensaje)): ?>
    <p><?php echo $mensaje; ?></p>
<?php endif; ?>


</html>