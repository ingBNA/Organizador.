<?php require_once 'Views/menu.php';?>
<link rel="stylesheet" href="assets/updtates.css">
<h2>Actualizacion de la materia</h2>

<div class="materiasUpdate">
    
    <form action="index.php?controller=materia&action=update" method="POST">
    <input type="hidden" name="id" value="<?php echo $materia->getId(); ?>" >  
         <div class="nombre">
            <label for="nombre">Nombre del alumno</label>
            <input type="text" name="nombre"  value="<?php echo $materia->getNombre(); ?>">
         </div>
        
         <div class="matricula">
            <label for="Matricula">Matricula</label>
            <input type="text" name="matricula" id="matricula" value="<?php echo $materia->getMatricula(); ?>">
         </div>
        
         <div class="grupo">
            <label for ="grupo">Grupo</label>
            <input type="text" name="grupo" id="grupo" value="<?php echo $materia->getGrupo(); ?>">
        </div>
        
        <div class="problema">
            <label for="problema">Materia</label>
            <input type="text" name="problema" id="problema" value="<?php echo $materia->getProblema();?>">
        </div>
        
        <div class="solucion">
            <label for="solucion">solucion hacia la materia</label>
            <input type="text" name="solucion" id="solucion" value="<?php echo $materia->getSolucion();?>">
        
        </div>

         <button type="submit" class="boton">Actualizar</button>
    </form>
</div>