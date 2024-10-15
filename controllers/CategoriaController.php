<?php
require_once 'models/CategoriaModel.php';

class CategoriaController
{
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
    

    // Acción para listar las categorías
    public function listar()
    {
        $model = new CategoriaModel();
        $categorias = $model->getCategorias();
        require 'visual/listadoCategorias.phtml';
    }

    // Acción para mostrar el formulario de agregar categoría
    public function agregar()
    {
        require 'visual/adminFormCategoria.phtml';
    }

    // Acción para guardar una nueva categoría
    public function guardar()
    {
        if (isset($_POST['nombre_categoria'])) {
            $nombre = $_POST['nombre_categoria'];
            $model = new CategoriaModel();
            $model->addCategoria($nombre);
            header('Location: index.php?controller=Categoria&action=listar');
        }
    }

    // Acción para editar una categoría
    public function editar()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $model = new CategoriaModel();
            $categoria = $model->getCategoriaById($id);
            require 'visual/adminFormCategoria.phtml';
        }
    }

    // Acción para actualizar una categoría existente
    public function actualizar()
    {
        if (isset($_POST['id_categoria']) && isset($_POST['nombre_categoria'])) {
            $id = $_POST['id_categoria'];
            $nombre = $_POST['nombre_categoria'];
            $model = new CategoriaModel();
            $model->updateCategoria($id, $nombre);
            header('Location: index.php?controller=Categoria&action=listar');
        }
    }

    // Acción para eliminar una categoría
    public function eliminar()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $model = new CategoriaModel();
            $model->deleteCategoria($id);
            header('Location: index.php?controller=Categoria&action=listar');
        }
    }
}
