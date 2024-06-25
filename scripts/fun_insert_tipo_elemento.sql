-- Documentación de la función fun_insert_tipo_elemento
-- Esta función inserta un nuevo tipo de elemento en la tabla tab_tipo_elemento.
-- Parámetros:
--   wnom_tipo: Nombre del nuevo tipo de elemento a insertar.
-- Retorna:
--   BOOLEAN: TRUE si la inserción fue exitosa, FALSE en caso contrario.

CREATE OR REPLACE FUNCTION fun_insert_tipo_elemento(wnom_tipo tab_tipo_elemento.nom_tipo%TYPE) RETURNS BOOLEAN AS
$BODY$
DECLARE
    wid_tipo tab_tipo_elemento.id_tipo%TYPE; -- Variable para almacenar el ID que se asignará al nuevo tipo de elemento
BEGIN
    -- Selecciona el máximo ID de tipo de elemento existente y lo almacena en wid_tipo
    SELECT MAX(a.id_tipo) INTO wid_tipo FROM tab_tipo_elemento AS a;
    -- Si no se encontraron tipos de elemento existentes o el máximo ID es 0, se inicia en 1
    IF wid_tipo IS NULL OR wid_tipo = 0 THEN
        wid_tipo = 1;
    ELSE    
        -- Si se encontró un máximo ID, se incrementa en 1 para el nuevo tipo de elemento
        wid_tipo = wid_tipo + 1;
    END IF;

    -- Inserta el nuevo tipo de elemento en la tabla tab_tipo_elemento con los valores proporcionados
    INSERT INTO tab_tipo_elemento VALUES(wid_tipo, wnom_tipo, NOW());
    -- Verifica si la inserción fue exitosa
    IF FOUND THEN
        RETURN TRUE;    -- Retorna verdadero si la inserción fue exitosa
    ELSE
        RETURN FALSE;   -- Retorna falso si la inserción falló
    END IF;
END;
$BODY$
LANGUAGE PLPGSQL;