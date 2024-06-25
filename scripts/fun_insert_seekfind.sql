-- Corrección de errores y mejoras en la función fun_insert_seekfind
CREATE OR REPLACE FUNCTION fun_insert_seekfind(
    wid_usuario     tab_seekfind.id_usuario%TYPE,
    wid_tipo        tab_seekfind.id_tipo%TYPE,
    wid_elemento    tab_seekfind.id_elemento%TYPE,
    wdesc_elemento  tab_seekfind.desc_elemento%TYPE,
    wid_depto       tab_seekfind.id_depto%TYPE,
    wid_munic       tab_seekfind.id_munic%TYPE,
    wid_sitio       tab_seekfind.id_sitio%TYPE,
    wdesc_sitio     tab_seekfind.desc_sitio%TYPE,
    wfecha          tab_seekfind.fecha%TYPE,
    whora           tab_seekfind.hora%TYPE
) RETURNS BOOLEAN AS
$BODY$
DECLARE
    wid_rol_usuario BOOLEAN := '0'; -- Inicialización incorrecta, BOOLEAN no admite '0' o '1'
    westado_usuario BOOLEAN := '1'; -- Inicialización incorrecta, BOOLEAN no admite '0' o '1'

    wid_seekfind tab_seekfind.id_seekfind%TYPE;
BEGIN
    -- Obtener el máximo id_seekfind existente y asignarlo a wid_seekfind
    SELECT MAX(a.id_seekfind) INTO wid_seekfind FROM tab_seekfind AS a;
    IF wid_seekfind IS NULL OR wid_seekfind = 0 THEN
        wid_seekfind := 1; -- Inicializar en 1 si no hay registros
    ELSE    
        wid_seekfind := wid_seekfind + 1; -- Incrementar en 1 para el nuevo registro
    END IF;

    -- Intento de extracción de los dos primeros números de wid_munic comentado
    -- wid_depto := SUBSTRING(wid_munic::TEXT, 1, 2);

    -- Inserción en tab_seekfind con los valores proporcionados
    INSERT INTO tab_seekfind VALUES(wid_seekfind, wid_usuario, wid_rol_usuario, westado_usuario, wid_tipo, wid_elemento, wdesc_elemento, wid_depto, wid_munic, wid_sitio, wdesc_sitio, wfecha, whora, NOW());
    
    -- Verificación de la inserción
    IF FOUND THEN
        RAISE NOTICE 'INSERTADO EL SEEKFIND... VAMOS BIEN, VAMOS BIEN.';
        RETURN TRUE; -- Corregir "FLASE" a "TRUE"
    ELSE
        RAISE NOTICE 'ERROR, NO PUDO SER INSERTADO EL SEEKFIND... VAMOS MAL, VAMOS MAL.';
        RETURN FALSE; -- Corregir "0" a "FALSE"
    END IF;
END;
$BODY$
LANGUAGE PLPGSQL;