<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="assets/menu.css">
    <title>psicopedagogia</title>
</head>
<body>
    <!-- Buscador -->
    <form class="buscador" action="index.php?controller=search&action=search" method="POST">
        <input class="linea" type="text" name="query" placeholder="Buscar por nombre">
        <button class="boton" type="submit">Buscar</button>
    </form>

    <!--barra lateral,implementamos el href para conectar con el index -->
    <ul id="menu-container" class="nav">
        <li><a href="index.php?controller=user&action=home"><i class="fas fa-home"></i> Inicio</a></li>
        <li><a href="index.php?controller=user&action=listaModulos"><i class="fas fa-edit"></i> Módulos</a></li>
        <li><a href="index.php?controller=user&action=Listas"><i class="fas fa-th-list"></i> Listas</a></li>
        <li><a href="index.php?controller=documento&action=listarDocumento"><i class="fas fa-file-alt"></i> Documentos</a></li>
        <li><a href="index.php?controller=estadistica&action=seleccionarReporte"><i class="fas fa-chart-line"></i> Estadística</a></li>
        <li><a href="index.php?controller=user&action=login"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a></li>
    </ul>

    <!-- Contenido principal -->
    <div class="content">
       
    </div>
</body>
</html>
