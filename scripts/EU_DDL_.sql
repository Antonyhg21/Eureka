    -- Me aseguro de que las tablas que crearé no existan antes de crearlas,
-- para asi aseguar una buena adaptacion de mi script DDL.

DROP TABLE IF EXISTS tab_seekfind ;
DROP TABLE IF EXISTS tab_usuarios ;
DROP TABLE IF EXISTS tab_elemento ;
DROP TABLE IF EXISTS tab_tipo_elemento ;
DROP TABLE IF EXISTS tab_sitios ;
DROP TABLE IF EXISTS tab_munics ;
DROP TABLE IF EXISTS tab_deptos ;

-- ********************************************************************
-- COMIENZO CON LA CREACION DE TABLAS, APLICANDO INTEGRIDAD REFERENCIAL
-- ********************************************************************

-- TABLA DE DEPARTAMENTOS

CREATE TABLE tab_deptos
(
    id_depto            VARCHAR(2)          NOT NULL,       -- IDENTIFICADOR ÚNICO DEL DEPARTAMENTO.
    nom_depto            VARCHAR(50)         NOT NULL,		-- NOMBRE RESPECTIVO DEL DEPARTAMENTO
    usr_insert          VARCHAR(40)         NOT NULL,
    fec_insert          TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    usr_update          VARCHAR(40),
    fec_update          TIMESTAMP WITHOUT TIME ZONE,
    PRIMARY KEY(id_depto)
);

-- TABLA DE MUNICIPIOS O CIUDADES

CREATE TABLE tab_munics
(
    id_depto            VARCHAR(2)          NOT NULL,       -- IDENTIFICADOR ÚNICO DEL DEPARTAMENTO.
    id_munic            VARCHAR(5)          NOT NULL,       -- IDENTIFICADOR ÚNICO DEL MUNICIPIO.
    nom_munic           VARCHAR(50)         NOT NULL,       -- AQUÍ IRÁ EL NOMBRE CORRESPONDIENTE DE EL MUNICIPIO.
    usr_insert          VARCHAR(40)         NOT NULL,
    fec_insert          TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    usr_update          VARCHAR(40),
    fec_update          TIMESTAMP WITHOUT TIME ZONE,
    PRIMARY KEY(id_depto, id_munic),
    FOREIGN KEY(id_depto)               REFERENCES tab_deptos(id_depto)
);
CREATE UNIQUE INDEX idx_id_munic ON tab_munics(id_munic);



-- TABLA DE SITIOS, AQUI SE AREGARAN AQUELLOS SITIOS ESPECIFICOS,
-- COMO BARRIO, LUGAR, ETC. A SU VEZ, LA DESCRIPCION Y DIRECCION DEL SITIO.

CREATE TABLE tab_sitios
(
    id_depto            VARCHAR(2)          NOT NULL,       -- IDENTIFICADOR ÚNICO DEL DEPARTAMENTO.
    id_munic            VARCHAR(5)          NOT NULL,       -- IDENTIFICADOR ÚNICO DEL MUNICIPIO.
    id_sitio            BIGINT              NOT NULL,		-- IDENTIFICADOR DEL SITIO
    nom_sitio           VARCHAR(100)        NOT NULL,		-- NOMBRE DEL SITIO
    dir_sitio           VARCHAR(150)        NOT NULL,		-- DIRECCIÓN DE UBICACIÓN DEL SITIO
    usr_insert          VARCHAR(40)         NOT NULL,
    fec_insert          TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    usr_update          VARCHAR(40),
    fec_update          TIMESTAMP WITHOUT TIME ZONE,
    PRIMARY KEY(id_munic, id_sitio),
    FOREIGN KEY(id_depto)               REFERENCES tab_deptos(id_depto),
    FOREIGN KEY(id_depto, id_munic)     REFERENCES tab_munics(id_depto, id_munic)
);

-- TABLA DE LOS TIPOS DE ELEMENTOS

CREATE TABLE tab_tipo_elemento
(
    id_tipo             BIGINT              NOT NULL,       -- IDENTIFICADOR AGREGADO POR EL SISTEMA PARA CADA TIPO DE ELEMENTO.
    nom_tipo            VARCHAR(30)         NOT NULL,       -- NOMBRE CORRESPONDIENTE A CADA TIPO DE ELEMENTOS.
    usr_insert          VARCHAR(40)         NOT NULL,
    fec_insert          TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    usr_update          VARCHAR(40),
    fec_update          TIMESTAMP WITHOUT TIME ZONE,
    PRIMARY KEY(id_tipo)
);

-- TABLAS DE LOS ELEMENTOS

CREATE TABLE tab_elemento
(
    id_tipo             BIGINT              NOT NULL,       -- IDENTIFICADOR AGREGADO POR EL SISTEMA PARA CADA TIPO DE ELEMENTO.
    id_elemento         BIGINT              NOT NULL,       -- IDENTIFICADOR AGREGADO POR EL SISTEMA PARA CADA ELEMENTO.
    nom_elemento        VARCHAR(30)         NOT NULL,       -- NOMBRE DE EL ELEMENTO.
    usr_insert          VARCHAR(40)         NOT NULL,       
    fec_insert          TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    usr_update          VARCHAR(40),
    fec_update          TIMESTAMP WITHOUT TIME ZONE,
    PRIMARY KEY(id_tipo, id_elemento),
    FOREIGN KEY(id_tipo)                REFERENCES tab_tipo_elemento(id_tipo)

);

-- TABLA DE LOS USUARIOS, DONDE SE ALMACENARAN LOS DATOS RESPECTIVOS DEL USUARIO.

CREATE TABLE tab_usuarios
(
    id_usuario          VARCHAR(100)        NOT NULL,       -- CORREO ELECTRÓNICO PROPIO DEL USUARIO.
    doc_usuario         VARCHAR(15)         NOT NULL,       -- IDENTIFICACIÓN DEL USUARIO (NÚMERO DE DOCUMENTO).
    nom_usuario         VARCHAR(40)         NOT NULL,       -- NOMBRE CORRESPONDIENTE DEL USUARIO.
    ape_usuario         VARCHAR(40)         NOT NULL,       -- APELLIDO CORRESPONDIENTE DEL USUARIO.
    pass_usuario        VARCHAR        	    NOT NULL,       -- CONTRASEÑA DE ACCESO AL SISTEMA.
    cel_usuario         VARCHAR(15)         NOT NULL,       -- NÚMERO DE CELULAR/TELÉFONO PERSONAL DEL USUARIO.
    dir_usuario         VARCHAR(150)        NOT NULL,       -- DIRECCION DE RESIDENCIA DEL USUARIO.
    id_depto            VARCHAR(2)          NOT NULL,       -- IDENTIFICADOR ÚNICO DEL DEPARTAMENTO.
    id_munic            VARCHAR(5)          NOT NULL,       -- IDENTIFICADOR ÚNICO DEL MUNICIPIO.
    usr_insert          VARCHAR(40)         NOT NULL,		-- FECHA REGISTRADA POR EL SISTEMA, SOBRE EL REGISTRO DEL USUARIO
    fec_insert          TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    usr_update          VARCHAR(40),
    fec_update          TIMESTAMP WITHOUT TIME ZONE,
    PRIMARY KEY(id_usuario),
    FOREIGN KEY(id_depto)               REFERENCES tab_deptos(id_depto),
    FOREIGN KEY(id_depto, id_munic)     REFERENCES tab_munics(id_depto,id_munic)
);

-- TABLA DE SEEKERS Y FINDERS, EN DONDE SE ALMACENARAN LOS DATOS DE LAS PÉRDIDAS O DESCUBRIMIENTOS REALIZADOS POR LOS USUARIOS.

CREATE TABLE tab_seekfind
(
    id_seekfind         INTEGER             NOT NULL,       -- IDENTIFICADOR QUE CORRESPONDERA AL NúMERO DE PUBLICACIÓN, ÉSTA LA PROPORCIONARÁ EL SISTEMA.
    id_usuario          VARCHAR(100)         NOT NULL,       -- CORREO ELECTRÓNICO PROPIO DEL USUARIO.
    id_rol_usuario     	BOOLEAN             NOT NULL,       -- DOS POSIBLES OPCIONES: 1.SEEKER(BUSCADOR/A), 0.FINDER(DESCUBRIDOR/A).
    estado_usuario      BOOLEAN             NOT NULL,       -- DOS POSIBLES OPCIONES: 1.DESCUBRIDOR, 0.DESCUBRIDOR Y BUSCADOR.
    id_tipo             BIGINT              NOT NULL,       -- IDENTIFICADOR AGREGADO POR EL SISTEMA PARA CADA TIPO DE ELEMENTO.
    id_elemento         BIGINT              NOT NULL,       -- IDENTIFICADOR AGREGADO POR EL SISTEMA PARA CADA ELEMENTO.
    desc_elemento       VARCHAR(300)       	NOT NULL,       -- DETALLES O DESCRIPCIÓN SOBRE EL ELEMENTO.
    -- foto_elemento       TEXT,                                --FOTO DE EL ELEMENTO
    id_depto            VARCHAR(2)          NOT NULL,       -- IDENTIFICADOR ÚNICO DEL DEPARTAMENTO.
    id_munic            VARCHAR(5)          NOT NULL,       -- IDENTIFICADOR ÚNICO DEL MUNICIPIO.
    id_sitio            BIGINT              NOT NULL,		-- IDENTIFICADOR DEL SITIO EN EL QUE SE PIERDE/ENCUENTRA UN ELEMENTO
	desc_sitio          VARCHAR(500)        NOT NULL,		-- DESCRIPCION DETALLADA DEL SITIO
    fecha               DATE                NOT NULL,       -- FECHA DE ENCUENTRO/DESCUBRE DEL ELEMENTO.
    hora                TIME                NOT NULL,		-- HORA EN QUE SE ENCUENTRA/DESCUBRE UN ELEMENTO.
    usr_insert          VARCHAR(40)         NOT NULL,
    fec_insert          TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    usr_update          VARCHAR(40),
    fec_update          TIMESTAMP WITHOUT TIME ZONE,
    PRIMARY KEY(id_seekfind),
    FOREIGN KEY(id_usuario)             REFERENCES tab_usuarios(id_usuario),
    FOREIGN KEY(id_tipo, id_elemento)   REFERENCES tab_elemento(id_tipo, id_elemento),
	FOREIGN KEY(id_tipo)                REFERENCES tab_tipo_elemento(id_tipo),
    FOREIGN KEY(id_depto)               REFERENCES tab_deptos(id_depto),
    FOREIGN KEY(id_depto, id_munic)     REFERENCES tab_munics(id_depto,id_munic),
    FOREIGN KEY(id_munic, id_sitio)     REFERENCES tab_sitios(id_munic, id_sitio)
);

-- TABLA DE NOVEDADES, EN DONDE SE ALMACENARAN LAS NOVEDADES DE LOS ELEMENTOS PUBLICADOS POR LOS USUARIOS.

CREATE TABLE tab_novedades
(
    id_seekfind         INTEGER             NOT NULL,       -- IDENTIFICADOR QUE CORRESPONDERA AL NúMERO DE PUBLICACIÓN, ÉSTA LA PROPORCIONARÁ EL SISTEMA.
    id_novedad          BIGINT              NOT NULL,       -- IDENTIFICADOR DE LA NOVEDAD.
    desc_novedad        VARCHAR(300)        NOT NULL,       -- DESCRIPCIÓN DE LA NOVEDAD.
    usr_insert          VARCHAR(40)         NOT NULL,
    fec_insert          TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    usr_update          VARCHAR(40),
    fec_update          TIMESTAMP WITHOUT TIME ZONE,
    PRIMARY KEY(id_novedad),
    FOREIGN KEY(id_seekfind)            REFERENCES tab_seekfind(id_seekfind),
    FOREIGN KEY(id_usuario)             REFERENCES tab_usuarios(id_usuario)
);

-- 