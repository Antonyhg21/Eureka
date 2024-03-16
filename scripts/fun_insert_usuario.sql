--SELECT fun_insert_usuarios(100,'jloca','Juana la Loca','juana123',1);
CREATE OR REPLACE FUNCTION fun_insert_usuarios(wid_usuario 	tab_usuarios.id_usuario%TYPE,
                                            wdoc_usuario 	tab_usuarios.doc_usuario%TYPE,
                                            wnom_usuario 	tab_usuarios.nom_usuario%TYPE,
                                            wape_usuario 	tab_usuarios.ape_usuario%TYPE,
                                            wpass_usuario 	tab_usuarios.pass_usuario%TYPE,
                                            wcel_usuario 	tab_usuarios.cel_usuario%TYPE,
                                            wdir_usuario 	tab_usuarios.dir_usuario%TYPE,
                                            wid_depto 		tab_usuarios.id_depto%TYPE,
                                            wid_munic 		tab_usuarios.id_munic%TYPE) RETURNS BOOLEAN AS
$BODY$
    BEGIN
        INSERT INTO tab_usuarios VALUES(wid_usuario, wdoc_usuario, wnom_usuario, wape_usuario, wpass_usuario, wcel_usuario, wdir_usuario, wid_depto, wid_munic,  NOW());
        IF FOUND THEN
            RETURN TRUE;
        ELSE
            RETURN FLASE;
        END IF;
    END;
$BODY$
LANGUAGE PLPGSQL