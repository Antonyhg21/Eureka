CREATE OR REPLACE FUNCTION fun_act_general() RETURNS "trigger" AS
$$
BEGIN
-- Analisis del tipo de actividad sobre la tabla (Insercion y/o borrado)
 IF (TG_OP = 'INSERT') THEN
    IF NEW.usr_insert IS NULL THEN
       NEW.usr_insert := CURRENT_USER;
    END IF;
    NEW.fec_insert := CURRENT_TIMESTAMP;
 END IF;
 IF (TG_OP = 'UPDATE') THEN
    IF NEW.usr_update IS NULL THEN
       NEW.usr_update := current_user;
    END IF;
    NEW.fec_update := current_timestamp;
 END IF;
 RETURN NEW;
END;
$$
LANGUAGE plpgsql;