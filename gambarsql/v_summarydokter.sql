
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_summarydokter` 
    AS
    
SELECT t.`tgl_transaksi`,t.`tgl_kunjungan`,t.`id_transaksi`, md.`kat_dokter`, rk.id_rayon, wk.id_wilayah, wk.id_mitra
FROM `simkesbaru`.`transaksi` t
LEFT JOIN `simkesbaru`.transaksi_apotek ta
	ON ta.id_transaksi = t.`id_transaksi`
LEFT JOIN `simkesbaru`.`transaksi_dak` tdak
        ON (tdak.`id_transaksi` = t.`id_transaksi`)
LEFT JOIN `simkesbaru`.transaksi_dokter tdo
	ON tdo.id_transaksi = t.`id_transaksi`
LEFT JOIN `simkesbaru`.transaksi_gigi tg
	ON tg.id_transaksi = t.`id_transaksi`
LEFT JOIN `simkesbaru`.transaksi_lab tl
	ON tl.id_transaksi = t.`id_transaksi`
LEFT JOIN `simkesbaru`.transaksi_lain tlain
	ON tlain.id_transaksi = t.`id_transaksi`
LEFT JOIN `simkesbaru`.transaksi_optik top
	ON top.id_transaksi = t.`id_transaksi`
LEFT JOIN `simkesbaru`.transaksi_ov ov
	ON ov.id_transaksi = t.`id_transaksi`
LEFT JOIN `simkesbaru`.transaksi_penunjang tp
	ON tp.id_transaksi = t.`id_transaksi`
JOIN `simkesbaru`.`master_dokter` md 
	ON md.`id_dokter` = ta.`id_dokter` OR md.`id_dokter` = tdak.id_dokter OR md.`id_dokter` = tdo.id_dokter
        OR md.`id_dokter` = tg.id_dokter OR md.`id_dokter` = tl.id_dokter OR md.`id_dokter` = tlain.id_dokter
        OR md.`id_dokter` = top.id_dokter OR md.`id_dokter` = ov.id_dokter OR md.`id_dokter` = tp.id_dokter	
JOIN `simkesbaru`.`master_tertanggung` mtang
	ON mtang.`id_tertanggung` = t.`id_tertanggung`
JOIN `simkesbaru`.`master_karyawan` mkang
	ON mkang.`id_karyawan` = mtang.`id_karyawan`
JOIN `simkesbaru`.rayon_karyawan rk
	ON rk.id_rayon = mkang.`id_rayon`
JOIN `simkesbaru`.wilayah_karyawan wk
	ON wk.id_wilayah = wk.id_wilayah
GROUP BY id_transaksi	
        