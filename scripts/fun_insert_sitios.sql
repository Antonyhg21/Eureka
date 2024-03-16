CREATE OR REPLACE FUNCTION fun_insert_sitios(wid_depto    tab_sitios.id_depto%TYPE,
                                            wid_munic       tab_sitios.id_munic%TYPE,
                                            wnom_sitio      tab_sitios.nom_sitio%TYPE,
                                            wdir_sitio      tab_sitios.dir_sitio%TYPE) RETURNS BOOLEAN AS
$BODY$
DECLARE wid_sitio tab_sitios.id_sitio%TYPE;
    BEGIN
            SELECT MAX(a.id_sitio) INTO wid_sitio FROM tab_sitios AS a;
        IF wid_sitio IS NULL OR 
            wid_sitio = 0 THEN
            wid_sitio = 1;
        ELSE    
            wid_sitio = wid_sitio + 1;
        END IF;

        
        INSERT INTO tab_sitios VALUES(wid_depto, wid_munic, wid_sitio, wnom_sitio, wdir_sitio,  NOW());
        IF FOUND THEN
            RETURN TRUE;
        ELSE
            RETURN FLASE;
        END IF;
    END;
$BODY$
LANGUAGE PLPGSQL