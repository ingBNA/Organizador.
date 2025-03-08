<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <title>Iniciar sesion</title>
    </head>
        <!--link para el css -->
        <meta charset="UTF-8">
        <link rel="Stylesheet" href="assets/Styles.css">
        <body>
            <header>
                <h1 class="">Psicopedagogia</h1>
            </header>
        
        <div class="login-container">

          
         <form action="index.php?controller=user&action=login"  method="post" >
            <img src="">
            <label class="" for="correo">Correo</label>
            <br>
            <input class="caja"  type="email" name="correo" id="correo" required>
            <br>
            <label class="" for="contrasena">contraseña</label>
            <br>
            <input class="caja" type="password" name="contrasena" id="contrasena" required>
            <br>
            <br>
            <button class="boton" type="submit">Iniciar sesión</button>
         </form>

        
         <a class="" href="index.php?controller=user&action=restablecerContraseña ">¿olvidaste tu contraseña?</a>

         <p>¿No tienes cuenta?</p>
         <a class="boton2" href="index.php?controller=user&action=createUser">Crear cuenta</a>
    
        </div>
    </body>
    </html>