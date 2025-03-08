<head>
    <title>Crea tu cuenta </title>
</head>
<link rel="Stylesheet" href="assets/create.css">
<h1 class="titulo">Crear  cuenta</h1>
<div class="login-container">
    
    <form action="index.php?controller=user&action=createUser" method="post">
        <Label  for="name">Nombre</Label>
        <input class="caja" type="text" name="nombre" id="nombre" placeholder="Ingrese su nombre" required>
        <div>
        <Label for="name">Apellidos</Label>
        <input class="caja" type="text" name="apellidos" id="apellidos" placeholder="Ingrese sus apellidos" required>
        </div>
        <div>
        <Label for="name">Correo</Label>
        <input  class="caja"type="text" name="correo" id="correo" placeholder="Ingrese su correo" required>
        </div>
        <div>
        <Label for="name">contraseña</Label>
        <input class="caja" type="password" name="contrasena" id="contrasena" placeholder="Ingrese su contraseña" required>
        <br>
        <button class="boton" type="submit">Crear cuenta</button>
        <br>
        <!--en href y action va el?controller pero se agregara mas cosas-->
        <p>¿Ya tienes cuenta?</p>
        <a class="boton2" href="index.php?controller=user&action=login">Inicio de sesion</a>
        </div>

  

    </form>

</div>