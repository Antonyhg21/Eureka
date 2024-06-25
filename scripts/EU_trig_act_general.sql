-- Crear o reemplazar un disparador para la tabla tab_deptos
CREATE OR REPLACE TRIGGER tri_act_general
    BEFORE INSERT OR UPDATE ON tab_deptos -- Antes de insertar o actualizar en tab_deptos
    FOR EACH ROW -- Para cada fila afectada
    EXECUTE PROCEDURE fun_act_general(); -- Ejecutar la función fun_act_general

-- Crear o reemplazar un disparador para la tabla tab_munics
CREATE OR REPLACE TRIGGER tri_act_general
    BEFORE INSERT OR UPDATE ON tab_munics -- Antes de insertar o actualizar en tab_munics
    FOR EACH ROW -- Para cada fila afectada
    EXECUTE PROCEDURE fun_act_general(); -- Ejecutar la función fun_act_general

-- Crear o reemplazar un disparador para la tabla tab_sitios
CREATE OR REPLACE TRIGGER tri_act_general
    BEFORE INSERT OR UPDATE ON tab_sitios -- Antes de insertar o actualizar en tab_sitios
    FOR EACH ROW -- Para cada fila afectada
    EXECUTE PROCEDURE fun_act_general(); -- Ejecutar la función fun_act_general

-- Crear o reemplazar un disparador para la tabla tab_tipo_elemento
CREATE OR REPLACE TRIGGER tri_act_general
    BEFORE INSERT OR UPDATE ON tab_tipo_elemento -- Antes de insertar o actualizar en tab_tipo_elemento
    FOR EACH ROW -- Para cada fila afectada
    EXECUTE PROCEDURE fun_act_general(); -- Ejecutar la función fun_act_general

-- Crear o reemplazar un disparador para la tabla tab_elemento
CREATE OR REPLACE TRIGGER tri_act_general
    BEFORE INSERT OR UPDATE ON tab_elemento -- Antes de insertar o actualizar en tab_elemento
    FOR EACH ROW -- Para cada fila afectada
    EXECUTE PROCEDURE fun_act_general(); -- Ejecutar la función fun_act_general

-- Crear o reemplazar un disparador para la tabla tab_usuarios
CREATE OR REPLACE TRIGGER tri_act_general
    BEFORE INSERT OR UPDATE ON tab_usuarios -- Antes de insertar o actualizar en tab_usuarios
    FOR EACH ROW -- Para cada fila afectada
    EXECUTE PROCEDURE fun_act_general(); -- Ejecutar la función fun_act_general

-- Crear o reemplazar un disparador para la tabla tab_seekfind
CREATE OR REPLACE TRIGGER tri_act_general
    BEFORE INSERT OR UPDATE ON tab_seekfind -- Antes de insertar o actualizar en tab_seekfind
    FOR EACH ROW -- Para cada fila afectada
    EXECUTE PROCEDURE fun_act_general(); -- Ejecutar la función fun_act_general

-- Crear o reemplazar un disparador para la tabla tab_novedades
CREATE OR REPLACE TRIGGER tri_act_general
    BEFORE INSERT OR UPDATE ON tab_novedades -- Antes de insertar o actualizar en tab_novedades
    FOR EACH ROW -- Para cada fila afectada
    EXECUTE PROCEDURE fun_act_general(); -- Ejecutar la función fun_act_general

-- Crear o reemplazar un disparador para la tabla tab_reportes
CREATE OR REPLACE TRIGGER tri_act_general
    BEFORE INSERT OR UPDATE ON tab_reportes -- Antes de insertar o actualizar en tab_reportes
    FOR EACH ROW -- Para cada fila afectada
    EXECUTE PROCEDURE fun_act_general(); -- Ejecutar la función fun_act_general