<!--RestablecerContraseña-->
<title>cambio de contraseña</title>
</head>
<link rel="Stylesheet" href="assets/password.css">
<h1 class="titulo">Crear  cuenta</h1>
<div class="container">
<form action="index.php?controller=user&action=procesarRestablecimiento" method="POST">
    <label class ="" for="email">Introduce tu correo electronico:</label>
    <input class="caja"type="email" id="email" name="correo" required>
    <button class="boton" type="submit">Enviar instrucciones</button>
</form>
</div>