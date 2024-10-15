<?php
require_once 'config/config.php';

class IngredienteModel {
    private $connection;

    // Constructor para establecer la conexión a la base de datos
    public function __construct() {
        $this->connection = connect();
    }

    // Obtener todos los ingredientes
    public function getIngredientes() {
        $query = "SELECT * FROM ingredientes";
        $result = $this->connection->query($query);
        $ingredientes = [];
        while ($row = $result->fetch_assoc()) {
            $ingredientes[] = $row;
        }
        return $ingredientes;
    }

    // Obtener un ingrediente por su ID
    public function getIngredienteById($id) {
        $query = "SELECT * FROM ingredientes WHERE id_ingrediente = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Agregar un nuevo ingrediente
    public function addIngrediente($nombre, $descripcion) {
        $query = "INSERT INTO ingredientes (nombre_ingrediente, descripcion) VALUES (?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ss", $nombre, $descripcion);
        $stmt->execute();
    }

    // Actualizar un ingrediente existente
    public function updateIngrediente($id, $nombre, $descripcion) {
        $query = "UPDATE ingredientes SET nombre_ingrediente = ?, descripcion = ? WHERE id_ingrediente = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ssi", $nombre, $descripcion, $id);
        $stmt->execute();
    }

    // Eliminar un ingrediente
    public function deleteIngrediente($id) {
        $query = "DELETE FROM ingredientes WHERE id_ingrediente = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
?>
