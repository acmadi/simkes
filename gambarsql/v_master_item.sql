
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_master_item` 
    AS
SELECT	mi.`id_item`, 
mi.`nama_item`, 
mi.`hba_item`, 
mi.`harga_item`, 
mi.`frm_item`, 
mi.`oral_item`, 
mi.`kls_item`, 
mi.`provider_item`, 
mi.`entri_item`, 
mi.`idjns_item`, 
ji.`jenis_item`  
FROM `master_item` mi
JOIN `jenis_item` ji ON ji.`idjns_item` = mi.`idjns_item`
;
