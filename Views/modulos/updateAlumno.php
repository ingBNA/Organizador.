<?php require_once 'Views/menu.php'?>
<link rel="stylesheet" href="assets/modulos.css">
<h2>Actualizacion del alumno</h2>
<div class="update">

    
        <!--verificar en alumnoController o index si arroja error-->
    <form action="index.php?controller=alumno&action=update" method="POST">
    <input type="hidden" name="id" value="<?php echo $alumno->getId(); ?>" >    
    <div class="alumno">
            <label for="nombre">Nombre del alumno</label><br>
            <input type="text" name="nombre"  value="<?php echo $alumno->getNombre(); ?>">
         </div>
        
         <div class="numeroAlumno">
            <label for="Matricula">Matricula</label>
            <input type="text" name="matricula" id="matricula" value="<?php echo $alumno->getMatricula(); ?>">
         </div>
        <div class="grupo ">
            <label for ="grupo">Grupo</label>
            <input type="text" name="grupo" id="grupo" value="<?php echo $alumno->getGrupo(); ?>">
        </div>
         <div class="telefono">
            <label for="telefono">Numero de telefono</label>
            <input type="text" name="telefono" id="telefono" value="<?php echo $alumno->getTelefono(); ?>">
         </div>
        
         <div class="nombreTutor">
            <label for="tutor">Nombre del tutor</label>
            <input type="text" name="tutor" id="tutor" value="<?php echo $alumno->getTutor(); ?>">
         </div>
        
         <div class="numeroTelefono">
            <label for="telefono_tutor">Numero de telefono del tutor</label>
            <input type="text" name="telefono_tutor" id="telefono_tutor" value="<?php echo $alumno->getTelefonoTutor(); ?>">
         </div>

         <label for="estado">Estado:</label>
        <select id="estado" name="estado">
            <option value="">Seleccione un estado</option>
            <option value="activo">Activo</option>
            <option value="en riesgo">En Riesgo</option>
        </select><br><br>
      
         <button type="submit" class="btn btn-primary">Actualizar</button>
     </form>
</div>