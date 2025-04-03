-- Crear la base de datos
CREATE DATABASE floristeria;

-- Usar la base de datos
USE floristeria;

-- Crear la tabla de Usuarios
CREATE TABLE usuarios
(
    id_usuario INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    hash VARCHAR(32) NOT NULL,
    activo TINYINT(1) NOT NULL DEFAULT 0,
PRIMARY KEY (`id_usuario`) 
);

-- Crear la tabla de Categorias_flores
CREATE TABLE categorias_flores (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,   -- Identificador único de la categoría
    nombre_categoria VARCHAR(100),                 -- Nombre de la categoría
    descripcion TEXT                               -- Descripción de la categoría
);

-- Crear la tabla de Flores
CREATE TABLE flores (
    id_flor INT AUTO_INCREMENT PRIMARY KEY,        -- Identificador único de cada flor
    nombre VARCHAR(100),                           -- Nombre de la flor
    descripcion TEXT,                              -- Descripción de la flor
    precio DECIMAL(10, 2),                         -- Precio de la flor
    url_imagen VARCHAR(255),                       -- URL de la imagen de la flor
    color VARCHAR(50),                             -- Color de la flor
    ocasion VARCHAR(100),                          -- Ocasión asociada a la flor
    stock INT,                                     -- Cantidad disponible en stock
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación
    id_categoria INT,                              -- Relación con la categoría de flores
    FOREIGN KEY (id_categoria) REFERENCES categorias_flores(id_categoria) -- Clave foránea
);

-- Crear la tabla de Pedidos
CREATE TABLE pedidos (
    id_pedido INT AUTO_INCREMENT PRIMARY KEY,      -- Identificador único del pedido
    id_usuario INT,                                -- Relación con el usuario que realizó el pedido
    monto_total DECIMAL(10, 2),                    -- Monto total del pedido
    estado_pedido VARCHAR(50),                     -- Estado del pedido (ej. pendiente, completado)
    metodo_pago VARCHAR(50),                       -- Método de pago (ej. tarjeta, PayPal)
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación del pedido
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) -- Clave foránea
);

-- Crear la tabla de Detalles_pedido
CREATE TABLE detalles_pedido (
    id_detalle_pedido INT AUTO_INCREMENT PRIMARY KEY, -- Identificador único del detalle de pedido
    id_pedido INT,                                -- Relación con el pedido
    id_flor INT,                                  -- Relación con la flor comprada
    cantidad INT,                                 -- Cantidad de flores compradas
    precio DECIMAL(10, 2),                        -- Precio unitario de la flor en el pedido
    FOREIGN KEY (id_pedido) REFERENCES pedidos(id_pedido), -- Clave foránea
    FOREIGN KEY (id_flor) REFERENCES flores(id_flor)       -- Clave foránea
);

-- Crear la tabla de Facturas
CREATE TABLE facturas (
    id_factura INT AUTO_INCREMENT PRIMARY KEY,    -- Identificador único de la factura
    id_pedido INT,                                -- Relación con el pedido
    fecha_factura TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de emisión de la factura
    monto_total DECIMAL(10, 2),                   -- Monto total facturado
    FOREIGN KEY (id_pedido) REFERENCES pedidos(id_pedido) -- Clave foránea
);

-- Crear la tabla de Envios
CREATE TABLE envios (
    id_envio INT AUTO_INCREMENT PRIMARY KEY,      -- Identificador único del envío
    id_pedido INT,                                -- Relación con el pedido
    direccion_envio TEXT,                         -- Dirección de envío
    fecha_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de envío
    estado_envio VARCHAR(50),                     -- Estado del envío (ej. enviado, entregado)
    FOREIGN KEY (id_pedido) REFERENCES pedidos(id_pedido) -- Clave foránea
);

-- Crear la tabla de Pagos
CREATE TABLE pagos (
    id_pago INT AUTO_INCREMENT PRIMARY KEY,       -- Identificador único del pago
    id_pedido INT,                                -- Relación con el pedido
    id_usuario INT,                               -- Relación con el usuario que realizó el pago
    metodo_pago VARCHAR(50),                      -- Método de pago (ej. tarjeta de crédito, PayPal)
    monto DECIMAL(10, 2),                         -- Monto pagado
    fecha_pago TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha del pago
    estado_pago VARCHAR(50),                      -- Estado del pago (ej. completado, fallido)
    FOREIGN KEY (id_pedido) REFERENCES pedidos(id_pedido), -- Clave foránea
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) -- Clave foránea
);
