<?php
require_once 'config/config.php';

class ProductoModel {
    private $connection;

    // Constructor para establecer la conexión a la base de datos
    public function __construct() {
        $this->connection = connect();
    }

    // Obtener todos los productos
    public function getProductos() {
        $query = "SELECT p.*, c.nombre_categoria FROM productos p 
                  LEFT JOIN categorías c ON p.id_categoria = c.id_categoria";
        $result = $this->connection->query($query);
        $productos = [];
        while ($row = $result->fetch_assoc()) {
            $productos[] = $row;
        }
        return $productos;
    }

    // Obtener un producto por su ID
    public function getProductoById($id) {
        $query = "SELECT * FROM productos WHERE id_producto = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Agregar un nuevo producto
    public function addProducto($nombre, $descripcion, $precio, $id_categoria) {
        $query = "INSERT INTO productos (nombre_producto, descripcion, precio, id_categoria) VALUES (?, ?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ssdi", $nombre, $descripcion, $precio, $id_categoria);
        $stmt->execute();
    }

    // Actualizar un producto existente
    public function updateProducto($id, $nombre, $descripcion, $precio, $id_categoria) {
        $query = "UPDATE productos SET nombre_producto = ?, descripcion = ?, precio = ?, id_categoria = ? WHERE id_producto = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ssdii", $nombre, $descripcion, $precio, $id_categoria, $id);
        $stmt->execute();
    }

    // Eliminar un producto
    public function deleteProducto($id) {
        $query = "DELETE FROM productos WHERE id_producto = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
?>
