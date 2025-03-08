<?php require_once 'Views/menu.php'; ?>
<link rel="stylesheet" href="assets/documentos.css">

    <h2>Lista de Documentos</h2>
    
    <form action="index.php?controller=documento&action=subirDocumento" method="POST" enctype="multipart/form-data">

        <input class="archivo" type="file" name="archivo">
        <button class="archivo" type="submit">Subir Documento</button>
    </form>

    <?php if(!empty($documentos)): ?>
        <ul>
            <?php foreach ($documentos as $documento):?>
                
                <li class="desktop">
                    
                    <strong>Nombre:</strong><?php echo htmlspecialchars($documento['nombre']); ?><br>
                    <a href="index.php?controller=documento&action=descargarDocumento&id_documento=<?php echo urlencode($documento['id_documento']); ?>">Descargar</a>
                    <a href="index.php?controller=documento&action=eliminarDocumento&id_documento=<?php echo $documento['id_documento']; ?>">Eliminar</a>
                    
                </li>
                
                <?php endforeach; ?>
        </ul>
        <?php else: ?>
            <p>No hay documentos disponibles.</p>
        <?php endif; ?>

