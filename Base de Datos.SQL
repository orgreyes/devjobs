--//!BASE DE DATOS PARA LA TIENDA DEVJOBS
CREATE DATABASE devjobs

CREATE TABLE productos (
    producto_id SERIAL NOT NULL,
    producto_nombre VARCHAR(50) NOT NULL,
    producto_precio DECIMAL(10,2) NOT NULL,
    producto_situacion SMALLINT DEFAULT 1 NOT NULL,
    PRIMARY KEY(producto_id)
);

INSERT INTO productos (producto_nombre, producto_precio) values ('MESA', 1500.25);
INSERT INTO productos (producto_nombre, producto_precio) values ('ESCRITORIO', 9000);
INSERT INTO productos (producto_nombre, producto_precio) values ('COMPUTADORA', 15000);


CREATE TABLE clientes (
    cliente_id SERIAL NOT NULL,
    cliente_nombre VARCHAR(60) NOT NULL,
    cliente_nit VARCHAR(10),
    cliente_situacion CHAR(1) DEFAULT '1',
    PRIMARY KEY(cliente_id)
);

INSERT INTO clientes (cliente_nombre, cliente_nit) values ('CARLOS ADIEL', 107515083);
INSERT INTO clientes (cliente_nombre, cliente_nit) values ('MELANY ANDREA', 12345678);
INSERT INTO clientes (cliente_nombre, cliente_nit) values ('ALEJANDRA DUBON', 8765421);


CREATE TABLE ventas (
    venta_id SERIAL NOT NULL,
    venta_cliente INTEGER NOT NULL,
    venta_fecha DATETIME YEAR TO DAY NOT NULL,
    venta_situacion CHAR(1) DEFAULT '1',
    PRIMARY KEY(venta_id),
    FOREIGN KEY (venta_cliente) REFERENCES clientes(cliente_id)
);

INSERT INTO ventas (venta_cliente, venta_fecha) values ('1', '2023-01-25');
INSERT INTO ventas (venta_cliente, venta_fecha) values ('2', '2023-01-25');
INSERT INTO ventas (venta_cliente, venta_fecha) values ('3', '2023-02-15');
INSERT INTO ventas (venta_cliente, venta_fecha) values ('1', '2023-03-26');
INSERT INTO ventas (venta_cliente, venta_fecha) values ('2', '2023-04-20');
INSERT INTO ventas (venta_cliente, venta_fecha) values ('2', '2023-05-15');


CREATE TABLE detalle_ventas (
    detalle_id SERIAL NOT NULL,
    detalle_venta INTEGER NOT NULL,
    detalle_producto INTEGER NOT NULL,
    detalle_cantidad SMALLINT NOT NULL,
    detalle_situacion CHAR(1) DEFAULT '1',
    PRIMARY KEY(detalle_id),
    FOREIGN KEY (detalle_producto) REFERENCES productos(producto_id),
    FOREIGN KEY (detalle_venta) REFERENCES ventas(venta_id)
);

insert into detalle_ventas (detalle_venta, detalle_producto, detalle_cantidad) values (1,1,1);
insert into detalle_ventas (detalle_venta, detalle_producto, detalle_cantidad) values (1,3,2);
insert into detalle_ventas (detalle_venta, detalle_producto, detalle_cantidad) values (2,2,3);
insert into detalle_ventas (detalle_venta, detalle_producto, detalle_cantidad) values (2,1,1);


--//!Query para mandar a traer los datos de los nombres de los productos y cuantos han sido vendidos
select producto_nombre as producto, sum(detalle_cantidad) as cantidad 
from detalle_ventas 
inner join productos on detalle_producto = producto_id 
where detalle_situacion = 1 group by producto_nombre



--//!PARA LOS USUARIOS
CREATE TABLE aplicacion (
    app_id SERIAL PRIMARY KEY,
    app_nombre VARCHAR(50),
    app_situacion SMALLINT DEFAULT 1
);

CREATE TABLE rol (
    rol_id SERIAL PRIMARY KEY,
    rol_nombre VARCHAR(50),
    rol_nombre_ct VARCHAR(10),
    rol_app INTEGER REFERENCES aplicacion(app_id),
    rol_situacion SMALLINT DEFAULT 1
);

CREATE TABLE usuario (
    usu_id SERIAL PRIMARY KEY,
    usu_nombre VARCHAR(50) UNIQUE,
    usu_catalogo INTEGER UNIQUE,
    usu_password LVARCHAR,
    usu_situacion SMALLINT DEFAULT 1
);

CREATE TABLE permiso (
    permiso_id SERIAL PRIMARY KEY,
    permiso_usuario INTEGER REFERENCES usuario(usu_id),
    permiso_rol INTEGER REFERENCES rol(rol_id),
    permiso_situacion SMALLINT DEFAULT 1
);


insert into aplicacion (app_nombre) values ('TIENDA');

insert into rol (rol_nombre, rol_nombre_ct, rol_app ) values ('ADMINISTRADOR DE TIENDA', 'TIENDA_ADMIN', 1);
insert into rol (rol_nombre, rol_nombre_ct, rol_app ) values ('USUARIO DE TIENDA', 'TIENDA_USER', 1);

insert into usuario (usu_nombre, usu_catalogo, usu_password ) values 
('CARLOS REYES', 664052, '$2y$10$Nz6/ESQw7b7xW1Q2j.WEM.g5LQ/NSSmHnhZpfolFAH.ltD0GGRKGS');
insert into usuario (usu_nombre, usu_catalogo, usu_password ) values 
('ABNER FUENTES', 623041, '$2y$10$Nz6/ESQw7b7xW1Q2j.WEM.g5LQ/NSSmHnhZpfolFAH.ltD0GGRKGS');

insert into permiso (permiso_usuario, permiso_rol) values (1, 1);
insert into permiso (permiso_usuario, permiso_rol) values (2, 1);

