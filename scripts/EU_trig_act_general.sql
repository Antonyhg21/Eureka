CREATE OR REPLACE TRIGGER tri_act_general
    BEFORE INSERT OR UPDATE ON tab_deptos
    FOR EACH ROW
    EXECUTE PROCEDURE fun_act_general();

CREATE OR REPLACE TRIGGER tri_act_general
    BEFORE INSERT OR UPDATE ON tab_munics
    FOR EACH ROW
    EXECUTE PROCEDURE fun_act_general();

CREATE OR REPLACE TRIGGER tri_act_general
    BEFORE INSERT OR UPDATE ON tab_sitios
    FOR EACH ROW
    EXECUTE PROCEDURE fun_act_general();

CREATE OR REPLACE TRIGGER tri_act_general
    BEFORE INSERT OR UPDATE ON tab_tipo_elemento
    FOR EACH ROW
    EXECUTE PROCEDURE fun_act_general();

CREATE OR REPLACE TRIGGER tri_act_general
    BEFORE INSERT OR UPDATE ON tab_elemento
    FOR EACH ROW
    EXECUTE PROCEDURE fun_act_general();

CREATE OR REPLACE TRIGGER tri_act_general
    BEFORE INSERT OR UPDATE ON tab_usuarios
    FOR EACH ROW
    EXECUTE PROCEDURE fun_act_general();

CREATE OR REPLACE TRIGGER tri_act_general
    BEFORE INSERT OR UPDATE ON tab_seekfind
    FOR EACH ROW
    EXECUTE PROCEDURE fun_act_general();


