# Base de Datos y Aplicación de Perfumería

## Descripción del Dominio

Este proyecto diseña una base de datos y una aplicación web para una tienda de perfumería (DivainParfums), con el objetivo de almacenar y gestionar información sobre categorías de productos, productos individuales, ingredientes utilizados en los productos y la relación entre productos e ingredientes. Además, la aplicación permite realizar operaciones CRUD (Crear, Leer, Actualizar y Eliminar) sobre los productos, categorías e ingredientes.

## Diagrama de la Base de Datos

![Diagrama de la Base de Datos](/diagram/DbDiagram.png)

## Estructura de la Base de Datos

### Tablas

- **Categorías**: Almacena las categorías de perfumes.
- **Productos**: Almacena los productos de perfumería.
- **Ingredientes**: Almacena los ingredientes de los productos.
- **Productos_Ingredientes**: Relaciona productos con ingredientes y almacena la cantidad de cada ingrediente en un producto.

### Relaciones

- Una **Categoría** puede tener muchos **Productos** (1:N).
- Un **Producto** puede tener muchos **Ingredientes** y un **Ingrediente** puede estar en muchos **Productos** (N:M).

## Funcionalidades de la Aplicación

### Público

- **Página Principal**: Los usuarios pueden ver una lista de todos los productos disponibles, categorizados por tipo. La información se muestra dinámicamente sin necesidad de autenticación.
- **Detalle del Producto**: Cada producto se puede visualizar en detalle, sin sus ingredientes ingredientes.

### Administrador

- **Autenticación**: Los administradores deben iniciar sesión para acceder a las funcionalidades de administración.
- **Gestión de Categorías**:
  - Listar, agregar, editar y eliminar categorías de productos.
- **Gestión de Productos**:
  - Listar, agregar, editar y eliminar productos de perfumería.
  - Asignar una categoría a cada producto.
- **Gestión de Ingredientes**:
  - Listar, agregar, editar y eliminar ingredientes.
  - Relacionar ingredientes con productos, definiendo cantidades específicas.

## Estructura de Archivos

- **`sql/`**: Carpeta que contiene el script SQL para crear la base de datos e insertar datos de ejemplo (`perfumeria.sql`).
- **`diagram/`**: Carpeta que contiene el diagrama de la base de datos (`DbDiagram.png`).
- **`index.php`**: Punto de entrada principal de la aplicación. Gestiona las solicitudes y redirige a los controladores correspondientes.
- **`controllers/`**: Carpeta que contiene los controladores de la aplicación (e.g., `IngredienteController.php`, `ProductoController.php`).
- **`models/`**: Carpeta que contiene los modelos de la aplicación (e.g., `IngredienteModel.php`, `ProductoModel.php`).
- **`visual/ (originalmente views) `**: Carpeta que contiene las vistas públicas y administrativas (e.g., `home.phtml`, `listadoProductos.phtml`).
- **`public/css/`**: Carpeta que contiene los archivos CSS para estilizar la aplicación.

## Cómo Ejecutar el Proyecto

1. **Instalar XAMPP**: Este proyecto fue desarrollado usando XAMPP.
2. **Clonar el Repositorio**: Clona el repositorio en el directorio `htdocs` de XAMPP.
3. **Importar la Base de Datos**: Utiliza `phpMyAdmin` para importar el archivo `perfumeria.sql` y crear la base de datos.
4. **Iniciar el Servidor**: Inicia Apache y MySQL desde el panel de control de XAMPP.
5. **Navegar a la Aplicación**: Accede a `http://localhost/DivainParfums/` en tu navegador para interactuar con la aplicación. :)

## Tecnologías Utilizadas

- **PHP**: Lenguaje de programación del lado del servidor.
- **MySQL**: Base de datos relacional para almacenar la información.
- **HTML/CSS**: Para el diseño y estructura de la interfaz de usuario.
- **XAMPP**: Entorno de servidor local para desarrollo.

## Consideraciones

- **Autenticación**: El acceso a las funcionalidades administrativas requiere autenticación. El usuario de prueba es `webadmin` con la contraseña `admin`.
- **Patrón MVC**: El proyecto sigue el patrón arquitectónico Modelo-Vista-Controlador para una mejor separación de responsabilidades y facilidad de mantenimiento.

## Archivos

- **`perfumeria.sql`**: SQL para crear la base de datos e insertar datos de ejemplo.
- **`DbDiagram.png`**: Diagrama de la base de datos.
- **`README.md`**: Documentación del proyecto.
