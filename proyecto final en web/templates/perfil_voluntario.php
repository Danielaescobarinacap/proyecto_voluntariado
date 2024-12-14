<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<link rel="stylesheet" href="../styles/styles.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Voluntario</title>
</head>
<body>

    <div style="position: relative;">
        <button class="toggle-menu" onclick="toggleMenu()">☰ Menú</button>
        <button class="logout-button" onclick="logout()">Cerrar Sesión</button>
        <button class="inicio-button" onclick="inicio()">Inicio</button>
        <div class="menu" id="menu">
            <h2>Menú</h2>
            <a href="perfil_voluntario.php" onclick="showContent('voluntarios')">Perfil</a>
            <a href="mostrar_trabajos.php" onclick="showContent('trabajos')">Trabajos Disponibles</a>
            <a href="encuesta_vol.php" onclick="showContent('encuesta')">Encuesta</a>
            <a href="#" onclick="showContent('indicadores')">Indicadores de Trabajo</a>
        </div>
    </div>

    <div class="content">
        <div id="voluntarios" class="desc2">
            <h2>Perfil del Voluntario</h2>
            <form action="../php/perfil_voluntario.php" method="post">
                <div class="form-control">
                    <label for="rut">RUT:</label>
                    <input type="text" id="rut" name="rut" value="<?php echo $_SESSION['rut'];?>" readonly> </input>
                    <br>
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $_SESSION['nombre'];?>" readonly> </input>
                    <br>

                    <label for="apellido">Apellido:</label>
                    <input type="text" id="apellido" name="apellido" value="<?php echo $_SESSION['apellido'] ?>" readonly></input>
                    <br>

                    <label for="email">Correo electrónico:</label>
                    <input type="email" id="email" name="email" value="<?php echo $_SESSION['email'];?>" readonly>
                    <br>

                    <label for="telefono">Teléfono:</label>
                    <input type="text" id="telefono" name="telefono" value="<?php echo $_SESSION['telefono'];?>" readonly>
                    <br>

                    <label for="habilidades">Habilidades:</label>
                    <textarea id="habilidades" name="habilidades" readonly><?php echo $_SESSION['habilidades'];?></textarea>
                    <br>

                    <label for="direccion">Dirección:</label>
                    <input type="text" id="direccion" name="direccion" value="<?php echo $_SESSION['direccion'];?>" readonly>
                    <br>
                </div>
            </form>   

            <button class="editar-button" onclick="editar()">Editar</button>
           
            
        </div>
        
      
       
    </div>

    <script>
        function toggleMenu() {
            var menu = document.getElementById("menu");
            menu.style.display = (menu.style.display === "none" || menu.style.display === "") ? "block" : "none";
        }


        function logout() {
          // Redirigir a la página "index.html"
          window.location.href = "../index.html";
          // Aquí podrías agregar lógica adicional para manejar la sesión si es necesario.
      }

      function inicio() {
        // Redirigir a la página "index.html"
        window.location.href = "dashboard_voluntario.php";
        // Aquí podrías agregar lógica adicional para manejar la sesión si es necesario.
    }

    function editar() {
        // Redirigir a la página "editar_voluntario.php"
        window.location.href = "editar_voluntario.php";
        // Aquí podrías agregar lógica adicional para manejar la sesión si es necesario.
    }
    </script>

</body>
</html>

