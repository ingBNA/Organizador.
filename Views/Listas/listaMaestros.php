<?php require_once 'Views/menu.php'?>
<?php require_once 'Views/Listas/Listas.php';?>
<head>
    <title>Lista de maestros </title>
</head>
<link rel="stylesheet" href="assets/listaMaestro.css">
<body>
    <table >
        <h1>Lista de maestros</h1>

        <tr class="tabla">
            <th>id</th>
            <th>Nombre</th>
            <th>Numero de telefono</th>
            <th>Numero de empleado</th>
            <th>Correo</th>
            <th>Materia especializada</th>
            <th>Acciones </th>
        </tr>
            <?php if(!empty($listaMaestros)): ?>
                <?php foreach($listaMaestros as $maestro): ?>
                    <tr class="principal">
                        <td><?php echo $maestro->getId(); ?></td>
                        <td><?php echo $maestro->getNombre(); ?></td>
                        <td><?php echo $maestro->getTelefono(); ?></td>
                        <td><?php echo $maestro->getNumeroEmpleado(); ?></td>
                        <td> <?php echo $maestro->getCorreo(); ?></td>
                        <td><?php echo $maestro->getEspecialidad();?></td>
                        <td>
                                 <!--Aqui va el primer php-->
                            <a href="index.php?controller=maestro&action=updateMaestro&id=<?php echo $maestro->getId() ?>">editar</a>
                                 <!--Aqui va el segundo php-->
                            <a href="index.php?controller=maestro&action=delete&id=<?php echo $maestro->getId()?>">eliminar</a>
                        </td>
                    </tr>
        <?php endforeach ; ?>
        <?php else: ?>
            <tr>
                <!--Dara mensaje en caso de que no se encuentre registrado ningun dato-->
                <td colspan="7">No hay maestros registrados, ingrese en el modulo correspondiente para el registro</td>
            </tr>
            <?php endif; ?>
    </table>
</body>