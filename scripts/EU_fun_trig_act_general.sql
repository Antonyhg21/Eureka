-- Crear o reemplazar la función fun_act_general
CREATE OR REPLACE FUNCTION fun_act_general() RETURNS "trigger" AS
$$
BEGIN
   -- Si la operación es una inserción
   IF (TG_OP = 'INSERT') THEN
      -- Si el usuario que realiza la inserción no está definido
      IF NEW.usr_insert IS NULL THEN
         NEW.usr_insert := CURRENT_USER;     -- Establecer el usuario que realiza la inserción como el usuario actual
      END IF;
      NEW.fec_insert := CURRENT_TIMESTAMP;   -- Establecer la fecha y hora de la inserción como el momento actual
   END IF;
   
   -- Si la operación es una actualización
   IF (TG_OP = 'UPDATE') THEN
      -- Si el usuario que realiza la actualización no está definido
      IF NEW.usr_update IS NULL THEN
         NEW.usr_update := current_user;     -- Establecer el usuario que realiza la actualización como el usuario actual
      END IF;
      NEW.fec_update := current_timestamp;   -- Establecer la fecha y hora de la actualización como el momento actual
   END IF;
   
   RETURN NEW; -- Devolver el nuevo registro modificado
END;
$$
LANGUAGE plpgsql;