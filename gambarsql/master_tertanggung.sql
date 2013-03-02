
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_master_tertanggung` 
    AS
SELECT mt.`id_tertanggung`, mt.`nama_tertanggung`, mt.`sex`, mt.`tgl_lahir`, mt.`usia`, mt.`status`,mt.`ditanggung`, mk.`nama_karyawan`, mk.`id_rayon`, rk.`id_wilayah`,wk.`id_mitra`
FROM
`simkesbaru`.`master_tertanggung` mt
JOIN
`simkesbaru`.master_karyawan mk ON mk.`id_karyawan` = mt.`id_karyawan`
JOIN
`simkesbaru`.`rayon_karyawan` rk ON rk.`id_rayon` = mk.`id_rayon`
JOIN
`simkesbaru`.`wilayah_karyawan` wk ON wk.`id_wilayah` = rk.`id_wilayah`;
