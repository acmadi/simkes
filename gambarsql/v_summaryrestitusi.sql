
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_summaryrestitusi` 
    AS
SELECT t.`tgl_transaksi`,t.`tgl_kunjungan`, rk.id_rayon,wk.id_wilayah,wk.id_mitra
FROM `simkesbaru`.`transaksi` t
LEFT JOIN `simkesbaru`.`transaksi_apotek` ta ON ta.id_transaksi = t.`id_transaksi`
LEFT JOIN `simkesbaru`.`transaksi_dokter` tdo ON tdo.id_transaksi = t.`id_transaksi`
LEFT JOIN `simkesbaru`.`transaksi_gigi` tg ON tg.id_transaksi = t.`id_transaksi`
LEFT JOIN `simkesbaru`.`transaksi_lab` tlab ON tlab.id_transaksi = t.`id_transaksi`
LEFT JOIN `simkesbaru`.`transaksi_lain` tlain ON tlain.id_transaksi = t.`id_transaksi`
LEFT JOIN `simkesbaru`.`transaksi_optik` top ON top.id_transaksi = t.`id_transaksi`
LEFT JOIN `simkesbaru`.`transaksi_penunjang` tp ON tp.id_transaksi = t.`id_transaksi`
LEFT JOIN `simkesbaru`.`transaksi_rmh_sakit` trs ON trs.id_transaksi = t.`id_transaksi`

JOIN `simkesbaru`.`master_tertanggung` mt ON mt.`id_tertanggung` = t.`id_tertanggung`
JOIN `simkesbaru`.`master_karyawan` mk ON mk.`id_karyawan` = mt.`id_karyawan`
JOIN `simkesbaru`.rayon_karyawan rk ON rk.id_rayon = mk.`id_rayon`
JOIN `simkesbaru`.wilayah_karyawan wk ON wk.id_wilayah = rk.id_wilayah
WHERE ta.restitusi = 'y' OR tdo.restitusi = 'y' OR tg.restitusi = 'y' OR tlab.restitusi = 'y' OR tlain.restitusi = 'y' OR top.restitusi = 'y' OR tp.restitusi = 'y' OR trs.restitusi = 'y'
