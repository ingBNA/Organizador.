<?php require_once 'Views/menu.php'; ?>
<link rel="stylesheet" href="assets/modulos.css">

<h2>Actualizacion del Maestro</h2>

<div class="updateMaestro">

    <form action="index.php?controller=maestro&action=Update" method="POST">
        <input type="hidden" name="id" value="<?php echo $maestro->getId(); ?>" >

        <div class="docente">
            <label for="nombre"> Nombre del docente </label>
            <input type="text" name="nombre" id="nombre" value="<?php echo $maestro->getNombre(); ?>">
        </div>

        <div class="telefonoDocente">
            <label for="name">Numero de telefono</label>
            <input type="text" name="telefono" id="telefono" value="<?php echo $maestro->getTelefono(); ?>">
        </div>
        
        <div class="numeroEmpleado">
            <label for="text">Numero de empleado</label>
            <input type="text" name="numero_empleado" id="numero_empleado" value="<?php echo $maestro->getNumeroEmpleado();?>">
        </div>

        <div class="correo">
            <label for="text">Correo electronico</label>
            <input type="text" name="correo" id="correo" value="<?php echo $maestro->getCorreo(); ?>">
        </div>

        <div class="materiaEspecializada">
            <label for="name">Materia Especializada</label>
            <input type="text" name="especialidad" id="correo" value="<?php echo $maestro->getEspecialidad(); ?>">
        </div>
            <button type="submit" class="botonMaestro">Actualizar</button>
    </form>
</div>