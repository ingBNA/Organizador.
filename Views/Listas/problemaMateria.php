<?php require_once 'Views/menu.php' ?>
<?php require_once 'Views/Listas/Listas.php'; ?>
<html>
    <head>
        <title>Problemas de materia </title>
    </head>
    <link rel="stylesheet" href="assets/materia.css">
    <body>
        <table>
        <h2>Problemas de materia</h2>
        <!--verificar si falta agregar soluciones
        (esta en mente agregarlo o no)-->
        <tr class="tabla">
            <th>Nombre</th>
            <th>Matricula</th>
            <th>Grupo</th>
            <th>Materia</th>
            <th>Descripcion</th>
            <th>Fecha de registro</th>
            <th>Acciones</th>
        </tr>
        <?php if(!empty($problemaMaterias)): ?>
            <?php foreach ($problemaMaterias as $materia): ?>
                
            <tr class="principal">
                <td><?php echo $materia->getNombre(); ?></td>
                <td><?php echo $materia->getMatricula(); ?></td>
                <td><?php echo $materia->getGrupo(); ?></td>
                <td><?php echo $materia->getProblema(); ?></td>
                <td><?php echo $materia->getSolucion();?></td>
                <td><?php echo $materia->getFechaRegistro();?> </td>
                <td>
                    <!--Boton para editar alumno -->
                    <a href="index.php?controller=materia&action=updateMateria&id=<?php echo $materia->getId(); ?>">Editar</a>
                    <!--Boton para Eliminar alumno -->
                    <a href="index.php?controller=materia&action=delete&id=<?php echo $materia->getId(); ?>  "onclick="return confirm('¿Está seguro que desea eliminar este alumno?');">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else : ?>
                <tr>
                <td colspan="7">No hay alumnos registrados, ingrese en el modulo problema materia para el registro</td>
                </tr>
                <?php endif; ?>

        </>
    </body>
</html>