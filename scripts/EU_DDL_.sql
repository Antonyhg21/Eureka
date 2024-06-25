-- Me aseguro de que las tablas que crearé no existan antes de crearlas,
-- para asi asegurar una buena adaptacion de mi script DDL.

DROP TABLE IF EXISTS tab_reportes;
DROP TABLE IF EXISTS tab_novedades;
DROP TABLE IF EXISTS tab_seekfind;
DROP TABLE IF EXISTS tab_usuarios;
DROP TABLE IF EXISTS tab_elemento;
DROP TABLE IF EXISTS tab_tipo_elemento;
DROP TABLE IF EXISTS tab_sitios;
DROP TABLE IF EXISTS tab_munics;
DROP TABLE IF EXISTS tab_deptos;

-- ********************************************************************
-- COMIENZO CON LA CREACION DE TABLAS, APLICANDO INTEGRIDAD REFERENCIAL
-- ********************************************************************

-- TABLA DE DEPARTAMENTOS

CREATE TABLE tab_deptos
(
    id_depto            VARCHAR(2)                  NOT NULL,       -- IDENTIFICADOR ÚNICO DEL DEPARTAMENTO.
    nom_depto           VARCHAR(50)                 NOT NULL,       -- NOMBRE RESPECTIVO DEL DEPARTAMENTO
    usr_insert          VARCHAR(40)                 NOT NULL,
    fec_insert          TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    usr_update          VARCHAR(40),
    fec_update          TIMESTAMP WITHOUT TIME ZONE,
    PRIMARY KEY (id_depto)
);

-- TABLA DE MUNICIPIOS O CIUDADES

CREATE TABLE tab_munics
(
    id_depto            VARCHAR(2)                  NOT NULL,       -- IDENTIFICADOR ÚNICO DEL DEPARTAMENTO.
    id_munic            VARCHAR(5)                  NOT NULL,       -- IDENTIFICADOR ÚNICO DEL MUNICIPIO.
    nom_munic           VARCHAR(50)                 NOT NULL,       -- NOMBRE DEL MUNICIPIO.
    usr_insert          VARCHAR(40)                 NOT NULL,
    fec_insert          TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    usr_update          VARCHAR(40),
    fec_update          TIMESTAMP WITHOUT TIME ZONE,
    PRIMARY KEY (id_depto, id_munic),
    FOREIGN KEY (id_depto) REFERENCES tab_deptos(id_depto)
);

-- TABLA DE SITIOS

CREATE TABLE tab_sitios
(
    id_depto            VARCHAR(2)                  NOT NULL,       -- IDENTIFICADOR ÚNICO DEL DEPARTAMENTO.
    id_munic            VARCHAR(5)                  NOT NULL,       -- IDENTIFICADOR ÚNICO DEL MUNICIPIO.
    id_sitio            BIGINT                      NOT NULL,       -- IDENTIFICADOR DEL SITIO
    nom_sitio           VARCHAR(100)                NOT NULL,       -- NOMBRE DEL SITIO
    dir_sitio           VARCHAR(150)                NOT NULL,       -- DIRECCIÓN DEL SITIO
    usr_insert          VARCHAR(40)                 NOT NULL,
    fec_insert          TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    usr_update          VARCHAR(40),
    fec_update          TIMESTAMP WITHOUT TIME ZONE,
    PRIMARY KEY (id_munic, id_sitio),
    FOREIGN KEY (id_depto) REFERENCES tab_deptos(id_depto),
    FOREIGN KEY (id_depto, id_munic) REFERENCES tab_munics(id_depto, id_munic)
);

-- TABLA DE TIPOS DE ELEMENTOS

CREATE TABLE tab_tipo_elemento
(
    id_tipo             BIGINT                      NOT NULL,       -- IDENTIFICADOR DE TIPO DE ELEMENTO.
    nom_tipo            VARCHAR(30)                 NOT NULL,       -- NOMBRE DEL TIPO DE ELEMENTO.
    usr_insert          VARCHAR(40)                 NOT NULL,
    fec_insert          TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    usr_update          VARCHAR(40),
    fec_update          TIMESTAMP WITHOUT TIME ZONE,
    PRIMARY KEY (id_tipo)
);

-- TABLAS DE LOS ELEMENTOS

CREATE TABLE tab_elemento
(
    id_tipo             BIGINT                      NOT NULL,       -- IDENTIFICADOR DE TIPO DE ELEMENTO.
    id_elemento         BIGINT                      NOT NULL,       -- IDENTIFICADOR DE ELEMENTO.
    nom_elemento        VARCHAR(30)                 NOT NULL,       -- NOMBRE DEL ELEMENTO.
    usr_insert          VARCHAR(40)                 NOT NULL,       
    fec_insert          TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    usr_update          VARCHAR(40),
    fec_update          TIMESTAMP WITHOUT TIME ZONE,
    PRIMARY KEY (id_tipo, id_elemento),
    FOREIGN KEY (id_tipo) REFERENCES tab_tipo_elemento(id_tipo)
);

-- TABLA DE LOS USUARIOS

CREATE TABLE tab_usuarios
(
    id_usuario          BIGINT                      NOT NULL,       -- IDENTIFICADOR DEL USUARIO.
    email_usuario       VARCHAR(100)                NOT NULL,       -- CORREO ELECTRÓNICO DEL USUARIO.
    doc_usuario         VARCHAR(15)                 NOT NULL,       -- DOCUMENTO DEL USUARIO.
    nom_usuario         VARCHAR(40)                 NOT NULL,       -- NOMBRE DEL USUARIO.
    ape_usuario         VARCHAR(40)                 NOT NULL,       -- APELLIDO DEL USUARIO.
    pass_usuario        VARCHAR(100)                NOT NULL,       -- CONTRASEÑA DEL USUARIO.
    cel_usuario         VARCHAR(15)                 NOT NULL,       -- TELÉFONO DEL USUARIO.
    dir_usuario         VARCHAR(150)                NOT NULL,       -- DIRECCIÓN DEL USUARIO.
    id_depto            VARCHAR(2)                  NOT NULL,       -- IDENTIFICADOR DEL DEPARTAMENTO.
    id_munic            VARCHAR(5)                  NOT NULL,       -- IDENTIFICADOR DEL MUNICIPIO.
    usr_insert          VARCHAR(40)                 NOT NULL,
    fec_insert          TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    usr_update          VARCHAR(40),
    fec_update          TIMESTAMP WITHOUT TIME ZONE,
    PRIMARY KEY (id_usuario),
    FOREIGN KEY (id_depto) REFERENCES tab_deptos(id_depto),
    FOREIGN KEY (id_depto, id_munic) REFERENCES tab_munics(id_depto, id_munic)
);
CREATE UNIQUE INDEX idx_email_usuario ON tab_usuarios(email_usuario);

-- TABLA DE SEEKERS Y FINDERS

CREATE TABLE tab_seekfind
(
    id_seekfind         INTEGER                     NOT NULL,       -- IDENTIFICADOR DE PUBLICACIÓN.
    id_usuario          BIGINT                      NOT NULL,       -- IDENTIFICADOR DEL USUARIO.
    id_rol_usuario      BOOLEAN                     NOT NULL,       -- ROL DEL USUARIO.
    estado_usuario      BOOLEAN                     NOT NULL,       -- ESTADO DEL USUARIO.
    id_tipo             BIGINT                      NOT NULL,       -- IDENTIFICADOR DE TIPO DE ELEMENTO.
    id_elemento         BIGINT                      NOT NULL,       -- IDENTIFICADOR DE ELEMENTO.
    desc_elemento       VARCHAR(300)                NOT NULL,       -- DESCRIPCIÓN DEL ELEMENTO.
    id_depto            VARCHAR(2)                  NOT NULL,       -- IDENTIFICADOR DEL DEPARTAMENTO.
    id_munic            VARCHAR(5)                  NOT NULL,       -- IDENTIFICADOR DEL MUNICIPIO.
    id_sitio            BIGINT                      NOT NULL,       -- IDENTIFICADOR DEL SITIO.
    desc_sitio          VARCHAR(500)                NOT NULL,       -- DESCRIPCIÓN DEL SITIO.
    fecha               DATE                        NOT NULL,       -- FECHA.
    hora                TIME                        NOT NULL,       -- HORA.
    usr_insert          VARCHAR(40)                 NOT NULL,
    fec_insert          TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    usr_update          VARCHAR(40),
    fec_update          TIMESTAMP WITHOUT TIME ZONE,
    PRIMARY KEY (id_seekfind),
    FOREIGN KEY (id_usuario) REFERENCES tab_usuarios(id_usuario),
    FOREIGN KEY (id_tipo, id_elemento) REFERENCES tab_elemento(id_tipo, id_elemento),
    FOREIGN KEY (id_depto) REFERENCES tab_deptos(id_depto),
    FOREIGN KEY (id_depto, id_munic) REFERENCES tab_munics(id_depto, id_munic),
    FOREIGN KEY (id_munic, id_sitio) REFERENCES tab_sitios(id_munic, id_sitio)
);

-- TABLA DE NOVEDADES

CREATE TABLE tab_novedades
(
    id_seekfind         INTEGER                     NOT NULL,       -- IDENTIFICADOR DE PUBLICACIÓN.
    id_usuario          BIGINT                      NOT NULL,       -- IDENTIFICADOR DEL USUARIO.
    id_novedad          BIGINT                      NOT NULL,       -- IDENTIFICADOR DE LA NOVEDAD.
    desc_novedad        VARCHAR(300)                NOT NULL,       -- DESCRIPCIÓN DE LA NOVEDAD.
    usr_insert          VARCHAR(40)                 NOT NULL,
    fec_insert          TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    usr_update          VARCHAR(40),
    fec_update          TIMESTAMP WITHOUT TIME ZONE,
    PRIMARY KEY (id_novedad),
    FOREIGN KEY (id_seekfind) REFERENCES tab_seekfind(id_seekfind),
    FOREIGN KEY (id_usuario) REFERENCES tab_usuarios(id_usuario)
);

-- TABLA DE REPORTES

CREATE TABLE tab_reportes
(
    id_reporte              BIGINT                      NOT NULL,       -- IDENTIFICADOR DEL REPORTE.
    id_seekfind             INTEGER                     NOT NULL,       -- IDENTIFICADOR DE LA PUBLICACIÓN.
    id_usuario_reporta      BIGINT                      NOT NULL,       -- IDENTIFICADOR DEL USUARIO QUE REPORTA.
    id_usuario_reportado    BIGINT                      NOT NULL,       -- IDENTIFICADOR DEL USUARIO REPORTADO.
    motivo                  VARCHAR(100)                NOT NULL,       -- MOTIVO DEL REPORTE.
    usr_insert              VARCHAR(40)                 NOT NULL,
    fec_insert              TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    usr_update              VARCHAR(40),
    fec_update              TIMESTAMP WITHOUT TIME ZONE,
    PRIMARY KEY (id_reporte),
    FOREIGN KEY (id_seekfind) REFERENCES tab_seekfind(id_seekfind),
    FOREIGN KEY (id_usuario_reporta) REFERENCES tab_usuarios(id_usuario),
    FOREIGN KEY (id_usuario_reportado) REFERENCES tab_usuarios(id_usuario)
);

-- TABLA DE NOTIFICACIONES

CREATE TABLE tab_notificaciones (
    id_notificacion         BIGINT                      PRIMARY KEY,    -- IDENTIFICADOR ÚNICO PARA CADA NOTIFICACIÓN.
    id_usuario              BIGINT                      NOT NULL,       -- IDENTIFICADOR DEL USUARIO AL QUE ESTÁ DIRIGIDA LA NOTIFICACIÓN (CLAVE FORÁNEA).
    titulo                  VARCHAR(255)                NOT NULL,       -- TÍTULO BREVE DE LA NOTIFICACIÓN.
    mensaje                 TEXT                        NOT NULL,       -- MENSAJE O CONTENIDO DE LA NOTIFICACIÓN.
    fecha_creacion          TIMESTAMP WITHOUT TIME ZONE NOT NULL,       -- FECHA Y HORA EN QUE SE CREÓ LA NOTIFICACIÓN.
    leido                   BOOLEAN                     NOT NULL DEFAULT FALSE, -- INDICA SI EL USUARIO HA LEÍDO LA NOTIFICACIÓN (FALSE POR DEFECTO).
    tipo_notificacion       VARCHAR(50)                 NOT NULL,       -- TIPO DE NOTIFICACIÓN (E.G., SISTEMA, PUBLICACIONES).
    FOREIGN KEY (id_usuario) REFERENCES tab_usuarios(id_usuario)        -- RELACIÓN CON LA TABLA DE USUARIOS.
);