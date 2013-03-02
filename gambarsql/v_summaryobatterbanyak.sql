
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_summaryobatterbanyak` 
    AS
SELECT t.`id_transaksi`,mi.`nama_item`,rk.id_rayon,rk.id_wilayah,wk.id_mitra,t.`tgl_kunjungan`,t.`tgl_transaksi`
FROM
`simkesbaru`.`transaksi` t
LEFT JOIN `simkesbaru`.`item_transaksi_apotek` ita ON ita.`id_transaksi` = t.`id_transaksi`
LEFT JOIN `simkesbaru`.`item_transaksi_dak` itd ON itd.id_transaksi = t.`id_transaksi`
LEFT JOIN `simkesbaru`.`item_transaksi_dokter` itdo ON itdo.`id_transaksi` = t.`id_transaksi`
LEFT JOIN `simkesbaru`.`item_transaksi_gigi` itg ON itg.id_transaksi = t.`id_transaksi`
LEFT JOIN `simkesbaru`.`item_transaksi_lab` itl ON itl.id_transaksi = t.`id_transaksi`
LEFT JOIN `simkesbaru`.`item_transaksi_lain` itlain ON itlain.id_transaksi = t.`id_transaksi`
LEFT JOIN `simkesbaru`.`item_transaksi_optik` ito ON ito.`id_transaksi` = t.`id_transaksi`
LEFT JOIN `simkesbaru`.`item_transaksi_penunjang` itp ON itp.id_transaksi = t.`id_transaksi`
LEFT JOIN `simkesbaru`.`item_transaksi_rs` itrs ON itrs.`id_transaksi` = t.`id_transaksi`
JOIN `simkesbaru`.`master_item` mi ON ita.`id_item` = mi.`id_item` OR itd.id_item = mi.`id_item` OR itdo.id_item = mi.`id_item` OR itg.id_item = mi.`id_item` OR itl.id_item = mi.`id_item` OR itlain.id_item = mi.`id_item` OR ito.id_item = mi.`id_item` OR itp.id_item = mi.`id_item` OR itrs.id_item = mi.`id_item` 
JOIN `simkesbaru`.`master_tertanggung` mt ON mt.`id_tertanggung` = t.`id_tertanggung`
JOIN `simkesbaru`.`master_karyawan` mk ON mk.`id_karyawan` = mt.`id_karyawan`
JOIN `simkesbaru`.rayon_karyawan rk ON rk.id_rayon = mk.`id_rayon`
JOIN `simkesbaru`.wilayah_karyawan wk ON wk.id_wilayah = rk.id_wilayah
WHERE mi.`idjns_item` = 1