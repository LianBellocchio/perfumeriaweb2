<?php
require_once 'config/config.php';

class ProductoModel
{
    private $connection;

    // Constructor para establecer la conexión a la base de datos
    public function __construct()
    {
        $this->connection = connect();
    }

    // Obtener todos los productos
    public function getProductos()
    {
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
    public function getProductoById($id)
    {
        $query = "SELECT p.*, c.nombre_categoria FROM productos p
                  LEFT JOIN categorías c ON p.id_categoria = c.id_categoria
                  WHERE p.id_producto = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Agregar un nuevo producto y devolver el ID generado
    public function addProducto($nombre, $descripcion, $precio, $id_categoria)
    {
        $query = "INSERT INTO productos (nombre_producto, descripcion, precio, id_categoria) VALUES (?, ?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        if (!$stmt) {
            die('Error en prepare: ' . $this->connection->error);
        }
        $stmt->bind_param("ssdi", $nombre, $descripcion, $precio, $id_categoria);
        if ($stmt->execute()) {
            return $this->connection->insert_id;
        } else {
            die('Error en execute: ' . $stmt->error);
        }
    }

    // Actualizar un producto existente
    public function updateProducto($id, $nombre, $descripcion, $precio, $id_categoria)
    {
        $query = "UPDATE productos SET nombre_producto = ?, descripcion = ?, precio = ?, id_categoria = ? WHERE id_producto = ?";
        $stmt = $this->connection->prepare($query);
        if (!$stmt) {
            die('Error en prepare: ' . $this->connection->error);
        }
        $stmt->bind_param("ssdii", $nombre, $descripcion, $precio, $id_categoria, $id);
        if (!$stmt->execute()) {
            die('Error en execute: ' . $stmt->error);
        }
    }

    // Eliminar un producto
    public function deleteProducto($id)
    {
        // Eliminar ingredientes asociados al producto
        $query = "DELETE FROM productos_ingredientes WHERE id_producto = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        // eliminar el producto
        $query = "DELETE FROM productos WHERE id_producto = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
