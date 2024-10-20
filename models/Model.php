<!-- AutoDeploy Segun Filminas -->
<?php
require_once 'config/config.php';

class Model {
    protected $db;

    public function __construct() {
        $this->db = new PDO(
            "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8",
            DB_USER, DB_PASS
        );
        $this->_deploy();
    }

    private function _deploy() {
        // Verificar si la base de datos tiene tablas
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll(PDO::FETCH_ASSOC);

        if (count($tables) == 0) {
            // Si no hay tablas, ejecutar el script SQL desde perfumeria.sql
            $sqlFilePath = __DIR__ . '/../sql/perfumeria.sql';

            if (file_exists($sqlFilePath)) {
                $sql = file_get_contents($sqlFilePath);
                try {
                    $this->db->exec($sql);
                    echo "Las tablas fueron creadas exitosamente.";
                } catch (PDOException $e) {
                    die("Error al crear las tablas: " . $e->getMessage());
                }
            } else {
                die("El archivo perfumeria.sql no se encontró.");
            }
        }
    }
}
?>