<head>
    <title>Modulos </title>
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<link rel="stylesheet" href="assets/listas.css">

<form class="buscador" action="index.php?controller=search&action=search" method="POST">
        <input class="linea" type="text" name="query" placeholder="Buscar por nombre">
        <button class="boton" type="submit">Buscar</button>
    </form>

<ul class="menu-container" id="menu-container" class="nav">
        <li><a href="index.php?controller=user&action=home"><i class="fas fa-home"></i> Inicio</a></li>
        <li><a href="index.php?controller=user&action=listaModulos"><i class="fas fa-edit"></i> Módulos</a></li>
        <li><a href="index.php?controller=user&action=Listas"><i class="fas fa-th-list"></i> Listas</a></li>
        <li><a href="index.php?controller=documento&action=listarDocumento"><i class="fas fa-file-alt"></i> Documentos</a></li>
        <li><a href="index.php?controller=estadistica&action=seleccionarReporte"><i class="fas fa-chart-line"></i> Estadística</a></li>
        <li><a href="index.php?controller=user&action=login"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a></li>
    </ul>
<div>
    <ul class="nav">
        <li class="nav-item" >
            <a class="nav-link" href="index.php?controller=maestro&action=ModuloMaestro">Modulo de profesores</a>
        </li>
        <li class="nav-item" >
            <a class="nav-link" href="index.php?controller=alumno&action=ModuloAlumno">Modulo de alumnos</a>
        </li>
        <li class ="nav-item">
            <a class="nav-link" href="index.php?controller=materia&action=ModuloMateria">Modulo de materia</a>
        </li>
        <li>
            <a class="nav-link" href="index.php?controller=apoyo&action=ModuloApoyo">Modulo de Apoyo y salud</a>
        </li>
    </ul>
</div>