
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_summaryrawatinap` 
    AS
SELECT t.`tgl_transaksi`,t.`tgl_kunjungan`,mk.`id_rayon`,rk.id_wilayah,wk.id_mitra 
FROM `simkesbaru`.transaksi_rmh_sakit trs
JOIN `simkesbaru`.`transaksi` t ON t.`id_transaksi` = trs.id_transaksi 
JOIN `simkesbaru`.`master_tertanggung` mt ON mt.`id_tertanggung` = t.`id_tertanggung`
JOIN `simkesbaru`.`master_karyawan` mk ON mk.`id_karyawan` = mt.`id_karyawan`
JOIN `simkesbaru`.rayon_karyawan rk ON rk.id_rayon = mk.`id_rayon`
JOIN `simkesbaru`.wilayah_karyawan wk ON wk.id_wilayah = rk.id_wilayah
WHERE trs.idjenis_rawat = 1