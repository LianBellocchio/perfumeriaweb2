<?php
require_once 'Model.php';

class CategoriaModel extends Model {

    // Obtener todas las categorías de la base de datos
    public function getCategorias() {
        $query = "SELECT * FROM categorías";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener una categoría por su ID
    public function getCategoriaById($id) {
        $query = "SELECT * FROM categorías WHERE id_categoria = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Agregar una nueva categoría
    public function addCategoria($nombre) {
        $query = "INSERT INTO categorías (nombre_categoria) VALUES (?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$nombre]);
    }

    // Actualizar una categoría existente
    public function updateCategoria($id, $nombre) {
        $query = "UPDATE categorías SET nombre_categoria = ? WHERE id_categoria = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$nombre, $id]);
    }

    // Eliminar una categoría
    public function deleteCategoria($id) {
        $query = "DELETE FROM categorías WHERE id_categoria = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
    }
}
?>
