CREATE OR REPLACE FUNCTION fun_update_usuarios(
    wid_usuario     tab_usuarios.id_usuario%TYPE,       -- ID del usuario a actualizar.
    wemail_usuario  tab_usuarios.email_usuario%TYPE,    -- Nuevo e-mail de el usuario.
    wdoc_usuario    tab_usuarios.doc_usuario%TYPE,      -- Nuevo documento de identidad del usuario.
    wnom_usuario    tab_usuarios.nom_usuario%TYPE,      -- Nuevo nombre del usuario.
    wape_usuario    tab_usuarios.ape_usuario%TYPE,      -- Nuevo apellido del usuario.
    wcel_usuario    tab_usuarios.cel_usuario%TYPE,      -- Nuevo número de celular del usuario.
    wdir_usuario    tab_usuarios.dir_usuario%TYPE,      -- Nueva dirección del usuario.
    wid_depto       tab_usuarios.id_depto%TYPE,         -- Nuevo ID del departamento asociado al usuario.
    wid_munic       tab_usuarios.id_munic%TYPE          -- Nuevo ID del municipio asociado al usuario.
) RETURNS BOOLEAN AS
$BODY$
BEGIN
    -- Actualiza la información del usuario especificado por wid_usuario.
    UPDATE tab_usuarios SET 
        doc_usuario     = wdoc_usuario,     -- Actualiza el documento de identidad del usuario.
        nom_usuario     = wnom_usuario,     -- Actualiza el nombre del usuario.
        ape_usuario     = wape_usuario,     -- Actualiza el apellido del usuario.
        cel_usuario     = wcel_usuario,     -- Actualiza el número de celular del usuario.
        dir_usuario     = wdir_usuario,     -- Actualiza la dirección del usuario.
        id_depto        = wid_depto,        -- Actualiza el ID del departamento asociado al usuario.
        id_munic        = wid_munic         -- Actualiza el ID del municipio asociado al usuario.
    WHERE id_usuario = wid_usuario;    -- Se verifica que los datos a actualizar sean los datos correspondientes al usuario deseado. 
    -- Verifica si la actualización fue exitosa.
    IF FOUND THEN
        RETURN TRUE;    -- Retorna verdadero si la actualización fue exitosa.
    ELSE
        RETURN FALSE;   -- Retorna falso si la actualización falló.
    END IF;
END;
$BODY$
LANGUAGE PLPGSQL