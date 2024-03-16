CREATE OR REPLACE FUNCTION fun_insert_elemento(wid_tipo    tab_elemento.id_tipo%TYPE,
                                            wnom_elemento   tab_elemento.nom_elemento%TYPE) RETURNS BOOLEAN AS
$BODY$
DECLARE wid_elemento tab_elemento.id_elemento%TYPE;
    BEGIN
        SELECT MAX(a.id_elemento) INTO wid_elemento FROM tab_elemento AS a;
        IF wid_elemento IS NULL OR 
            wid_elemento = 0 THEN
            wid_elemento = 1;
        ELSE    
            wid_elemento = wid_elemento + 1;
        END IF;

        INSERT INTO tab_elemento VALUES(wid_tipo, wid_elemento, wnom_elemento,  NOW());
        IF FOUND THEN
            RETURN TRUE;
        ELSE
            RETURN FLASE;
        END IF;
    END;
$BODY$
LANGUAGE PLPGSQL