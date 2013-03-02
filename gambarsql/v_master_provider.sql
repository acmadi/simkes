
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_master_provider` 
    AS
(SELECT 
 mp.`id_provider`,
 mp.`nama_provider`,
 IF(mp.`langg_provider` = 'y','Berlangganan','Tidak') AS langg_provider,
 mp.`almt_provider`,
 mp.`email_provider`,
 mp.`tlp_provider`,
 mp.`fax_provider`,
 mp.`idjenis_provider`
 
 FROM `master_provider` mp);
