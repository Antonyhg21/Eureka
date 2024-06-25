-- Crear o reemplazar la función fun_insert_elemento
CREATE OR REPLACE FUNCTION fun_insert_elemento(
    wid_tipo        tab_elemento.id_tipo%TYPE, -- Parámetro: ID del tipo de elemento
    wnom_elemento   tab_elemento.nom_elemento%TYPE -- Parámetro: Nombre del elemento
) RETURNS BOOLEAN AS
$BODY$
DECLARE
    wid_elemento tab_elemento.id_elemento%TYPE; -- Variable para almacenar el nuevo ID de elemento
BEGIN
    -- Seleccionar el máximo ID de elemento existente y almacenarlo en wid_elemento
    SELECT MAX(a.id_elemento) INTO wid_elemento FROM tab_elemento AS a;
    -- Si no se encontraron elementos o el máximo ID es 0, iniciar en 1
    IF wid_elemento IS NULL OR wid_elemento = 0 THEN
        wid_elemento = 1;
    ELSE    
        -- Si se encontró un máximo ID, incrementarlo en 1 para el nuevo elemento
        wid_elemento = wid_elemento + 1;
    END IF;

    -- Insertar el nuevo elemento con los parámetros proporcionados y el nuevo ID
    INSERT INTO tab_elemento VALUES(wid_tipo, wid_elemento, wnom_elemento, NOW());
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