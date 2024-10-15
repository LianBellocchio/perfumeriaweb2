<?php
session_start();
require_once 'config/config.php';

// Determinar el controlador y la acción a ejecutar
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'Home';
$action = isset($_GET['action']) ? $_GET['action'] : 'mostrarHome';

// Evitar redirecciones infinitas hacia login
if ($controller == 'User' && $action == 'login' && isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: index.php?controller=Producto&action=listar');
    exit();
}

// Manejar el enrutamiento simple para enviar las solicitudes al controlador correspondiente
switch ($controller) {
    case 'Categoria':
        require_once 'controllers/CategoriaController.php';
        $categoriaController = new CategoriaController();
        $categoriaController->$action();
        break;

    case 'Producto':
        require_once 'controllers/ProductoController.php';
        $productoController = new ProductoController();
        $productoController->$action();
        break;

    case 'Ingrediente':
        require_once 'controllers/IngredienteController.php';
        $ingredienteController = new IngredienteController();
        $ingredienteController->$action();
        break;

    case 'Home':
    default:
        // Cargar el controlador de la página principal
        require_once 'controllers/HomeController.php';
        $homeController = new HomeController();
        $homeController->$action();
        break;

    case 'User':
        require_once 'controllers/UserController.php';
        $userController = new UserController();
        $userController->$action();
        break;
}
