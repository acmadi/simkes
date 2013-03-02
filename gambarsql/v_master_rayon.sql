
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_master_rayon` 
    AS
SELECT rk.id_rayon,rk.nama_rayon,wk.id_wilayah, wk.nama_wilayah, wk.id_mitra FROM `rayon_karyawan` rk
JOIN `wilayah_karyawan` wk ON wk.`id_wilayah` = rk.`id_wilayah`;
