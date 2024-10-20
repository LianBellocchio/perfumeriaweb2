<?php
require_once 'Model.php';

class ProductoModel extends Model {

    // Obtener todos los productos
    public function getProductos() {
        $query = "SELECT p.*, c.nombre_categoria FROM productos p 
                  LEFT JOIN categorías c ON p.id_categoria = c.id_categoria";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un producto por su ID
    public function getProductoById($id) {
        $query = "SELECT p.*, c.nombre_categoria FROM productos p
                  LEFT JOIN categorías c ON p.id_categoria = c.id_categoria
                  WHERE p.id_producto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Agregar un nuevo producto y devolver el ID generado
    public function addProducto($nombre, $descripcion, $precio, $id_categoria) {
        $query = "INSERT INTO productos (nombre_producto, descripcion, precio, id_categoria) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$nombre, $descripcion, $precio, $id_categoria]);
        return $this->db->lastInsertId();
    }

    // Actualizar un producto existente
    public function updateProducto($id, $nombre, $descripcion, $precio, $id_categoria) {
        $query = "UPDATE productos SET nombre_producto = ?, descripcion = ?, precio = ?, id_categoria = ? WHERE id_producto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$nombre, $descripcion, $precio, $id_categoria, $id]);
    }

    // Eliminar un producto
    public function deleteProducto($id) {
        // Eliminar ingredientes asociados al producto
        $query = "DELETE FROM productos_ingredientes WHERE id_producto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);

        // Eliminar el producto
        $query = "DELETE FROM productos WHERE id_producto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
    }
}
?>
