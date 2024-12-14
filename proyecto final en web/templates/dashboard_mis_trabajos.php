
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Trabajos</title>
    <link rel="stylesheet" href="../styles/styles.css"> 
</head>
<body>
    <div style="position: relative;">
        <!-- Botones de navegación -->
        <button class="toggle-menu" onclick="toggleMenu()">☰ Menú</button>
        <button class="logout-button" onclick="logout()">Cerrar Sesión</button>
        <button class="inicio-button" onclick="inicio()">Inicio</button>
        <div class="menu" id="menu">
            <h2>Menú</h2>
            <a href="perfil_organizacion.php">Perfil</a>
            <a href="#">Voluntarios</a>
            <a href="dashboard_mis_trabajos.php">Mis Empleos</a>
            <a href="#">Encuesta</a>
            <a href="#">Indicadores de Trabajo</a>
        </div>
    </div>

    <div class="content">
        <h1>Mis Trabajos</h1>
        <div id="trabajos" class="d3sc3">
            <p>Este es el listado de ofertas laborales que has publicado.</p>
        </div>

        <!-- Tabla de trabajos -->
        <table id="tabla-trabajos">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Horario</th>
                    <th>Días</th>
                    <th>Ubicación</th>
                    <th>Estado</th>
                
                 
                </tr>
            </thead>
            <tbody>
                <?php 
              
                include '../php/trabajos_organizacion.php';
                
                ?>
                                     
            </tbody>
        </table>

        <a onclick="openRegisterForm()" class="editar-button">Agregar Trabajo</a>
        <br>
        
        <div class="form-container" id="registerForm" style="display: none;">
            <button class="close-btn" onclick="closeForm('registerForm')">X</button>
            <h2>Agregar Trabajo</h2>

            <form action="../php/registro_trabajo.php" method="POST">

                <div id="registerForm" >
                    <!-- Campos específicos para voluntarios -->
                    <label for="titulo">Titulo:</label>
                    <input type="text" id="titulo" name="titulo">

                    <label for="descripcion">Descripcion:</label>
                    <textarea id="descripcion" name="descripcion"></textarea>

                    <label for="horario">Horario:</label>
                    <input type="text" id="horario" name="horario">

                    <label for="dias">Días:</label>
                    <input type="text" id="dias" name="dias">

                    <label for="ubicacion">Ubicacion:</label>
                    <input type="text" id="ubicacion" name="ubicacion">
                    

                </div>

                <button type="submit" >Registrar</button>

            </form>
        </div>
        <div id="messageContainer" style="display: none;"></div>
    </div>

    <script>
        function toggleMenu() {
            const menu = document.getElementById("menu");
            menu.style.display = (menu.style.display === "none" || menu.style.display === "") ? "block" : "none";
        }

        function logout() {
            window.location.href = "../index.html"; // Redirige al script de cierre de sesión
        }

        function inicio() {
            window.location.href = "dashboard_organizacion.php"; // Redirige al inicio
        }

        function openRegisterForm() {
            document.getElementById('registerForm').style.display = 'block';
        }

        function closeForm(registerForm) {
            document.getElementById(registerForm).style.display = 'none';
        }
          
        function showMessage(message, type) {
            const messageContainer = document.getElementById('messageContainer');
            messageContainer.textContent = message;
            messageContainer.className = type === 'error' ? 'message-container error' : 'message-container success';
            messageContainer.style.display = 'block';

            setTimeout(() => {
                messageContainer.style.display = 'none';
            }, 5000);
        }

        // Mostrar mensajes dinámicos según parámetros en la URL
        const params = new URLSearchParams(window.location.search);
        const error = params.get('error');
        const success = params.get('success');
        if (error) showMessage(error, 'error');
        if (success) showMessage(success, 'success');
    </script>

    <style>

        

        .d3sc3 {
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 20px;
            align-items: center;
            /*margin: 20px;*/
            margin-right: 20px;
            margin-left: 20px;
            text-align: center;
            width: 90%;
        }

        #tabla-trabajos {
            width: 100%; /* Ocupa todo el ancho disponible */
            border-collapse: collapse; /* Elimina espacios entre bordes */
            margin: 20px 0; /* Espaciado vertical */
            font-size: 16px; /* Tamaño de fuente */
            background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco translúcido */
            border: 1px solid #ccc; /* Borde alrededor de la tabla */
            border-radius: 8px; /* Bordes redondeados */
            overflow: hidden; /* Evita que se desborden los bordes */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
            align-items: center;
        }

        /* Encabezado de la tabla */
        #tabla-trabajos th {
            background-color: rgba(0, 0, 0, 0.9); /* Fondo negro translúcido */
            color: white; /* Texto blanco */
            padding: 12px; /* Espaciado interno */
            text-transform: uppercase; /* Texto en mayúsculas */
            font-weight: bold; /* Negrita */
            text-align: center; /* Texto centrado */
            border: 1px solid #ccc; /* Borde de las celdas del encabezado */
        }

        /* Filas de la tabla */
        #tabla-trabajos td {
            padding: 10px; /* Espaciado interno */
            text-align: center; /* Centrar contenido */
            border: 1px solid #ccc; /* Borde de las celdas */
            vertical-align: middle; /* Centrado vertical */
            color: #333; /* Texto oscuro */
        }

        /* Alternar colores para las filas */
        #tabla-trabajos tr:nth-child(even) {
            background-color: rgba(200, 200, 200, 0.3); /* Fondo gris claro translúcido */
        }

        #tabla-trabajos tr:nth-child(odd) {
            background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco translúcido */
        }

        /* Resaltado al pasar el cursor */
        #tabla-trabajos tr:hover {
            background-color: rgba(0, 0, 0, 0.2); /* Fondo negro translúcido */
            cursor: pointer; /* Cambia el cursor a un puntero */
        }

        /* Mensaje cuando no hay datos */
        #tabla-trabajos .no-data {
            text-align: center;
            font-weight: bold;
            color: #c0392b; /* Texto rojo */
            padding: 15px;
        }

    </style>
</body>
</html>
