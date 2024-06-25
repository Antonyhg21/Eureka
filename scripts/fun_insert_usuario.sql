CREATE OR REPLACE FUNCTION fun_insert_usuarios(
    wemail_usuario  tab_usuarios.email_usuario%TYPE,    -- Email del usuario.
    wdoc_usuario    tab_usuarios.doc_usuario%TYPE,      -- Documento de identidad del usuario.
    wnom_usuario    tab_usuarios.nom_usuario%TYPE,      -- Nombre del usuario.
    wape_usuario    tab_usuarios.ape_usuario%TYPE,      -- Apellido del usuario.
    wpass_usuario   tab_usuarios.pass_usuario%TYPE,     -- Contraseña del usuario.
    wcel_usuario    tab_usuarios.cel_usuario%TYPE,      -- Número de celular del usuario.
    wdir_usuario    tab_usuarios.dir_usuario%TYPE,      -- Dirección del usuario.
    wid_depto       tab_usuarios.id_depto%TYPE,         -- ID del departamento asociado al usuario.
    wid_munic       tab_usuarios.id_munic%TYPE          -- ID del municipio asociado al usuario.
) RETURNS BOOLEAN AS
$BODY$
DECLARE wid_usuario tab_usuarios.id_usuario%TYPE;

BEGIN
    -- Selecciona el máximo ID de usuario existente y lo almacena en wid_usuario.
    SELECT MAX(a.id_usuario) INTO wid_usuario FROM tab_usuarios AS a;
    -- Si no se encontraron usuarios existentes o el máximo ID es 0, se inicia en 10000.
    IF wid_usuario IS NULL OR wid_usuario = 0 THEN
        wid_usuario = 10000;
    ELSE    
        -- Si se encontró un máximo ID, se incrementa en 1 para el nuevo usuario.
        wid_usuario = wid_usuario + 1;
    END IF;

    -- Inserta el nuevo usuario en la tabla tab_usuarios con los valores proporcionados.
    INSERT INTO tab_usuarios VALUES(wid_usuario, wemail_usuario, wdoc_usuario, wnom_usuario, 
    wape_usuario, wpass_usuario, wcel_usuario, wdir_usuario, wid_depto, wid_munic, NOW());
    -- Verifica si la inserción fue exitosa.
    IF FOUND THEN
        RETURN TRUE;    -- Retorna verdadero si la inserción fue exitosa.
    ELSE
        RETURN FALSE;   -- Retorna falso si la inserción falló.
    END IF;
END;
$BODY$
LANGUAGE PLPGSQL