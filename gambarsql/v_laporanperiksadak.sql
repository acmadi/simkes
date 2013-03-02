
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_laporanperiksadak` 
    AS
SELECT pd.`id_transaksi`, rk.`id_rayon`, wk.`nama_wilayah`, wk.`id_mitra` , t.`tgl_kunjungan`, t.`tgl_transaksi`, pd.idjenis_kunjungan FROM `periksa_dak` pd
JOIN `transaksi` t ON t.`id_transaksi` = pd.`id_transaksi`
JOIN `master_tertanggung` mt ON mt.`id_tertanggung` = t.`id_tertanggung`
JOIN master_karyawan mk ON mk.`id_karyawan` = mt.`id_karyawan`
JOIN `rayon_karyawan` rk ON rk.`id_rayon` = mk.`id_rayon`
JOIN `wilayah_karyawan` wk ON wk.`id_wilayah` = rk.`id_wilayah`
