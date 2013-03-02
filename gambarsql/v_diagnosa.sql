
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_diagnosa` 
    AS
   SELECT td.`id_transaksi`, md.`nama_diagnosa`, md.`id_diagnosa`, td.`id_transaksi_diagnosa`
FROM `transaksi_diagnosa` td
JOIN `master_diagnosa` md ON md.`id_diagnosa` = td.`id_diagnosa`