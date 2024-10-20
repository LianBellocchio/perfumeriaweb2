<?php
require_once 'Model.php';

class IngredienteModel extends Model {

    // Obtener todos los ingredientes
    public function getIngredientes() {
        $query = "SELECT * FROM ingredientes";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un ingrediente por su ID
    public function getIngredienteById($id) {
        $query = "SELECT * FROM ingredientes WHERE id_ingrediente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Agregar un nuevo ingrediente
    public function addIngrediente($nombre, $descripcion) {
        $query = "INSERT INTO ingredientes (nombre_ingrediente, descripcion) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$nombre, $descripcion]);
    }

    // Actualizar un ingrediente existente
    public function updateIngrediente($id, $nombre, $descripcion) {
        $query = "UPDATE ingredientes SET nombre_ingrediente = ?, descripcion = ? WHERE id_ingrediente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$nombre, $descripcion, $id]);
    }

    // Eliminar un ingrediente
    public function deleteIngrediente($id) {
        $query = "DELETE FROM ingredientes WHERE id_ingrediente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
    }
}
?>
