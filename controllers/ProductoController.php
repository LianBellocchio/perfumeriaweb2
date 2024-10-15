<?php
require_once 'models/ProductoModel.php';
require_once 'models/CategoriaModel.php';

class ProductoController {
    
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
    

    // Acción para listar los productos
    public function listar() {
        $model = new ProductoModel();
        $productos = $model->getProductos();
        require 'visual/listadoProductos.phtml';
    }

    // Acción para mostrar el detalle de un producto
    public function detalle() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $model = new ProductoModel();
            $producto = $model->getProductoById($id);
            require 'visual/detalleProducto.phtml';
        }
    }

    // Acción para mostrar el formulario para agregar un nuevo producto
    public function agregar() {
        $categoriaModel = new CategoriaModel();
        $categorias = $categoriaModel->getCategorias(); // Necesitamos las categorías para el select
        require 'visual/adminFormProducto.phtml';
    }

    // Acción para guardar un nuevo producto
    public function guardar() {
        if (isset($_POST['nombre_producto'], $_POST['descripcion'], $_POST['precio'], $_POST['id_categoria'])) {
            $nombre = $_POST['nombre_producto'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            $id_categoria = $_POST['id_categoria'];

            $model = new ProductoModel();
            $model->addProducto($nombre, $descripcion, $precio, $id_categoria);
            header('Location: index.php?controller=Producto&action=listar');
        }
    }

    // Acción para editar un producto
    public function editar() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $model = new ProductoModel();
            $producto = $model->getProductoById($id);
            $categoriaModel = new CategoriaModel();
            $categorias = $categoriaModel->getCategorias();
            require 'visual/adminFormProducto.phtml';
        }
    }

    // Acción para actualizar un producto
    public function actualizar() {
        if (isset($_POST['id_producto'], $_POST['nombre_producto'], $_POST['descripcion'], $_POST['precio'], $_POST['id_categoria'])) {
            $id = $_POST['id_producto'];
            $nombre = $_POST['nombre_producto'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            $id_categoria = $_POST['id_categoria'];

            $model = new ProductoModel();
            $model->updateProducto($id, $nombre, $descripcion, $precio, $id_categoria);
            header('Location: index.php?controller=Producto&action=listar');
        }
    }

    // Acción para eliminar un producto
    public function eliminar() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $model = new ProductoModel();
            $model->deleteProducto($id);
            header('Location: index.php?controller=Producto&action=listar');
        }
    }
    public function mostrarHome() {
        $model = new ProductoModel();
        $productos = $model->getProductos();
        require 'visual/home.phtml';
    }
    
}
?>
