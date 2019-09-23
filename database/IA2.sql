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
    precio_servi_pedido    FLOAT            NOT NULL,
    cantidad_prenda        INT              NOT NULL,
    cantidad_medida        INT              NOT NULL,

    PRIMARY KEY (id_servi_pedido)
);

CREATE TABLE IF NOT EXISTS servicios(

    id_servicio            SERIAL           NOT NULL,
    nombre_servicio        VARCHAR(40)      NOT NULL,
    descripcion_servicio   TEXT,
    precio_servicio        FLOAT            NOT NULL,
    costo_servicio         FLOAT            NOT NULL,
    unidad_medida          VARCHAR(10)      NOT NULL,

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
    talla                 VARCHAR(5)        NOT NULL,
    stock_pro_talla       INT NOT NULL,

    PRIMARY KEY (codigo_producto)
);

CREATE TABLE IF NOT EXISTS pro_pedidos(

    codigo_pedido         VARCHAR(10)       NOT NULL,
    codigo_producto       VARCHAR(10)       NOT NULL,
    cant_pro_pedido       INT               NOT NULL,
    precio_pro_pedido     FLOAT             NOT NULL,

    PRIMARY KEY (codigo_pedido, codigo_producto)
);

CREATE TABLE IF NOT EXISTS articulos(

    id_articulo           SERIAL            NOT NULL,
    nombre_articulo       VARCHAR(20)       NOT NULL,
    tipo_articulo         VARCHAR(1)        NOT NULL,
    modelo_articulo       VARCHAR(10)       NOT NULL,

    PRIMARY KEY (id_articulo) 
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

CREATE TABLE IF NOT EXISTS art_pedidos(

    id_servi_pedido         INT             NOT NULL,
    id_articulo             INT             NOT NULL,
    talla                   VARCHAR(5)      NOT NULL,

    PRIMARY KEY (id_servi_pedido, id_articulo)              

);

CREATE TABLE IF NOT EXISTS mat_pedidos(

    id_material             INT             NOT NULL,
    id_servi_pedido         INT             NOT NULL,
    cant_mat_pedido         INT             NOT NULL,

    PRIMARY KEY (id_material, id_servi_pedido)
);

CREATE TABLE IF NOT EXISTS tel_pedidos(

    id_tela                 INT             NOT NULL,
    id_servi_pedido         INT             NOT NULL,

    PRIMARY KEY (id_tela, id_servi_pedido) 
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

-- El USUARIO POR DEFECTO ES USER: admin PASSWORD: 1234

INSERT INTO usuarios (nick_usuario, nombre_usuario, apellido_usuario, email_usuario, contrasenia_usuario, id_rol) 
VALUES ('admin', 'admin', 'istrador', 'admin@admin.com', '$2y$12$irDLu4S41JsP.H2E9Wbifuk2/qwQbJdhzMnckMr6WyudWl1j1gIY2', 1);

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

INSERT INTO roles VALUES (default, 'superusuario', 'Es el encargado de manejar todo el sistema');
INSERT INTO roles VALUES (default, 'usuario', 'Tiene acceso limitado al sistema');
INSERT INTO roles VALUES (default, 'administrador', 'Es quien atiende a los clientes y registra los pedidos en la organización');

CREATE TABLE IF NOT EXISTS permisos(

    id_permiso               SERIAL         NOT NULL,
    nombre_permiso           VARCHAR(30)    NOT NULL,
    descripcion_permiso      TEXT,

    PRIMARY KEY (id_permiso)
);

CREATE TABLE IF NOT EXISTS rol_permisos (

    id_rol                   INT            NOT NULL,
    id_permiso               INT            NOT NULL,

    PRIMARY KEY (id_rol, id_permiso)
);


ALTER TABLE    pedidos         ADD CONSTRAINT    Fkdocumento      FOREIGN KEY    (cedula_cliente)    REFERENCES    clientes(cedula_cliente)         ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    servi_pedidos   ADD CONSTRAINT    Fkpedido         FOREIGN KEY    (codigo_pedido)     REFERENCES    pedidos(codigo_pedido)           ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    servi_pedidos   ADD CONSTRAINT    Fkservicio       FOREIGN KEY    (id_servicio)       REFERENCES    servicios(id_servicio)           ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    pro_pedidos     ADD CONSTRAINT    Fkpedido         FOREIGN KEY    (codigo_pedido)     REFERENCES    pedidos(codigo_pedido)           ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    pro_pedidos     ADD CONSTRAINT    Fkproducto       FOREIGN KEY    (codigo_producto)   REFERENCES    productos(codigo_producto)       ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    pro_tallas      ADD CONSTRAINT    Fkproducto       FOREIGN KEY    (codigo_producto)   REFERENCES    productos(codigo_producto)       ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    art_pedidos     ADD CONSTRAINT    Fkart            FOREIGN KEY    (id_articulo)       REFERENCES    articulos(id_articulo)           ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    art_pedidos     ADD CONSTRAINT    Fkservi_pedido   FOREIGN KEY    (id_servi_pedido)   REFERENCES    servi_pedidos(id_servi_pedido)   ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    mat_pedidos     ADD CONSTRAINT    Fkmaterial       FOREIGN KEY    (id_material)       REFERENCES    materiales(id_material)          ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    mat_pedidos     ADD CONSTRAINT    Fkpedido         FOREIGN KEY    (id_servi_pedido)   REFERENCES    servi_pedidos(id_servi_pedido)   ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    tel_pedidos     ADD CONSTRAINT    Fktela           FOREIGN KEY    (id_tela)           REFERENCES    telas(id_tela)                   ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    tel_pedidos     ADD CONSTRAINT    Fkservi_pedido   FOREIGN KEY    (id_servi_pedido)   REFERENCES    servi_pedidos(id_servi_pedido)   ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    factura_ventas  ADD CONSTRAINT    Fkpedidos        FOREIGN KEY    (codigo_pedido)     REFERENCES    pedidos(codigo_pedido)           ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    bitacoras       ADD CONSTRAINT    Fkusuario        FOREIGN KEY    (nick_usuario)      REFERENCES    usuarios(nick_usuario)           ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    rol_permisos    ADD CONSTRAINT    Fkroles          FOREIGN KEY    (id_rol)            REFERENCES    roles(id_rol)                    ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    rol_permisos    ADD CONSTRAINT    Fkpermiso        FOREIGN KEY    (id_permiso)        REFERENCES    permisos(id_permiso)             ON UPDATE CASCADE ON DELETE CASCADE;


