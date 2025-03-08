<?php require_once 'Views/menu.php' ?>
<?php require_once 'Views/Listas/Listas.php'; ?>
<html>
    <head>
        <title>Problemas de materia </title>
    </head>
    <link rel="stylesheet" href="assets/apoyoSalud.css">
    <body>
        <table >
        <h1>Apoyo y Salud</h1>
        <!--verificar si falta agregar soluciones
        (esta en mente agregarlo o no)-->
        <tr class="tabla">
            
            <th>Nombre</th>
            <th>Matricula</th>
            <th>Grupo</th>
            <th>Enfermedad</th>
            <th>Problema</th>
            <th>Solucion</th>
            <th>Fecha de resgistro</th>
            <th>Acciones</th>
        </tr>
        <?php if(!empty($listaApoyo)): ?>
            <?php foreach ($listaApoyo as $apoyo): ?>
                
            <tr class="principal">
                <td><?php echo $apoyo->getNombre(); ?></td>
                <td><?php echo $apoyo->getMatricula(); ?></td>
                <td><?php echo $apoyo->getGrupo(); ?></td>
                <td><?php echo $apoyo->getEnfermedad();?></td>
                <td><?php echo $apoyo->getAyuda();?></td>
                <td><?php echo $apoyo->getSolucion();?></td>
                <td><?php echo $apoyo->getFechaRegistro(); ?></td>    
                <td>
                    <!--Boton para editar alumno -->
                    <a href="index.php?controller=apoyo&action=updateApoyo&id=<?php echo $apoyo->getId() ?>">editar</a>
                    <!--Boton para Eliminar alumno -->
                    <a href="index.php?controller=apoyo&action=delete&id=<?php echo $apoyo->getId()?> "onclick="return confirm('¿Está seguro que desea eliminar este alumno?');">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else : ?>
                <tr>
                <td colspan="7">No hay alumnos registrados, ingrese en el modulo correspondiente para el registro</td>
                </tr>
                <?php endif; ?>

        </table>
    </body>
</html>