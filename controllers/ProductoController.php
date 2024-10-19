<?php
require_once 'models/ProductoModel.php';
require_once 'config/config.php';
require_once 'models/CategoriaModel.php';
require_once 'models/IngredienteModel.php';
require_once 'models/ProductoIngredienteModel.php';


class ProductoController
{
    private $productoIngredienteModel;

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

        $this->productoIngredienteModel = new ProductoIngredienteModel();
    }

    // Método para ver el detalle de un producto
    public function detalle()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $model = new ProductoModel();
            $producto = $model->getProductoById($id);
            if ($producto) {
                require 'visual/detalleProducto.phtml';
            } else {
                die("Error: El producto no existe.");
            }
        } else {
            die("Error: ID de producto no proporcionado.");
        }
    }


    // Método para listar los productos
    public function listar()
    {
        $model = new ProductoModel();
        $productos = $model->getProductos(); // Llama al modelo para obtener todos los productos
        require 'visual/listadoProductos.phtml'; // Muestra la vista con la lista de productos
    }

    // Acción para mostrar el formulario para agregar un nuevo producto
    public function agregar()
    {
        $categoriaModel = new CategoriaModel();
        $categorias = $categoriaModel->getCategorias();

        $ingredienteModel = new IngredienteModel();
        $ingredientes = $ingredienteModel->getIngredientes();

        require 'visual/adminFormProducto.phtml';
    }


    // Acción para guardar un nuevo producto
    public function guardar()
    {
        if (isset($_POST['nombre_producto'], $_POST['descripcion'], $_POST['precio'], $_POST['id_categoria'])) {
            $nombre = $_POST['nombre_producto'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            $id_categoria = $_POST['id_categoria'];

            $model = new ProductoModel();
            $id_producto = $model->addProducto($nombre, $descripcion, $precio, $id_categoria);

            // Guardar los ingredientes asociados
            $productoIngredienteModel = new ProductoIngredienteModel();
            if (isset($_POST['ingredientes'])) {
                foreach ($_POST['ingredientes'] as $id_ingrediente => $cantidad) {
                    if ($cantidad > 0) {
                        $productoIngredienteModel->addIngredienteAProducto($id_producto, $id_ingrediente, $cantidad);
                    }
                }
            }

            header('Location: /DivainParfums/producto');
            exit();
        }
    }


    // Acción para editar un producto
    public function editar()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Obtener el producto
            $model = new ProductoModel();
            $producto = $model->getProductoById($id);

            // Obtener las categorías para el select
            $categoriaModel = new CategoriaModel();
            $categorias = $categoriaModel->getCategorias();

            // Obtener todos los ingredientes disponibles
            $ingredienteModel = new IngredienteModel();
            $ingredientes = $ingredienteModel->getIngredientes();

            // Obtener los ingredientes asociados al producto
            $productoIngredienteModel = new ProductoIngredienteModel();
            $producto_ingredientes = $productoIngredienteModel->getIngredientesPorProductoId($id);

            // Pasar los datos a la vista
            require 'visual/adminFormProducto.phtml';
        }
    }

    // Acción para actualizar un producto existente
    public function actualizar()
    {
        if (isset($_POST['id_producto'], $_POST['nombre_producto'], $_POST['descripcion'], $_POST['precio'], $_POST['id_categoria'])) {
            $id = $_POST['id_producto'];
            $nombre = $_POST['nombre_producto'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            $id_categoria = $_POST['id_categoria'];

            $model = new ProductoModel();
            $model->updateProducto($id, $nombre, $descripcion, $precio, $id_categoria);

            // Eliminar todos los ingredientes anteriores del producto
            $productoIngredienteModel = new ProductoIngredienteModel();
            $productoIngredienteModel->deleteIngredientesPorProductoId($id);

            // Guardar los nuevos ingredientes asociados
            if (isset($_POST['ingredientes'])) {
                foreach ($_POST['ingredientes'] as $id_ingrediente => $cantidad) {
                    if ($cantidad > 0) {
                        $productoIngredienteModel->addIngredienteAProducto($id, $id_ingrediente, $cantidad);
                    }
                }
            }

            header('Location: /DivainParfums/producto');
            exit();
        }
    }



    public function eliminar()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $model = new ProductoModel();
            $model->deleteProducto($id);
            header('Location: /DivainParfums/producto');
            exit();
        }
    }
}
