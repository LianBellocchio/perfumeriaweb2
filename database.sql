-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS perfumeria;
USE perfumeria;

-- Crear la tabla de categorías
CREATE TABLE Categorías (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre_categoria VARCHAR(255) NOT NULL
);

-- Crear la tabla de productos
CREATE TABLE Productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre_producto VARCHAR(255) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2),
    id_categoria INT,
    FOREIGN KEY (id_categoria) REFERENCES Categorías(id_categoria)
);

-- Crear la tabla de ingredientes
CREATE TABLE Ingredientes (
    id_ingrediente INT AUTO_INCREMENT PRIMARY KEY,
    nombre_ingrediente VARCHAR(255) NOT NULL,
    descripcion TEXT
);

-- Crear la tabla de relación entre productos e ingredientes
CREATE TABLE Productos_Ingredientes (
    id_producto INT,
    id_ingrediente INT,
    cantidad DECIMAL(10,2),
    PRIMARY KEY (id_producto, id_ingrediente),
    FOREIGN KEY (id_producto) REFERENCES Productos(id_producto),
    FOREIGN KEY (id_ingrediente) REFERENCES Ingredientes(id_ingrediente)
);

-- Insertar datos de ejemplo
INSERT INTO Categorías (nombre_categoria) VALUES ('Fragancias Masculinas'), ('Fragancias Femeninas'), ('Fragancias Unisex');
INSERT INTO Productos (nombre_producto, descripcion, precio, id_categoria) VALUES ('Eau de Toilette', 'Fragancia fresca y ligera', 59.99, 1), ('Eau de Parfum', 'Fragancia intensa y duradera', 89.99, 2);
INSERT INTO Ingredientes (nombre_ingrediente, descripcion) VALUES ('Citrus', 'Fragancia cítrica y fresca'), ('Jazmín', 'Fragancia floral y dulce');
INSERT INTO Productos_Ingredientes (id_producto, id_ingrediente, cantidad) VALUES (1, 1, 10.00), (2, 2, 5.00);
