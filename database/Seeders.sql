-- CLIENTES

INSERT INTO 	clientes 		VALUES ('27210326','V', 'Angel Serrano'    , 'Esclavo que hizo el registro' , 'Sarare'         , '04120531200'  ,'UPTAEB');
INSERT INTO 	clientes 		VALUES ('27085898','V', 'Yohnneiber Diaz'  , 'Lider'                        , 'Norte'          , '0424'		 ,'UPTAEB');
INSERT INTO 	clientes 		VALUES ('27317920','V', 'Jhon Moran'       , 'Hitler y Teatrero'      		 , '5 de julio'     , '0424'		 ,'UPTAEB');
INSERT INTO 	clientes 		VALUES ('28286639','V', 'Andres Melendez'  , 'Lacayo'      				 , 'Cerrito Blanco' , '0424'		 ,'UPTAEB');
INSERT INTO 	clientes 		VALUES ('27198456','V', 'Veronica Quintero', 'Emprendedora'				 , 'Santa Elena'    , '0412'		 ,'UPTAEB');
INSERT INTO 	clientes 		VALUES ('27212503','V', 'Gabriel Oropeza'  , 'Misterioso'  			     , 'Calle 48'       , '0424'		 ,'UPTAEB');

-- PEDIDOS

INSERT INTO 	pedidos 		VALUES	('P-0000001','27210326','Facturado' ,'','01-11-2019', '19-11-2019');
INSERT INTO 	pedidos 		VALUES	('P-0000002','27085898','Facturado' ,'','01-11-2019', '19-11-2019');
INSERT INTO 	pedidos 		VALUES	('P-0000003','27317920','En Proceso','','01-11-2019', '19-11-2019');
INSERT INTO 	pedidos 		VALUES	('P-0000004','28286639','Cancelado' ,'','01-11-2019', '19-11-2019');
INSERT INTO 	pedidos 		VALUES	('P-0000005','27198456','En Proceso','','01-11-2019', '19-11-2019');
INSERT INTO 	pedidos 		VALUES	('P-0000006','27212503','Facturado' ,'','01-11-2019', '19-11-2019');

-- FACTURA

INSERT INTO 	factura_ventas 	VALUES	('1','P-0000001','27-10-2019', 'Punto'         , true  , 12);
INSERT INTO 	factura_ventas 	VALUES	('2','P-0000002','28-02-2019', 'Pago Movil'    , false ,  3);
INSERT INTO 	factura_ventas 	VALUES	('3','P-0000003','03-04-2019', 'Transferencia' , true  ,  3);

-- SERVICIOS

INSERT INTO 	servicios 		VALUES (default , 'Sublimación'       , '' , 'Area'   , 12   , 24 );
INSERT INTO 	servicios 		VALUES (default , 'Confección Textil' , '' , 'Metros' , 20.2 , 40 );
INSERT INTO 	servicios 		VALUES (default , 'Serigrafia'        , '' , 'Color'  , 10   , 20 );

-- TELAS

INSERT INTO 	telas 			VALUES (default, 'Rayon'           , '' , 'Mts' , 'Algodón'   );
INSERT INTO 	telas 			VALUES (default, 'Tonela'          , '' , 'Cm'  , 'Sintetico' );
INSERT INTO 	telas 			VALUES (default, 'Tonela Estampada', '' , 'Mts' , 'Lana'      );

-- SERVI_PEDIDOS

INSERT INTO 	servi_pedidos 	VALUES (default, 'P-0000001', 2 , 1 , 24 , 0);
INSERT INTO 	servi_pedidos 	VALUES (default, 'P-0000002', 3 , 1 , 24 , 2);
INSERT INTO 	servi_pedidos 	VALUES (default, 'P-0000002', 1 , 1 , 5  , 0);
INSERT INTO 	servi_pedidos 	VALUES (default, 'P-0000002', 2 , 1 , 1  , 0);
INSERT INTO 	servi_pedidos 	VALUES (default, 'P-0000005', 1 , 3 , 20 , 0);
INSERT INTO 	servi_pedidos 	VALUES (default, 'P-0000005', 2 , 3 , 15 , 0);
INSERT INTO 	servi_pedidos 	VALUES (default, 'P-0000005', 3 , 3 , 10 , 2);
INSERT INTO 	servi_pedidos 	VALUES (default, 'P-0000003', 2 , 2 , 12 , 0);
INSERT INTO 	servi_pedidos 	VALUES (default, 'P-0000004', 1 , 1 , 40 , 0);

-- MATERIALES

INSERT INTO 	materiales 		VALUES (default, 'Tijeras' , '' , '10'  , 2    );
INSERT INTO 	materiales 		VALUES (default, 'Hilos'   , '' , '100' , 1.50 );
INSERT INTO 	materiales 		VALUES (default, 'Agujas'  , '' , '10'  , 1    );

-- MAT_SERVICIOS

INSERT INTO 	mat_servicios 	VALUES ( 1 , 2 , 0 );
INSERT INTO 	mat_servicios 	VALUES ( 2 , 2 , 0 );
INSERT INTO 	mat_servicios 	VALUES ( 3 , 2 , 0 );
INSERT INTO 	mat_servicios 	VALUES ( 1 , 3 , 0 );
INSERT INTO 	mat_servicios 	VALUES ( 1 , 1 , 0 );
INSERT INTO 	mat_servicios 	VALUES ( 2 , 1 , 0 );
INSERT INTO 	mat_servicios 	VALUES ( 3 , 1 , 0 );

-- PRODUCTOS

INSERT INTO 	productos 		VALUES ( '1' , 'Camisa'   , 'Estampada'  , '-F' , ' ' , 10 , 20 , 5  , 100 , 5 , ' ' );
INSERT INTO 	productos 		VALUES ( '2' , 'Pantalón' , 'Blue Jeans' , '-U' , ' ' , 20 , 40 , 10 , 100 , 5 , ' ' );
INSERT INTO 	productos 		VALUES ( '3' , 'Sudadera' , 'Negra'      , '-M' , ' ' , 15 , 30 , 20 , 100 , 5 , ' ' );

-- PRO_TALLAS

INSERT INTO 	pro_tallas 		VALUES ( '1' , 1 , 5  );
INSERT INTO 	pro_tallas 		VALUES ( '2' , 2 , 10 );
INSERT INTO 	pro_tallas 		VALUES ( '3' , 5 , 20 );

-- PRO_PEDIDOS

INSERT INTO 	pro_pedidos 	VALUES ( 'P-0000001' , '3' , 5 );
INSERT INTO 	pro_pedidos 	VALUES ( 'P-0000006' , '2' , 1 );
INSERT INTO 	pro_pedidos 	VALUES ( 'P-0000006' , '3' , 1 );
INSERT INTO 	pro_pedidos 	VALUES ( 'P-0000006' , '1' , 1 );
INSERT INTO 	pro_pedidos 	VALUES ( 'P-0000001' , '2' , 1 );

INSERT INTO 	permisos 	VALUES (1 , 'REGISTRAR' , 'El usuario tendrá permiso para registrar en el módulo.' );
INSERT INTO 	permisos 	VALUES (2 , 'CONSULTAR' , 'El usuario tendrá permiso para consultar registros en el módulo.' );
INSERT INTO 	permisos 	VALUES (3 , 'ACTUALIZAR' , 'El usuario tendrá permiso para actualizar registros en el módulo.' );
INSERT INTO 	permisos 	VALUES (4 , 'ELIMINAR' , 'El usuario tendrá permiso para eliminar registros en el módulo.' );
INSERT INTO 	permisos 	VALUES (5 , 'VER DETALLES' , 'El usuario tendrá permiso para ver detalles de registros del módulo.');
INSERT INTO 	permisos 	VALUES (6 , 'REPORTES' , 'El usuario tendrá permiso para acceder a los reportes del sistema.');
