CREATE OR REPLACE FUNCTION fun_update_usuarios(wid_usuario tab_usuarios.id_usuario%TYPE,
                                            wdoc_usuario tab_usuarios.doc_usuario%TYPE,
                                            wnom_usuario tab_usuarios.nom_usuario%TYPE,
                                            wape_usuario tab_usuarios.ape_usuario%TYPE,
                                            wcel_usuario tab_usuarios.cel_usuario%TYPE,
                                            wdir_usuario tab_usuarios.dir_usuario%TYPE,
                                            wid_depto tab_usuarios.id_depto%TYPE,
                                            wid_munic tab_usuarios.id_munic%TYPE) RETURNS BOOLEAN AS
$BODY$
	BEGIN
        UPDATE tab_usuarios SET id_usuario      = wid_usuario,
                                doc_usuario     = wdoc_usuario,
                                nom_usuario     = wnom_usuario,
                                ape_usuario     = wape_usuario,
                                cel_usuario     = wcel_usuario,
                                dir_usuario     = wdir_usuario,
                                id_depto        = wid_depto,
                                id_munic        = wid_munic
        WHERE id_usuario = wid_usuario;
        IF FOUND THEN
            RETURN TRUE;
        ELSE
            RETURN FALSE;
        END IF;
    END;
$BODY$
LANGUAGE PLPGSQL