/**********************************/
/* File containing the sql script */
/* with the sql schema for the    */
/* entire data base               */
/* version 1.0                    */
/* 1/25/2016                      */
/**********************************/

/*USE controlOperadora;*/

SET FOREIGN_KEY_CHECKS=0;

-- -----------------------------------------------------
-- Table Usuario
-- -----------------------------------------------------

DROP TABLE IF EXISTS usuario;

CREATE TABLE IF NOT EXISTS usuario (
	cuenta VARCHAR(10) PRIMARY KEY,
	clave VARCHAR(255) NOT NULL,
	nombre VARCHAR(30),
	apellidopaterno VARCHAR(30),
	apellidomaterno VARCHAR(30),
    grado TINYINT(1)
)
COMMENT = 'Cuentas de Usuarios del Sistema';

-- -----------------------------------------------------
-- Table Estado
-- -----------------------------------------------------
DROP TABLE IF EXISTS estado;

CREATE TABLE IF NOT EXISTS estado (
  id_estado SMALLINT NOT NULL,
  nombre_estado VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  PRIMARY KEY (id_estado)
)
COMMENT = 'Catalogo de Estados';

-- -----------------------------------------------------
-- Table institucion
-- -----------------------------------------------------
DROP TABLE IF EXISTS institucion;

CREATE TABLE IF NOT EXISTS institucion (
	/*id_institucion SMALLINT NOT NULL AUTO_INCREMENT,*/
	nombre_hotel VARCHAR(50) NOT NULL,
	clave_hotel CHAR(2) NOT NULL,

	/*PRIMARY KEY (id_institucion)*/
	PRIMARY KEY (clave_hotel)
)
COMMENT = 'Catalogo de Hoteles y agencias';

-- -----------------------------------------------------
-- Table Tours 
-- -----------------------------------------------------
DROP Table IF EXISTS tours;

CREATE TABLE IF NOT EXISTS tours (
	id_tour SMALLINT NOT NULL AUTO_INCREMENT,
	nombre_tour VARCHAR(80) NOT NULL,
	descripcion VARCHAR(255),

	PRIMARY KEY (id_tour)
) 
COMMENT = 'Catalogo de tours';

-- -----------------------------------------------------
-- Table tourHorario
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS tourHorario(
	id_tour SMALLINT NOT NULL,
	horario DATE NOT NULL,

	FOREIGN KEY (id_tour) REFERENCES tours(id_tour),
    CONSTRAINT PRIMARY KEY (id_tour, horario)

)
COMMENT = 'Horarios de los tours';

-- -----------------------------------------------------
-- Table Cliente
-- -----------------------------------------------------
DROP Table IF EXISTS cliente;

CREATE TABLE IF NOT EXISTS cliente (
	id_cliente INT NOT NULL AUTO_INCREMENT,
	nombre_cliente VARCHAR(100) NOT NULL,
	num_adultos TINYINT(1),
	num_menores TINYINT(1),
	num_insen TINYINT(1),
	num_habitacion SMALLINT,

	PRIMARY KEY (id_cliente)
) 
COMMENT = 'Almacen de clientes de los tours';

-- -----------------------------------------------------
-- Table Reserva
-- -----------------------------------------------------
DROP Table IF EXISTS reserva;

CREATE TABLE IF NOT EXISTS reserva (
	id_reserva INT NOT NULL AUTO_INCREMENT,
	cuenta_usuario VARCHAR(10) NOT NULL,
	id_cliente INT NOT NULL,
	id_tour SMALLINT NOT NULL,
	clave_institucion char(2) NOT NULL,
	fecha DATE NOT NULL,

	PRIMARY KEY (id_reserva),
	FOREIGN KEY (cuenta_usuario) REFERENCES usuario(cuenta),
	FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente),
	FOREIGN KEY (id_tour) REFERENCES tours(id_tour),
	FOREIGN KEY (clave_institucion) REFERENCES institucion(clave_hotel)

) COMMENT = 'Almacen de reservas, entrada principal de datos completos'