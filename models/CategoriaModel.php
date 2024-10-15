<?php
require_once 'config/config.php';

class CategoriaModel {
    private $connection;

    // Constructor para establecer la conexión a la base de datos
    public function __construct() {
        $this->connection = connect();
    }

    // Obtener todas las categorías de la base de datos
    public function getCategorias() {
        $query = "SELECT * FROM categorías";
        $result = $this->connection->query($query);
        $categorias = [];
        while ($row = $result->fetch_assoc()) {
            $categorias[] = $row;
        }
        return $categorias;
    }

    // Obtener una categoría por su ID
    public function getCategoriaById($id) {
        $query = "SELECT * FROM categorías WHERE id_categoria = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Agregar una nueva categoría
    public function addCategoria($nombre) {
        $query = "INSERT INTO categorías (nombre_categoria) VALUES (?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
    }

    // Actualizar una categoría existente
    public function updateCategoria($id, $nombre) {
        $query = "UPDATE categorías SET nombre_categoria = ? WHERE id_categoria = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("si", $nombre, $id);
        $stmt->execute();
    }

    // Eliminar una categoría
    public function deleteCategoria($id) {
        $query = "DELETE FROM categorías WHERE id_categoria = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
?>
