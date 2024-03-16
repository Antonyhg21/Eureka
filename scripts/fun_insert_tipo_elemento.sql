CREATE OR REPLACE FUNCTION fun_insert_tipo_elemento(wnom_tipo tab_tipo_elemento.nom_tipo%TYPE) RETURNS BOOLEAN AS
$BODY$
DECLARE wid_tipo tab_tipo_elemento.id_tipo%TYPE;
    BEGIN
        SELECT MAX(a.id_tipo) INTO wid_tipo FROM tab_tipo_elemento AS a;
        IF wid_tipo IS NULL OR 
            wid_tipo = 0 THEN
            wid_tipo = 1;
        ELSE    
            wid_tipo = wid_tipo + 1;
        END IF;


        INSERT INTO tab_tipo_elemento VALUES(wid_tipo, wnom_tipo,  NOW());
        IF FOUND THEN
            RETURN TRUE;
        ELSE
            RETURN FLASE;
        END IF;
    END;
$BODY$
LANGUAGE PLPGSQL