
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <link rel="stylesheet" href="assets/password.css">
</head>
<body>
    <h2>Cambiar Contraseña</h2>
    <div class="container ">
    <form action="index.php?controller=user&action=cambiarContraseña" method="POST">
         <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />

         <label for="password">Nueva contraseña:</label><br>
         <input type="password" id="password" name="password" required /><br>

         <label for="confirm_password">Confirmar nueva contraseña:</label><br>
         <input type="password" id="confirm_password" name="confirm_password" required />

         <button type="submit">Cambiar contraseña</button>
    
        </form>
        </div>
</body>
</html>
