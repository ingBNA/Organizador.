<?php require_once 'Views/modulos/listaModulos.php'; ?>
<head>
    <title>Problema de materias</title>
</head>
<link rel="stylesheet" href="assets/moduloMateria.css">
<h2>Alumnos con problemas de materias</h2>
<div class="modulos">
    
    <form action="index.php?controller=materia&action=save" method="POST">
        <div class="nombre">
             <label for="name">Nombre del alumno:</label>
             <input type="text" name="nombre" id="nombre" placeholder="Ingrese el nombre completo del alumno" required>
        </div>
        <div class="materia">
             <label for="matricula">Matrícula:</label>
             <input type="text" name="matricula" id="matricula" placeholder="Ingrese la matrícula" required>
        </div>
        <div clas="grupo">
            <label for="grupo">Grupo:</label>
            <br><input type="text" name="grupo" id ="grupo" placeholder="Ingrese el grupo" required>
        </div>
        <div class="problema">
            <label for="problema">Materia que se le dificulta</label>
            <input type="text" name="problema" id="problema" placeholder="agregue la materia" required> 
        </div>
        <div class="solucion">
            <label for="solucion">solucion</label>
            <input type="text" name="solucion" id="solucion" placeholder="solucion para la materia" required>
        </div>
        <div>
            <button class="guardar" type="submit">Guardar</button>
        </div>


    </form>
</div>