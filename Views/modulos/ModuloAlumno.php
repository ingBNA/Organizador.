<?php require_once 'Views/modulos/listaModulos.php'; ?>
<head>
    <title>Alumnos</title>
</head>
<link rel="stylesheet" href="assets/modulos.css">
<h1>Alumnos</h1>
<div class="modulos">

    
    <!-- En action está el controlador para guardar lo solicitado -->
    <form action="index.php?controller=alumno&action=save" id="alumnoForm" method="POST">
        <div class="name">
            <label for="nombre">Alumno</label>
            <input class="name" type="text" name="nombre" id="nombre" placeholder="nombre completo" required> 
        </div>

        <div class="matricula">
            <label for="matricula">Matrícula</label>
            <input class="matricula" type="text" name="matricula" id="matricula" placeholder="Ingrese la matrícula" required>
        </div>

        <div class="group">
            <label for="grupo">Grupo</label>
            <input class="group" type="text" name="grupo" id="grupo" placeholder="Ingrese grupo" required>
        </div>

        <div class="tel">
            <label for="telefono">Número de teléfono</label>
            <input class="tel" type="text" name="telefono" id="telefono" placeholder="Número de teléfono" required>
        </div>

        <div class="tutor">
            <label for="tutor">Nombre del tutor</label>
            <input class="tutor" type="text" name="tutor" id="tutor" placeholder="Nombre del tutor" required>
        </div>

        <div class="telefonoTutor">
            <label for="telefono_tutor">Número de teléfono del tutor</label>
            <input class="telefonoTutor" type="text" name="telefono_tutor" id="telefono_tutor" placeholder="Número de teléfono del tutor" required>
        </div>

        <label class="estado" for="estado">Estado:</label>
        <select id="estado" name="estado">
            <option value="">Seleccione un estado</option>
            <option value="activo">Activo</option>
            <option value="en riesgo">En Riesgo</option>
        </select>
        <br>
         
         <div>
            <button   class="guardar" type="submit">Guardar</button>
        </div>
    </form>
</div>
