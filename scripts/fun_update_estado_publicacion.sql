-- Actualiza el estado de una publicación en la tabla tab_seekfind.
-- Ésto si el usuario ha dejado de buscar su elemento.
CREATE OR REPLACE FUNCTION fun_update_estado_publicacion(
    wid_seekfind        tab_seekfind.id_seekfind%TYPE,      -- ID de la publicación a actualizar.
    westado_usuario     tab_seekfind.estado_usuario%TYPE    -- Nuevo estado para la publicación.
) RETURNS BOOLEAN AS
$BODY$
BEGIN
    -- Actualiza el estado de la publicación especificada por wid_seekfind.
    UPDATE tab_seekfind SET estado_usuario = westado_usuario
    WHERE id_seekfind = wid_seekfind;
    -- Verifica si la actualización fue exitosa.
    IF FOUND THEN
        RETURN TRUE;    -- Retorna verdadero si la actualización fue exitosa.
    ELSE
        RETURN FALSE;   -- Retorna falso si la actualización falló.
    END IF;
END;
$BODY$
LANGUAGE PLPGSQL