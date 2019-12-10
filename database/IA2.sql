CREATE TABLE IF NOT EXISTS clientes(

    cedula_cliente         VARCHAR(9)       NOT NULL,
    tipo_documento_cliente VARCHAR(2)       NOT NULL,
    nombre_cliente         VARCHAR (40)     NOT NULL,
    descripcion_cliente    TEXT,
    direccion_cliente      TEXT,
    telefono_cliente       VARCHAR(11)      NOT NULL,
    representante_cliente  VARCHAR(40)      NOT NULL,

    PRIMARY KEY (cedula_cliente)
);

CREATE TABLE IF NOT EXISTS pedidos(

    codigo_pedido          VARCHAR(10)      NOT NULL,
    cedula_cliente         VARCHAR(9)       NOT NULL,
    status_pedido          VARCHAR(10)      NOT NULL,
    descripcion_pedido     TEXT,
    fecha_pedido           DATE             NOT NULL,
    fecha_entrega_pedido   DATE             NOT NULL,

    PRIMARY KEY (codigo_pedido)
);

CREATE TABLE IF NOT EXISTS servi_pedidos(

    id_servi_pedido        SERIAL           NOT NULL,
    codigo_pedido          VARCHAR(10)      NOT NULL,
    id_servicio            INT              NOT NULL,
    id_tela                INT              NOT NULL,
    cantidad_prenda        INT              NOT NULL,
    cantidad_medida        INT              NOT NULL,
    precio_servi_pedido   FLOAT            NOT NULL,
    PRIMARY KEY (id_servi_pedido)
);

CREATE TABLE IF NOT EXISTS servicios(

    id_servicio            SERIAL           NOT NULL,
    nombre_servicio        VARCHAR(40)      NOT NULL,
    descripcion_servicio   TEXT,
    unidad_medida          VARCHAR(10)      NOT NULL,
    precio_servicio        FLOAT            NOT NULL,
    costo_servicio         FLOAT            NOT NULL,
    

    PRIMARY KEY (id_servicio)
);

CREATE TABLE IF NOT EXISTS productos(

    codigo_producto        VARCHAR(15)      NOT NULL,
    nombre_producto        VARCHAR(20)      NOT NULL,
    descripcion_producto   TEXT,
    tipo_producto          VARCHAR(2)       NOT NULL,
    modelo_producto        VARCHAR(10)      NOT NULL,
    costo_producto         FLOAT            NOT NULL,
    precio_producto        FLOAT            NOT NULL,
    stock_producto         INT              NOT NULL,
    stock_max_producto     INT              NOT NULL,
    stock_min_producto     INT              NOT NULL,
    img_producto           VARCHAR(256),

    PRIMARY KEY (codigo_producto) 
);


CREATE TABLE IF NOT EXISTS pro_tallas(

    codigo_producto       VARCHAR(10)       NOT NULL,
    id_talla              INT        		NOT NULL,
    stock_pro_talla       INT 				NOT NULL,

    PRIMARY KEY (codigo_producto, id_talla)
);

CREATE TABLE IF NOT EXISTS tallas(

    id_talla       		  SERIAL       		NOT NULL,
    nombre_talla          VARCHAR(3)        NOT NULL,

    PRIMARY KEY (id_talla)
);

INSERT INTO tallas VALUES(default, 'XS');
INSERT INTO tallas VALUES(default, 'S');
INSERT INTO tallas VALUES(default, 'M');
INSERT INTO tallas VALUES(default, 'L');
INSERT INTO tallas VALUES(default, 'XXL');
INSERT INTO tallas VALUES(default, '32');
INSERT INTO tallas VALUES(default, '34');
INSERT INTO tallas VALUES(default, '36');
INSERT INTO tallas VALUES(default, '38');
INSERT INTO tallas VALUES(default, '40');
INSERT INTO tallas VALUES(default, '42');
INSERT INTO tallas VALUES(default, '44');
INSERT INTO tallas VALUES(default, '46');
INSERT INTO tallas VALUES(default, '48');
INSERT INTO tallas VALUES(default, '50');
INSERT INTO tallas VALUES(default, '52');

CREATE TABLE IF NOT EXISTS pro_pedidos(

    codigo_pedido          VARCHAR(10)       NOT NULL,
    codigo_producto        VARCHAR(10)       NOT NULL,
    cant_pro_pedido          INT               NOT NULL,
    precio_pro_pedido        FLOAT            NOT NULL,
    PRIMARY KEY (codigo_pedido, codigo_producto)
);


CREATE TABLE IF NOT EXISTS materiales(

    id_material            SERIAL           NOT NULL,
    nombre_material        VARCHAR(100)     NOT NULL,
    descripcion_material   TEXT,
    unidad_material        VARCHAR(5)       NOT NULL,
    precio_material        FLOAT            NOT NULL,
    
    PRIMARY KEY (id_material)
);

CREATE TABLE IF NOT EXISTS telas(

    id_tela                 SERIAL          NOT NULL,
    nombre_tela             VARCHAR(20)     NOT NULL,
    descripcion_tela        TEXT,
    unidad_med_tela         VARCHAR(3)      NOT NULL,
    tipo_tela               VARCHAR(20)     NOT NULL,

    PRIMARY KEY (id_tela)
);

CREATE TABLE IF NOT EXISTS mat_servicios(

    id_material             INT             NOT NULL,
    id_servicio             INT             NOT NULL,
    cant_mat_servicio       INT             NOT NULL,

    PRIMARY KEY (id_material, id_servicio)
);


CREATE TABLE IF NOT EXISTS factura_ventas(

    codigo_factura           VARCHAR(10)    NOT NULL,
    codigo_pedido            VARCHAR(10)    NOT NULL,
    fecha_factura            DATE           NOT NULL,
    modo_pago_factura        VARCHAR(20)    NOT NULL,
    status_factura           BOOL           NOT NULL,
    porcentaje_venta_factura FLOAT          NOT NULL,

    PRIMARY KEY (codigo_factura)
);

CREATE TABLE IF NOT EXISTS usuarios(

 	nick_usuario             VARCHAR(30)    NOT NULL,
    nombre_usuario           VARCHAR(20)    NOT NULL,
    apellido_usuario         VARCHAR(20)    NOT NULL,
    email_usuario            VARCHAR(40),    
    contrasenia_usuario      VARCHAR(255)   NOT NULL,
    id_rol                   INT            NOT NULL,

    PRIMARY KEY (nick_usuario)
);

CREATE TABLE IF NOT EXISTS bitacoras(

    id_bitacora              SERIAL         NOT NULL,
    nick_usuario             VARCHAR(30)    NOT NULL,
    fecha_actu_bitacora      DATE           NOT NULL,
    hora_actu_bitacora       TIME           NOT NULL,
    modulo_bitacora          VARCHAR(20)    NOT NULL,
    accion_bitacora          TEXT           NOT NULL,

    PRIMARY KEY (id_bitacora)
);

CREATE TABLE IF NOT EXISTS roles(

    id_rol                    SERIAL        NOT NULL,
    nombre_rol                VARCHAR(15)   NOT NULL,
    descripcion_rol           TEXT,

    PRIMARY KEY (id_rol)
);

INSERT INTO roles VALUES(1, 'SuperUsuario'    , 'Tiene acceso a todo el sistema');
INSERT INTO roles VALUES(2, 'Administrador'   , 'Tiene acceso a parcial al sistema');
INSERT INTO roles VALUES(3, 'Usuario'         , 'Tiene limitado al sistema');

CREATE TABLE IF NOT EXISTS modulos(

    id_modulo               SERIAL         NOT NULL,
    nombre_modulo           VARCHAR(15)    NOT NULL,

    PRIMARY KEY (id_modulo)
);

INSERT INTO modulos VALUES(1, 'USUARIOS');
INSERT INTO modulos VALUES(2, 'PRODUCTOS');
INSERT INTO modulos VALUES(3, 'PEDIDOS');
INSERT INTO modulos VALUES(4, 'CLIENTES');
INSERT INTO modulos VALUES(5, 'SERVICIOS');
INSERT INTO modulos VALUES(6, 'FACTURAS');
INSERT INTO modulos VALUES(7, 'REPORTES');
INSERT INTO modulos VALUES(8, 'TELAS');
INSERT INTO modulos VALUES(9, 'MATERIALES');
INSERT INTO modulos VALUES(10, 'ESTADISTICAS');
INSERT INTO modulos VALUES(11, 'SEGURIDAD');
INSERT INTO modulos VALUES(12, 'MANTENIMIENTO');
INSERT INTO modulos VALUES(13, 'NOTIFICACIONES');




CREATE TABLE IF NOT EXISTS permisos(

    id_permiso               SERIAL         NOT NULL,
    nombre_permiso           VARCHAR(30)    NOT NULL,
    descripcion_permiso      TEXT,

    PRIMARY KEY (id_permiso)
);

INSERT INTO 	permisos 	VALUES (1 , 'REGISTRAR'     , 'El usuario tendrá permiso para registrar en el módulo.' );
INSERT INTO 	permisos 	VALUES (2 , 'CONSULTAR'     , 'El usuario tendrá permiso para consultar registros en el módulo.' );
INSERT INTO 	permisos 	VALUES (3 , 'ACTUALIZAR'    , 'El usuario tendrá permiso para actualizar registros en el módulo.' );
INSERT INTO 	permisos 	VALUES (4 , 'ELIMINAR'      , 'El usuario tendrá permiso para eliminar registros en el módulo.' );
INSERT INTO 	permisos 	VALUES (5 , 'VER DETALLES'  , 'El usuario tendrá permiso para ver detalles de registros del módulo.');
INSERT INTO 	permisos 	VALUES (6 , 'REPORTES'      , 'El usuario tendrá permiso para acceder a los reportes del sistema.');
INSERT INTO 	permisos 	VALUES (7 , 'CONFIGURACION' , 'El usuario tendrá permiso para acceder a los modulos de mantenimiento y seguridad del sistema.');


CREATE TABLE IF NOT EXISTS rol_permisos_modulos (

    id_rol                   INT            NOT NULL,
    id_permiso               INT            NOT NULL,
    id_modulo                INT            NOT NULL,

    PRIMARY KEY (id_rol, id_permiso,id_modulo)
);

--SuperUsuario

--Usuario
INSERT INTO rol_permisos_modulos VALUES(1,1,1);
INSERT INTO rol_permisos_modulos VALUES(1,2,1);
INSERT INTO rol_permisos_modulos VALUES(1,3,1);
INSERT INTO rol_permisos_modulos VALUES(1,4,1);
INSERT INTO rol_permisos_modulos VALUES(1,5,1);

--Producto
INSERT INTO rol_permisos_modulos VALUES(1,1,2);
INSERT INTO rol_permisos_modulos VALUES(1,2,2);
INSERT INTO rol_permisos_modulos VALUES(1,3,2);
INSERT INTO rol_permisos_modulos VALUES(1,4,2);
INSERT INTO rol_permisos_modulos VALUES(1,5,2);

--Pedido
INSERT INTO rol_permisos_modulos VALUES(1,1,3);
INSERT INTO rol_permisos_modulos VALUES(1,2,3);
INSERT INTO rol_permisos_modulos VALUES(1,3,3);
INSERT INTO rol_permisos_modulos VALUES(1,4,3);
INSERT INTO rol_permisos_modulos VALUES(1,5,3);

--Cliente
INSERT INTO rol_permisos_modulos VALUES(1,1,4);
INSERT INTO rol_permisos_modulos VALUES(1,2,4);
INSERT INTO rol_permisos_modulos VALUES(1,3,4);
INSERT INTO rol_permisos_modulos VALUES(1,4,4);
INSERT INTO rol_permisos_modulos VALUES(1,5,4);

--Servicio
INSERT INTO rol_permisos_modulos VALUES(1,1,5);
INSERT INTO rol_permisos_modulos VALUES(1,2,5);
INSERT INTO rol_permisos_modulos VALUES(1,3,5);
INSERT INTO rol_permisos_modulos VALUES(1,4,5);
INSERT INTO rol_permisos_modulos VALUES(1,5,5);

--Factura
INSERT INTO rol_permisos_modulos VALUES(1,2,6);
INSERT INTO rol_permisos_modulos VALUES(1,3,6);

--Reporte
INSERT INTO rol_permisos_modulos VALUES(1,6,7);

--Tela
INSERT INTO rol_permisos_modulos VALUES(1,1,8);
INSERT INTO rol_permisos_modulos VALUES(1,2,8);
INSERT INTO rol_permisos_modulos VALUES(1,3,8);
INSERT INTO rol_permisos_modulos VALUES(1,4,8);
INSERT INTO rol_permisos_modulos VALUES(1,5,8);

--Materiales
INSERT INTO rol_permisos_modulos VALUES(1,1,9);
INSERT INTO rol_permisos_modulos VALUES(1,2,9);
INSERT INTO rol_permisos_modulos VALUES(1,3,9);
INSERT INTO rol_permisos_modulos VALUES(1,4,9);
INSERT INTO rol_permisos_modulos VALUES(1,5,9);

--Estadistica
INSERT INTO rol_permisos_modulos VALUES(1,2,10);

--Seguridad
INSERT INTO rol_permisos_modulos VALUES(1,7,11);

--Mantenimiento
INSERT INTO rol_permisos_modulos VALUES(1,7,12);

--Notificaciones
INSERT INTO rol_permisos_modulos VALUES(1,2,13);

--Administrador

--Usuario
INSERT INTO rol_permisos_modulos VALUES(2,1,1);
INSERT INTO rol_permisos_modulos VALUES(2,2,1);
INSERT INTO rol_permisos_modulos VALUES(2,3,1);
INSERT INTO rol_permisos_modulos VALUES(2,5,1);

--Producto
INSERT INTO rol_permisos_modulos VALUES(2,1,2);
INSERT INTO rol_permisos_modulos VALUES(2,2,2);
INSERT INTO rol_permisos_modulos VALUES(2,3,2);
INSERT INTO rol_permisos_modulos VALUES(2,5,2);

--Pedido
INSERT INTO rol_permisos_modulos VALUES(2,1,3);
INSERT INTO rol_permisos_modulos VALUES(2,2,3);
INSERT INTO rol_permisos_modulos VALUES(2,3,3);
INSERT INTO rol_permisos_modulos VALUES(2,1,6);
INSERT INTO rol_permisos_modulos VALUES(2,5,3);

--Cliente
INSERT INTO rol_permisos_modulos VALUES(2,1,4);
INSERT INTO rol_permisos_modulos VALUES(2,2,4);
INSERT INTO rol_permisos_modulos VALUES(2,3,4);
INSERT INTO rol_permisos_modulos VALUES(2,5,4);

--Servicio
INSERT INTO rol_permisos_modulos VALUES(2,1,5);
INSERT INTO rol_permisos_modulos VALUES(2,2,5);
INSERT INTO rol_permisos_modulos VALUES(2,3,5);
INSERT INTO rol_permisos_modulos VALUES(2,5,5);

--Factura
INSERT INTO rol_permisos_modulos VALUES(2,2,6);
INSERT INTO rol_permisos_modulos VALUES(2,3,6);

--Reporte
INSERT INTO rol_permisos_modulos VALUES(2,6,7);

--Tela
INSERT INTO rol_permisos_modulos VALUES(2,1,8);
INSERT INTO rol_permisos_modulos VALUES(2,2,8);
INSERT INTO rol_permisos_modulos VALUES(2,3,8);
INSERT INTO rol_permisos_modulos VALUES(2,5,8);

--Materiales
INSERT INTO rol_permisos_modulos VALUES(2,1,9);
INSERT INTO rol_permisos_modulos VALUES(2,2,9);
INSERT INTO rol_permisos_modulos VALUES(2,3,9);
INSERT INTO rol_permisos_modulos VALUES(2,5,9);

--Notificaciones
INSERT INTO rol_permisos_modulos VALUES(2,2,13);

--Usuario Comùn

--Producto

INSERT INTO rol_permisos_modulos VALUES(3,2,2);

--Pedido

INSERT INTO rol_permisos_modulos VALUES(3,2,3);



ALTER TABLE    pedidos                  ADD CONSTRAINT    Fkdocumento      FOREIGN KEY    (cedula_cliente)    REFERENCES    clientes(cedula_cliente)         ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    servi_pedidos            ADD CONSTRAINT    Fkpedido         FOREIGN KEY    (codigo_pedido)     REFERENCES    pedidos(codigo_pedido)           ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    servi_pedidos            ADD CONSTRAINT    Fkservicio       FOREIGN KEY    (id_servicio)       REFERENCES    servicios(id_servicio)           ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    servi_pedidos            ADD CONSTRAINT    Fktela           FOREIGN KEY    (id_tela)           REFERENCES    telas(id_tela)           		 ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    pro_pedidos              ADD CONSTRAINT    Fkpedido         FOREIGN KEY    (codigo_pedido)     REFERENCES    pedidos(codigo_pedido)           ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    pro_pedidos              ADD CONSTRAINT    Fkproducto       FOREIGN KEY    (codigo_producto)   REFERENCES    productos(codigo_producto)       ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    pro_tallas               ADD CONSTRAINT    Fkproducto       FOREIGN KEY    (codigo_producto)   REFERENCES    productos(codigo_producto)       ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    pro_tallas               ADD CONSTRAINT    Fktalla          FOREIGN KEY    (id_talla)   		  REFERENCES    tallas(id_talla)       			 ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    mat_servicios            ADD CONSTRAINT    Fkmaterial       FOREIGN KEY    (id_material)       REFERENCES    materiales(id_material)          ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    mat_servicios            ADD CONSTRAINT    Fkpedido         FOREIGN KEY    (id_servicio)       REFERENCES    servicios(id_servicio)           ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    factura_ventas           ADD CONSTRAINT    Fkpedido         FOREIGN KEY    (codigo_pedido)     REFERENCES    pedidos(codigo_pedido)           ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    bitacoras                ADD CONSTRAINT    Fkusuario        FOREIGN KEY    (nick_usuario)      REFERENCES    usuarios(nick_usuario)           ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    rol_permisos_modulos     ADD CONSTRAINT    Fkroles          FOREIGN KEY    (id_rol)            REFERENCES    roles(id_rol)                    ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    rol_permisos_modulos     ADD CONSTRAINT    Fkpermiso        FOREIGN KEY    (id_permiso)        REFERENCES    permisos(id_permiso)             ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    rol_permisos_modulos     ADD CONSTRAINT    Fkmodulo         FOREIGN KEY    (id_modulo)         REFERENCES    modulos(id_modulo)               ON UPDATE CASCADE ON DELETE CASCADE;

