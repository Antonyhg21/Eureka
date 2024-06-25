-- Crear o reemplazar la función fun_insert_deptos
CREATE OR REPLACE FUNCTION fun_insert_deptos(
    wid_depto       tab_deptos.id_depto%TYPE, -- Parámetro: ID del departamento
    wnom_depto      tab_deptos.nom_depto%TYPE -- Parámetro: Nombre del departamento
) RETURNS BOOLEAN AS
$BODY$
BEGIN
    -- Insertar el nuevo departamento con los parámetros proporcionados y el nuevo ID
    INSERT INTO tab_deptos VALUES(wid_depto, wnom_depto, NOW());
    -- Si la inserción fue exitosa, retornar TRUE
    IF FOUND THEN
        RETURN TRUE;
    ELSE
        -- Si la inserción falló, retornar FALSE
        RETURN FALSE;
    END IF;
END;
$BODY$
LANGUAGE PLPGSQL;