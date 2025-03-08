<?php require_once 'Views/menu.php'; ?>
<?php if ($results): ?>
    <link rel="stylesheet" href="assets/buscador.css">
    <div class="busca">
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                    <!--Realizamos la buscqueda de cada lista y documento-->
                <?php foreach ($results as $result): ?>
                    <tr>
                        <td>
                            <strong class="texto"><?php echo str_ireplace($query, "<strong>$query</strong>", $result['nombre']); ?></strong>
                        </td>
                    
                        <td>
                                <!--separamos la busqueda por cada categpria para la realizacion de busqueda-->
                            <?php if ($result['type'] === 'alumno'): ?>
                                <strong>Matricula:</strong> <?php echo $result['matricula']; ?><br>
                                <strong>Grupo:</strong> <?php echo $result['grupo']; ?><br>
                                <strong>Telefono:</strong> <?php echo $result['telefono']; ?><br>
                                <strong>tutor:</strong> <?php echo $result['tutor']; ?><br>
                                <strong>Telefono del tutor:</strong> <?php echo $result['telefono_tutor']; ?><br>
                                <strong>Estado:</strong><?php echo $result['estado']; ?><br>
                                <strong>Fecha de registro: </strong><?php echo $result['fecha_registro']?>
                            
                                <?php elseif ($result['type'] === 'maestro'): ?>
                                <strong>Número de Empleado:</strong> <?php echo $result['numero_empleado']; ?><br>
                                <strong>Especialidad:</strong> <?php echo $result['especialidad']; ?><br>
                                <?php elseif ($result['type'] === 'documentos'): ?>
                                <strong>Nombre:</strong> <?php echo $result['nombre']; ?><br>
                               
                            <?php elseif ($result['type'] === 'materia'): ?>
                                <strong>Matricula:</strong> <?php echo $result['matricula']; ?><br>
                                <strong>Grupo:</strong> <?php echo $result['grupo']; ?><br>
                                <strong>Problema:</strong> <?php echo $result['problema']; ?><br>
                                <strong>Solucion:</strong> <?php echo $result['solucion']; ?><br>
                                <strong>fecha de registro: </strong><?php echo $result['fecha_registro'] ?>
                            
                                <?php elseif ($result['type'] === 'apoyo'): ?>
                                <strong>Matricula:</strong> <?php echo $result['matricula']; ?><br>
                                <strong>Grupo:</strong> <?php echo $result['grupo']; ?><br>
                                <strong>Enfermedad:</strong> <?php echo $result['enfermedad']; ?><br>
                                <strong>Problema:</strong> <?php echo $result['ayuda']; ?><br>
                                <strong>Solucion:</strong> <?php echo $result['solucion']; ?><br>
                                <strong>Fecha de registro: </strong><?php echo $result['fecha_registro']; ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($result['type'] === 'alumno'): ?>
                                <a href="index.php?controller=alumno&action=updateAlumno&id=<?php echo $result['id']; ?>">Editar</a> |
                                <a href="index.php?controller=alumno&action=delete&id=<?php echo $result['id']; ?>">Eliminar</a>
                            <?php elseif ($result['type'] === 'maestro'): ?>
                                <a href="index.php?controller=maestro&action=updateMaestro&id=<?php echo $result['id']; ?>">Editar</a> |
                                <a href="index.php?controller=maestro&action=delete&id=<?php echo $result['id']; ?>">Eliminar</a>
                            <?php elseif ($result['type'] === 'documentos'): ?>
                                <a href="index.php?controller=documento&action=descargarDocumento&id_documento=<?php echo urlencode($result['id_documento']); ?>">Descargar</a> |
                                <a href="index.php?controller=documento&action=eliminarDocumento&id_documento=<?php echo $result['id_documento']; ?>">Eliminar</a>
                            <?php elseif ($result['type'] === 'materia'): ?>
                                <a href="index.php?controller=materia&action=updateMateria&id=<?php echo $result['id']; ?>">Editar</a> |
                                <a href="index.php?controller=materia&action=delete&id=<?php echo $result['id']; ?>">Eliminar</a>
                            <?php elseif ($result['type'] === 'apoyo'): ?>
                                <a href="index.php?controller=apoyo&action=updateApoyo&id=<?php echo $result['id']; ?>">Editar</a> |
                                <a href="index.php?controller=apoyo&action=delete&id=<?php echo $result['id']; ?>">Eliminar</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
        <!--En caso de que no haya ningun regisro, mandara el siguiente mensaje -->
<?php else: ?>
    <p>No se encontraron resultados.</p>
<?php endif; ?>