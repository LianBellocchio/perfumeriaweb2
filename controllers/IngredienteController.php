<?php
require_once 'models/IngredienteModel.php';

class IngredienteController {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            header('Location: /DivainParfums/login');
            exit();
        }
    }

    public function listar()
    {
        $model = new IngredienteModel();
        $ingredientes = $model->getIngredientes(); // Obtiene todas las categorías desde el modelo
        require 'visual/listadoIngredientes.phtml'; // Muestra la vista con la lista de categorías
    }


    // Método para mostrar el formulario de agregar un ingrediente
    public function agregar()
    {
        require 'visual/adminFormIngrediente.phtml'; // Mostrar el formulario para agregar un ingrediente
    }

    // Método para guardar un nuevo ingrediente
    public function guardar()
    {
        if (isset($_POST['nombre_ingrediente']) && isset($_POST['descripcion'])) {
            $nombre = $_POST['nombre_ingrediente'];
            $descripcion = $_POST['descripcion'];
            $model = new IngredienteModel();
            $model->addIngrediente($nombre, $descripcion);
            header('Location: /DivainParfums/ingrediente'); // Redirigir a la lista de ingredientes después de agregar
            exit();
        }
    }

    // Editar un ingrediente existente
    public function editar() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $model = new IngredienteModel();
            $ingrediente = $model->getIngredienteById($id);
            require 'visual/adminFormIngrediente.phtml';
        }
    }

    // Actualizar un ingrediente existente
    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_ingrediente'], $_POST['nombre_ingrediente'], $_POST['descripcion'])) {
            $id = $_POST['id_ingrediente'];
            $nombre = $_POST['nombre_ingrediente'];
            $descripcion = $_POST['descripcion'];
            $model = new IngredienteModel();
            $model->updateIngrediente($id, $nombre, $descripcion);
            header('Location: /DivainParfums/ingrediente');
            exit();
        } else {
            header('Location: /DivainParfums/ingrediente');
            exit();
        }
    }

    // Eliminar un ingrediente existente
    public function eliminar() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $model = new IngredienteModel();
            $model->deleteIngrediente($id);
            header('Location: /DivainParfums/ingrediente');
            exit();
        }
    }
}
?>
