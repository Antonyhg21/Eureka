--SELECT fun_insert_seekfind('1','1','perro chiguagueño','68001','22','cerca a la gorda','2024-02-11','10:30:00');
CREATE OR REPLACE FUNCTION fun_insert_seekfind(wid_tipo           tab_seekfind.id_tipo%TYPE,
                                            wid_elemento        tab_seekfind.id_elemento%TYPE,
                                            wdesc_elemento      tab_seekfind.desc_elemento%TYPE,
                                            wid_munic           tab_seekfind.id_munic%TYPE,
                                            wid_sitio           tab_seekfind.id_sitio%TYPE,
                                            wdesc_sitio         tab_seekfind.desc_sitio%TYPE,
                                            wfecha              tab_seekfind.fecha%TYPE,
                                            whora               tab_seekfind.hora%TYPE) RETURNS BOOLEAN AS
$BODY$
DECLARE wid_usuario VARCHAR:='antackgondez@gmail.com';
DECLARE wid_rol_usuario BOOLEAN:='0';
DECLARE westado_usuario BOOLEAN:='1';

DECLARE wid_seekfind tab_seekfind.id_seekfind%TYPE;
DECLARE wid_depto tab_seekfind.id_depto%TYPE;
    BEGIN
        SELECT MAX(a.id_seekfind) INTO wid_seekfind FROM tab_seekfind AS a;
        IF wid_seekfind IS NULL OR 
            wid_seekfind = 0 THEN
            wid_seekfind = 1;
        ELSE    
            wid_seekfind = wid_seekfind + 1;
        END IF;

        --EXTRAER LOS DOS PRIMEROS NUMEROS DE wid_munic PARA PODER AGREGAR EL DEPARTAMENTO CON SU CODIGO POSTAL
        wid_depto := SUBSTRING(wid_munic::TEXT, 1, 2);


        INSERT INTO tab_seekfind VALUES(wid_seekfind, wid_usuario, wid_rol_usuario, westado_usuario, wid_tipo, wid_elemento, wdesc_elemento, wid_depto, wid_munic, wid_sitio, wdesc_sitio, wfecha, whora,  NOW());
        IF FOUND THEN
            RETURN TRUE;
        ELSE
            RETURN FLASE;
        END IF;
		
		
		IF FOUND THEN
			RAISE NOTICE 'INSERTADO EL SEEKFIND... VAMOS BIEN, VAMOS BIEN.';
			RETURN 1;
		ELSE
			RAISE NOTICE 'ERROR, NO PUDO SER INSERTADO EL SEEKFIND... VAMOS MAL, VAMOS MAL.';
			RETURN 0;
		END IF;
    END;
$BODY$
LANGUAGE PLPGSQL