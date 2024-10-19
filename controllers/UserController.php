<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class UserController {
    // Iniciar sesión
    public function login() {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            header('Location: /DivainParfums/producto');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($username === 'webadmin' && $password === 'admin') {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header('Location: /DivainParfums/producto');
                exit();
            } else {
                echo "<p>Usuario o contraseña incorrectos</p>";
                require 'visual/login.phtml';
            }
        } else {
            require 'visual/login.phtml';
        }
    }

    // Cerrar sesión
    public function logout() {
        $_SESSION = array();
        session_destroy();
        header('Location: /DivainParfums/inicio');
        exit();
    }
}
?>
