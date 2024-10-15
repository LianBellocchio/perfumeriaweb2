<?php
// Iniciar sesión solo si aún no ha sido iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class UserController {
    // Acción para iniciar sesión
    public function login() {
        // Si el usuario ya está logueado, redirigir a la página principal de productos
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            header('Location: index.php?controller=Producto&action=listar');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Credenciales fijas para el administrador
            if ($username === 'webadmin' && $password === 'admin') {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header('Location: index.php?controller=Producto&action=listar');
                exit();
            } else {
                // Mostrar un mensaje de error si las credenciales son incorrectas
                echo "<p>Usuario o contraseña incorrectos</p>";
                require 'visual/login.phtml';
            }
        } else {
            require 'visual/login.phtml';
        }
    }

    // Acción para cerrar sesión
    public function logout() {
        // Eliminar todas las variables de sesión
        $_SESSION = array();

        // Destruir la sesión
        session_destroy();

        // Redirigir a la página principal
        header('Location: index.php');
        exit();
    }
}
?>
