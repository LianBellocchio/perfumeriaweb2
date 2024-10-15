<?php
require_once 'models/IngredienteModel.php';

class IngredienteController {
    // Constructor para verificar si el usuario está autenticado
    public function __construct() {
        // Verificar si la sesión no está activa antes de iniciarla
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            header('Location: index.php?controller=User&action=login');
            exit();
        }
    }
    

    // Acción para listar los ingredientes
    public function listar() {
        $model = new IngredienteModel();
        $ingredientes = $model->getIngredientes();
        require 'visual/listadoIngredientes.phtml';
    }

    // Acción para mostrar el formulario para agregar un nuevo ingrediente
    public function agregar() {
        require 'visual/adminFormIngrediente.phtml';
    }

    // Acción para guardar un nuevo ingrediente
    public function guardar() {
        if (isset($_POST['nombre_ingrediente'], $_POST['descripcion'])) {
            $nombre = $_POST['nombre_ingrediente'];
            $descripcion = $_POST['descripcion'];

            $model = new IngredienteModel();
            $model->addIngrediente($nombre, $descripcion);
            header('Location: index.php?controller=Ingrediente&action=listar');
        }
    }

    // Acción para editar un ingrediente
    public function editar() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $model = new IngredienteModel();
            $ingrediente = $model->getIngredienteById($id);
            require 'visual/adminFormIngrediente.phtml';
        }
    }

    // Acción para actualizar un ingrediente
    public function actualizar() {
        if (isset($_POST['id_ingrediente'], $_POST['nombre_ingrediente'], $_POST['descripcion'])) {
            $id = $_POST['id_ingrediente'];
            $nombre = $_POST['nombre_ingrediente'];
            $descripcion = $_POST['descripcion'];

            $model = new IngredienteModel();
            $model->updateIngrediente($id, $nombre, $descripcion);
            header('Location: index.php?controller=Ingrediente&action=listar');
        }
    }

    // Acción para eliminar un ingrediente
    public function eliminar() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $model = new IngredienteModel();
            $model->deleteIngrediente($id);
            header('Location: index.php?controller=Ingrediente&action=listar');
        }
    }
}
?>
