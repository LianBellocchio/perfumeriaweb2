<?php
require_once 'models/ProductoModel.php';

class HomeController {
    // Acción para mostrar la página principal con los productos
    public function mostrarHome() {
        $model = new ProductoModel();
        $productos = $model->getProductos();
        require 'visual/home.phtml';
    }
}
?>
