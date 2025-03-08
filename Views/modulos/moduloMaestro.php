<?php require_once 'Views/modulos/listaModulos.php';?>
<head>
    <title>Maestros </title>
</head>
<link rel="stylesheet" href="assets/modulos.css">

<h2>Maestros</h2> 
<div class="Maestros">
   
    <form action="index.php?controller=maestro&action=save" id="maestroForm" method="POST">
        <div class="nombre">
        <label for="name">Nombre del docente</label>
        <input class="nombre" type="text" name="nombre" id="nombre" placeholder="Ingrese el nombre del docente">
        </div>
        
        <div class="telefono">
            <label for="name">Numero de telefono</label>
            <input class="telefono" type="text" name="telefono" id="telefono" placeholder="ingrese numero de telefono">
        </div>
        
        <div class="empleado">
            <label for="name">Numero de empleado</label>
            <input class="empleado" type="text" name="numero_empleado" id="numero_empleado" placeholder="ingrese el numero de empleado">
        </div>    
       
        <div class="correo">
            <label for="name">Correo electronico</label>
            <input class="correo" type="text" name="correo" id="correo" placeholder="ingrese correo electronico">
        </div>

        <div class="especialidad">
            <label for="name">Materia especializada</label>
            <input class="especialidad" type="text" name="especialidad" id="especialidad" placeholder="Ingrese materia en que se especializa ">
        </div>
        
        <div>
            <button class="btn" type="submit">Guardar</button>
        </div>
</div>