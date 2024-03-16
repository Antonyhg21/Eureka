CREATE TABLE tab_seekfind
(
    id_seekfind         INTEGER             NOT NULL,       -- IDENTIFICADOR QUE CORRESPONDERA AL NúMERO DE PUBLICACIÓN, ÉSTA LA PROPORCIONARÁ EL SISTEMA.
    id_usuario          VARCHAR(10)         NOT NULL,       -- IDENTIFICACIÓN DEL USUARIO (NÚMERO DE DOCUMENTO).
    id_rol_usuario     	BOOLEAN             NOT NULL,       -- DOS POSIBLES OPCIONES: 1.SEEKER(BUSCADOR/A), 0.FINDER(DESCUBRIDOR/A).
    estado_usuario      BOOLEAN             NOT NULL,       -- DOS POSIBLES OPCIONES: 1.DESCUBRIDOR, 0.DESCUBRIDOR Y BUSCADOR.
    id_tipo             BIGINT              NOT NULL,       -- IDENTIFICADOR AGREGADO POR EL SISTEMA PARA CADA TIPO DE ELEMENTO.
    id_elemento         BIGINT              NOT NULL,       -- IDENTIFICADOR AGREGADO POR EL SISTEMA PARA CADA ELEMENTO.
    desc_elemento       JSON		       	NOT NULL,       -- DETALLES O DESCRIPCIÓN SOBRE EL ELEMENTO.
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
    PRIMARY KEY(id_seekfind)

);



INSERT INTO tab_seekfind (
    id_seekfind, 
    id_usuario, 
    id_rol_usuario, 
    estado_usuario, 
    id_tipo, 
    id_elemento, 
    desc_elemento, 
    id_depto, 
    id_munic, 
    id_sitio, 
    desc_sitio, 
    fecha, 
    hora, 
    usr_insert, 
    fec_insert
) 
VALUES (
    2, 
    '1234567890', 
    TRUE, 
    FALSE, 
    100, 
    200, 
    '{"color": "rojo", "tamaño": "grande","num_boton":5}', 
    '01', 
    '001', 
    300, 
    'Cerca del parque central', 
    '2024-02-19', 
    '19:35:38', 
    'usuario1', 
    CURRENT_TIMESTAMP
);



SELECT * FROM tab_seekfind;



SELECT desc_elemento->>'num_boton' AS nombre_del_campo
FROM tab_seekfind
WHERE id_seekfind = 2;





