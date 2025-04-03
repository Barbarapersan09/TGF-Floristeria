-- Creación de la base de datos Floristeria
CREATE DATABASE floristeria;

-- Uso de la base de datos Floristeria
USE floristeria;

-- Creación de la tabla Clientes
-- Esta tabla almacena información sobre los clientes de la tienda online.
CREATE TABLE Clientes (
    cliente_id INT PRIMARY KEY AUTO_INCREMENT,  -- Identificador único para cada cliente
    nombre VARCHAR(50) NOT NULL,                -- Nombre del cliente
    apellido VARCHAR(50) NOT NULL,              -- Apellido del cliente
    email VARCHAR(100) NOT NULL UNIQUE,         -- Correo electrónico del cliente, debe ser único
    telefono VARCHAR(15),                       -- Número de teléfono del cliente
    direccion VARCHAR(255),                     -- Dirección del cliente
    ciudad VARCHAR(50),                         -- Ciudad del cliente
    estado VARCHAR(50),                         -- Estado o provincia del cliente
    codigo_postal VARCHAR(10),                  -- Código postal del cliente
    pais VARCHAR(50)                            -- País del cliente
);

-- Creación de la tabla Categorias
-- Esta tabla almacena las diferentes categorías de flores disponibles.
CREATE TABLE Categorias (
    categoria_id INT PRIMARY KEY AUTO_INCREMENT,  -- Identificador único para cada categoría
    nombre_categoria VARCHAR(50) NOT NULL         -- Nombre de la categoría
);

-- Creación de la tabla Flores
-- Esta tabla almacena información sobre las flores disponibles en la tienda.
CREATE TABLE Flores (
    flor_id INT PRIMARY KEY AUTO_INCREMENT,       -- Identificador único para cada flor
    nombre VARCHAR(100) NOT NULL,                 -- Nombre de la flor
    descripcion TEXT,                             -- Descripción de la flor
    precio DECIMAL(10, 2) NOT NULL,               -- Precio de la flor
    cantidad_stock INT NOT NULL,                  -- Cantidad disponible en inventario
    categoria_id INT,                             -- Referencia a la categoría de la flor
    FOREIGN KEY (categoria_id) REFERENCES Categorias(categoria_id)  -- Clave foránea hacia Categorias
);

-- Creación de la tabla Pedidos
-- Esta tabla almacena información sobre los pedidos realizados por los clientes.
CREATE TABLE Pedidos (
    pedido_id INT PRIMARY KEY AUTO_INCREMENT,     -- Identificador único para cada pedido
    fecha_pedido DATETIME NOT NULL,               -- Fecha y hora en que se realizó el pedido
    cliente_id INT,                               -- Referencia al cliente que realizó el pedido
    monto_total DECIMAL(10, 2) NOT NULL,          -- Monto total del pedido
    estado VARCHAR(50),                           -- Estado del pedido (ej. pendiente, enviado)
    FOREIGN KEY (cliente_id) REFERENCES Clientes(cliente_id)  -- Clave foránea hacia Clientes
);

-- Creación de la tabla DetallesPedido
-- Esta tabla almacena los detalles de cada pedido, desglosando los productos comprados.
CREATE TABLE DetallesPedido (
    detalle_pedido_id INT PRIMARY KEY AUTO_INCREMENT,  -- Identificador único para cada detalle de pedido
    pedido_id INT,                                     -- Referencia al pedido
    flor_id INT,                                       -- Referencia a la flor
    cantidad INT NOT NULL,                             -- Cantidad de la flor en el pedido
    precio_unitario DECIMAL(10, 2) NOT NULL,           -- Precio unitario de la flor en el momento del pedido
    subtotal DECIMAL(10, 2) NOT NULL,                  -- Subtotal para esa línea del pedido (cantidad * precio_unitario)
    FOREIGN KEY (pedido_id) REFERENCES Pedidos(pedido_id),  -- Clave foránea hacia Pedidos
    FOREIGN KEY (flor_id) REFERENCES Flores(flor_id)        -- Clave foránea hacia Flores
);

-- Creación de la tabla MetodosPago
-- Esta tabla almacena los diferentes métodos de pago disponibles.
CREATE TABLE MetodosPago (
    metodo_pago_id INT PRIMARY KEY AUTO_INCREMENT,  -- Identificador único para cada método de pago
    nombre_metodo VARCHAR(50) NOT NULL              -- Nombre del método de pago (ej. tarjeta de crédito, PayPal)
);

-- Creación de la tabla Pagos
-- Esta tabla almacena información sobre los pagos realizados para los pedidos.
CREATE TABLE Pagos (
    pago_id INT PRIMARY KEY AUTO_INCREMENT,        -- Identificador único para cada pago
    pedido_id INT,                                 -- Referencia al pedido asociado con el pago
    metodo_pago_id INT,                            -- Referencia al método de pago utilizado
    monto DECIMAL(10, 2) NOT NULL,                 -- Monto pagado
    fecha_pago DATETIME NOT NULL,                  -- Fecha y hora en que se realizó el pago
    FOREIGN KEY (pedido_id) REFERENCES Pedidos(pedido_id),         -- Clave foránea hacia Pedidos
    FOREIGN KEY (metodo_pago_id) REFERENCES MetodosPago(metodo_pago_id)  -- Clave foránea hacia MetodosPago
);
