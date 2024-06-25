-- Creación de la función fun_insert_sitios para insertar nuevos sitios en la tabla tab_sitios
CREATE OR REPLACE FUNCTION fun_insert_sitios(
    wid_depto    tab_sitios.id_depto%TYPE,    -- ID del departamento donde se encuentra el sitio
    wid_munic    tab_sitios.id_munic%TYPE,    -- ID del municipio donde se encuentra el sitio
    wnom_sitio   tab_sitios.nom_sitio%TYPE,   -- Nombre del sitio a insertar
    wdir_sitio   tab_sitios.dir_sitio%TYPE    -- Dirección del sitio a insertar
) RETURNS BOOLEAN AS
$BODY$
DECLARE wid_sitio tab_sitios.id_sitio%TYPE; -- Variable para almacenar el ID que se asignará al nuevo sitio

BEGIN
    -- Selecciona el máximo ID de sitio existente y lo almacena en wid_sitio
    SELECT MAX(a.id_sitio) INTO wid_sitio FROM tab_sitios AS a;
    -- Si no se encontraron sitios existentes o el máximo ID es 0, se inicia en 1
    IF wid_sitio IS NULL OR wid_sitio = 0 THEN
        wid_sitio = 1;
    ELSE
        -- Si se encontró un máximo ID, se incrementa en 1 para el nuevo sitio
        wid_sitio = wid_sitio + 1;
    END IF;

    -- Inserta el nuevo sitio en la tabla tab_sitios con los valores proporcionados
    INSERT INTO tab_sitios VALUES(wid_depto, wid_munic, wid_sitio, wnom_sitio, wdir_sitio, NOW());
    -- Verifica si la inserción fue exitosa
    IF FOUND THEN
        RETURN TRUE; -- Retorna verdadero si la inserción fue exitosa
    ELSE
        RETURN FALSE; -- Retorna falso si la inserción falló
    END IF;
END;
$BODY$
LANGUAGE PLPGSQL;