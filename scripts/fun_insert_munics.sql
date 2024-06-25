-- Crear o reemplazar la función fun_insert_munics
CREATE OR REPLACE FUNCTION fun_insert_munics(
    wid_depto       tab_munics.id_depto%TYPE, -- Parámetro: ID del departamento
    wid_munic       tab_munics.id_munic%TYPE, -- Parámetro: ID del municipio
    wnom_munic      tab_munics.nom_munic%TYPE -- Parámetro: Nombre del departamento
) RETURNS BOOLEAN AS
$BODY$

BEGIN
    -- Insertar el nuevo municipio con los parámetros proporcionados y el nuevo ID, y el ID del departamento
    INSERT INTO tab_munics VALUES(wid_depto, wid_munic, wnom_munic, NOW());
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