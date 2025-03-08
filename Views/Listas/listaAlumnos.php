<?php require_once 'Views/menu.php';?>
<?php require_once 'Views/Listas/Listas.php'; ?>
<html>
    <head>
        <title>Lista de alumnos</title>
    </head>
    <link rel="stylesheet" href="assets/listaAlumno.css">

    <h1>Lista de alumnos</h1>
    
        <table >
            <tr class="tabla">
                <th >Nombre</th>
                <th >Matrícula</th>
                <th >Grupo</th>
                <th >Teléfono</th>
                <th >Tutor</th>
                <th >Teléfono del Tutor</th>
                <th>fecha de registro</th>
                <th >estado</th>
                <th >acciones</th>
              
            </tr>
            <!--configuracion para mostrar los datos y aparazcan en tabla -->
            <?php if (!empty($listaAlumnos)): ?>
                <?php foreach ($listaAlumnos as $alumno): ?>
                    <tr class="principal">
                        <td><?php echo $alumno->getNombre(); ?></td>
                        <td><?php echo $alumno->getMatricula(); ?></td>
                        <td><?php echo $alumno->getGrupo(); ?></td>
                        <td><?php echo $alumno->getTelefono(); ?></td>
                        <td><?php echo $alumno->getTutor(); ?></td>
                        <td><?php echo $alumno->getTelefonoTutor(); ?></td>
                        <td><?php echo $alumno->getFechaRegistro(); ?></td>
                        <td class="<?php echo ($alumno->getEstado() == 'activo') ? 'estado-activo' : (($alumno->getEstado() == 'en riesgo') ? 'estado-riesgo' : 'estado-desconocido'); ?>">
                            
                            <?php echo $alumno->getEstado() ? $alumno->getEstado() : 'Sin estado'; ?></td>
                        <td>
                            <!-- Botón para editar alumno -->
                            <a href="index.php?controller=alumno&action=updateAlumno&id=<?php echo $alumno->getId(); ?>">Editar</a>

                            <!-- Botón para eliminar alumno -->
                            <a href="index.php?controller=alumno&action=delete&id=<?php echo $alumno->getId(); ?>" onclick="return confirm('¿Está seguro que desea eliminar este alumno?');">Eliminar</a>
                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="11">No hay alumnos registrados, ingrese en el módulo correspondiente para el registro</td>
                </tr>
            <?php endif; ?>
        </table>
</html>
