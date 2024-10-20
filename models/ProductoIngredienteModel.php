<?php
require_once 'Model.php';

class ProductoIngredienteModel extends Model {

    // Obtener ingredientes por producto ID
    public function getIngredientesPorProductoId($id_producto) {
        $query = "SELECT i.*, pi.cantidad FROM productos_ingredientes pi 
                  INNER JOIN ingredientes i ON pi.id_ingrediente = i.id_ingrediente
                  WHERE pi.id_producto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id_producto]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Agregar un ingrediente a un producto con cantidad específica
    public function addIngredienteAProducto($id_producto, $id_ingrediente, $cantidad) {
        $query = "INSERT INTO productos_ingredientes (id_producto, id_ingrediente, cantidad) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id_producto, $id_ingrediente, $cantidad]);
    }

    // Actualizar la cantidad de un ingrediente para un producto
    public function updateIngredienteProducto($id_producto, $id_ingrediente, $cantidad) {
        $query = "UPDATE productos_ingredientes SET cantidad = ? WHERE id_producto = ? AND id_ingrediente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$cantidad, $id_producto, $id_ingrediente]);
    }

    // Eliminar un ingrediente de un producto
    public function deleteIngredienteProducto($id_producto, $id_ingrediente) {
        $query = "DELETE FROM productos_ingredientes WHERE id_producto = ? AND id_ingrediente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id_producto, $id_ingrediente]);
    }

    // Eliminar todos los ingredientes asociados a un producto
    public function deleteIngredientesPorProductoId($id_producto) {
        $query = "DELETE FROM productos_ingredientes WHERE id_producto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id_producto]);
    }
}
?>
