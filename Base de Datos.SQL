--//!PARA LOS USUARIOS
CREATE TABLE rol (
    rol_id SERIAL PRIMARY KEY,
    rol_nombre VARCHAR(50),
    rol_situacion SMALLINT DEFAULT 1
);

CREATE TABLE usuario (
    usu_id SERIAL PRIMARY KEY,
    usu_nombre VARCHAR(50) UNIQUE,
    usu_catalogo INTEGER UNIQUE,
    usu_password LVARCHAR,
    usu_rol INTEGER REFERENCES rol(rol_id),
    usu_situacion SMALLINT DEFAULT 1
);


insert into rol (rol_nombre ) values ('ADMINISTRADOR DE TIENDA');
insert into rol (rol_nombre ) values ('USUARIO DE TIENDA');

insert into usuario (usu_nombre, usu_catalogo, usu_password, usu_rol ) values 
('CARLOS REYES', 664052, '$2y$10$Nz6/ESQw7b7xW1Q2j.WEM.g5LQ/NSSmHnhZpfolFAH.ltD0GGRKGS', 1);
insert into usuario (usu_nombre, usu_catalogo, usu_password, usu_rol ) values 
('ABNER FUENTES', 623041, '$2y$10$Nz6/ESQw7b7xW1Q2j.WEM.g5LQ/NSSmHnhZpfolFAH.ltD0GGRKGS', 2);
