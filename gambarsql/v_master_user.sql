
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_master_user` 
    AS
SELECT u.`user_id`, u.`user_username`, u.`user_password`, u.`user_name`, lu.`name_level`  FROM `user` u
JOIN `level_user` lu ON lu.`user_level` = u.`user_level`
