<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<link rel="stylesheet" href="../styles/styles.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Organizacion</title>
</head>
<body>

    <div style="position: relative;">
        <button class="toggle-menu" onclick="toggleMenu()">☰ Menú</button>
        <button class="logout-button" onclick="logout()">Cerrar Sesión</button>
        <button class="inicio-button" onclick="inicio()">Inicio</button>
        <div class="menu" id="menu">
            <h2>Menú</h2>
            <a href="perfil_voluntario.php" onclick="showContent('organizacion')">Perfil</a>
            <a href= "mostrar_voluntario.php" onclick="showContent('voluntarios')">Voluntarios</a>
            <a href="dashboard_mis_trabajos.php" onclick="showContent('trabajos')">Mis Empleos</a>
            <a href="encuesta_org.php" onclick="showContent('encuesta')">Encuesta</a>
            <a href="#" onclick="showContent('indicadores')">Indicadores de Trabajo</a>
        </div>
    </div>

    <div class="content">
        <div id="voluntarios" class="desc2">
            <h2>Perfil del Organizacion</h2>
            <form action="../php/perfil_organizacion.php" method="post">
                <div class="form-control">
                    <label for="rutEmpresa">RUT:</label>
                    <input type="text" id="rutEmpresa" name="rutEmpresa" value="<?php echo $_SESSION['rutEmpresa'];?>" readonly> </input>
                    <br>
                    <label for="personalidadJuridica">Personalidad Juridica:</label>
                    <input type="text" id="personalidadJuridica" name="personalidadJuridica" value="<?php echo $_SESSION['personalidadJuridica'];?>" readonly> </input>
                    <br>

                    <label for="nombreFantasia">Nombre de Fantasia:</label>
                    <input type="text" id="nombreFantasia" name="nombreFantasia" value="<?php echo $_SESSION['nombreFantasia'] ?>" readonly></input>
                    <br>

                    <label for="descripcion">Descripcion:</label>
                    <textarea id="descripcion" name="descripcion" value="" readonly><?php echo $_SESSION['descripcion'] ?></textarea>
                    <br>

                    <label for="email">Correo electrónico:</label>
                    <input type="email" id="email" name="email" value="<?php echo $_SESSION['email'];?>" readonly>
                    <br>

                    <label for="telefono">Teléfono:</label>
                    <input type="text" id="telefono" name="telefono" value="<?php echo $_SESSION['telefono'];?>" readonly>
                    <br>

                    <label for="personaCargo">Persona a Cargo:</label>
                    <input type="text" id="personaCargo" name="personaCargo" value="<?php echo $_SESSION['personaCargo'];?>" readonly>
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
        window.location.href = "dashboard_organizacion.php";
        // Aquí podrías agregar lógica adicional para manejar la sesión si es necesario.
    }

    function editar() {
        // Redirigir a la página "editar_voluntario.php"
        window.location.href = "editar_organizacion.php";
        // Aquí podrías agregar lógica adicional para manejar la sesión si es necesario.
    }
    </script>

</body>
</html>
