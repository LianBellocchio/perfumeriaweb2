<?php
require_once 'config/config.php';

class ProductoIngredienteModel
{
    private $connection;

    public function __construct()
    {
        $this->connection = connect();
    }

    // Obtener ingredientes por producto ID
    public function getIngredientesPorProductoId($id_producto)
    {
        $query = "SELECT i.*, pi.cantidad FROM productos_ingredientes pi 
                  INNER JOIN ingredientes i ON pi.id_ingrediente = i.id_ingrediente
                  WHERE pi.id_producto = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id_producto);
        $stmt->execute();
        $result = $stmt->get_result();
        $ingredientes = [];
        while ($row = $result->fetch_assoc()) {
            $ingredientes[] = $row;
        }
        return $ingredientes;
    }

    // Agregar un ingrediente a un producto con cantidad específica
    public function addIngredienteAProducto($id_producto, $id_ingrediente, $cantidad)
    {
        $query = "INSERT INTO productos_ingredientes (id_producto, id_ingrediente, cantidad) VALUES (?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("iid", $id_producto, $id_ingrediente, $cantidad);
        $stmt->execute();
    }

    // Actualizar la cantidad de un ingrediente para un producto
    public function updateIngredienteProducto($id_producto, $id_ingrediente, $cantidad)
    {
        $query = "UPDATE productos_ingredientes SET cantidad = ? WHERE id_producto = ? AND id_ingrediente = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("dii", $cantidad, $id_producto, $id_ingrediente);
        $stmt->execute();
    }

    // Eliminar un ingrediente de un producto
    public function deleteIngredienteProducto($id_producto, $id_ingrediente)
    {
        $query = "DELETE FROM productos_ingredientes WHERE id_producto = ? AND id_ingrediente = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ii", $id_producto, $id_ingrediente);
        $stmt->execute();
    }

    // Eliminar todos los ingredientes asociados a un producto
    public function deleteIngredientesPorProductoId($id_producto)
    {
        $query = "DELETE FROM productos_ingredientes WHERE id_producto = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id_producto);
        $stmt->execute();
    }
}
