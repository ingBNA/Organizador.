<?php require_once 'Views/modulos/listaModulos.php';?>

<head>
    <title>Apoyo y salud</title>
</head>
<link rel="stylesheet" href="assets/moduloMateria.css">

<h2>Apoyo y salud</h2>
<div class="ApoyoSalud">

    <form action="index.php?controller=apoyo&action=save" method="POST">
        <div class="nombre">
            <label for="nombre">Nombre del alumno</label>
            <input type="text" name="nombre" id="nombre" placeholder="ingrese el nombre">
        </div>
        <div class="matricula">
            <label for="matricula">Matricula</label>
            <br><input type="text" name="matricula" id="matricula" placeholder="Ingrese la matricula">
        </div>
        <div class="grupo">
            <label for="grupo">Grupo</label>
            <input type="text" name="grupo" id="grupo" placeholder="ingrese grupo">  
        </div>
        <div class="enfermedad">
            <label for="enfermedad">enfermedad</label>
            <br><textarea name="enfermedad" id="enfermedad" rows="5" cols="30"  placeholder="Describa la enfermedad"></textarea>
        </div>
        <div class="problema">
            <label for="ayuda">Problema</label>
            <textarea name="ayuda" id="ayuda" rows="5" cols="30" max-height: 130px max-width: 500px placeholder="Describa el problema que tiene"></textarea>
        </div> 
        <div class="solucion">
            <label for="solucion">Solucion</label>
            <textarea name="solucion" id="solucion" rows="5"  placeholder="Ingrese la solucion hacia el problema u enfermededad"></textarea>
        </div>
        <div>
            <button type="submit">Guardar</button>
        </div>

    </form>

</div>