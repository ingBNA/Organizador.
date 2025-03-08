<?php require_once 'Views/menu.php';?>
<link rel="stylesheet" href="assets/updtates.css">
<h2> Actualizacion de apoyo</h2>
<div class="updateApoyo">
    
    <form action="index.php?controller=apoyo&action=update" method="POST">
        <input type="hidden" name="id" value="<?php echo $apoyo->getId(); ?>">

        <div class="alumno">
            <label for="nombre">Nombre del alumno</label><br>
            <input type="text" name="nombre" value="<?php echo $apoyo->getNombre();?>">
        </div>
        <div class="matricula">
            <label for="matricula">Matricula</label>
            <input type="text" name="matricula" value="<?php echo $apoyo->getMatricula();?>"></input>
        </div>
        <div class="grupo">
            <label for="grupo">Grupo</label>
            <input type="text" name="grupo" value="<?php echo $apoyo->getGrupo();?>">
        </div>
        <div class="enfermedad">
            <label for="enfermedad">Enfermedad</label><br>
            <input type="text" name="enfermedad" value="<?php echo $apoyo->getEnfermedad();?>"> 
        </div>
        <div class="problema">
            <label for="ayuda">Problema</label>
            <input type="text" name="ayuda" value="<?php echo $apoyo->getAyuda();?>">
        </div>
        <div class="solucion">
            <label for="solucion">solucion</label>
            <input type="text" name="solucion" value="<?php echo $apoyo->getSolucion();?>">
        </div>
        
           <button type="submit" class="boton"> Actualizar</button> 
        
    </form>
</div>