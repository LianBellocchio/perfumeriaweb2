<?php
require_once 'models/CategoriaModel.php';

class CategoriaController
{
    // Constructor para verificar si el usuario está autenticado
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            header('Location: /DivainParfums/login');
            exit();
        }
    }

    // Método para listar las categorías
    public function listar()
    {
        $model = new CategoriaModel();
        $categorias = $model->getCategorias(); // Obtiene todas las categorías desde el modelo
        require 'visual/listadoCategorias.phtml'; // Muestra la vista con la lista de categorías
    }


    // Método para mostrar el formulario de agregar una categoría
    public function agregar()
    {
        require 'visual/adminFormCategoria.phtml'; // Mostrar el formulario para agregar una categoría
    }

    // Método para guardar una nueva categoría
    public function guardar()
    {
        if (isset($_POST['nombre_categoria'])) {
            $nombre = $_POST['nombre_categoria'];
            $model = new CategoriaModel();
            $model->addCategoria($nombre);
             // Redirigir a la lista de categorías después de agregar
            header('Location: /DivainParfums/categoria');
            exit();
        }
    }

    // Editar una categoría existente
    public function editar() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $model = new CategoriaModel();
            $categoria = $model->getCategoriaById($id);
            require 'visual/adminFormCategoria.phtml';
        }
    }

    // Actualizar una categoría existente
    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_categoria'], $_POST['nombre_categoria'])) {
            $id = $_POST['id_categoria'];
            $nombre = $_POST['nombre_categoria'];
            $model = new CategoriaModel();
            $model->updateCategoria($id, $nombre);
            header('Location: /DivainParfums/categoria');
            exit();
        } else {
            header('Location: /DivainParfums/categoria');
            exit();
        }
    }

    // Eliminar una categoría existente
    public function eliminar() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $model = new CategoriaModel();
            $model->deleteCategoria($id);
            header('Location: /DivainParfums/categoria');
            exit();
        }
    }
}
