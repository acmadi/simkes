
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_laporankunjungankesehatan` 
    AS
(
SELECT 
	t.`id_transaksi`
	, t.`tgl_kunjungan`
	, mk.`nip`
	, mk.`nama_karyawan`
	, mk.`ap`
	, mt.`nama_tertanggung`
	, mdok.nama_dokter
	, mt.`status`
	, ta.`restitusi`
	, mt.`ditanggung`
--	, ta.`id_rujukan`
	, mdi.`nama_diagnosa`
	, rk.id_rayon
	, wk.id_wilayah
	, wk.id_mitra
	, 'A' AS jenis_transaksi
	, '2' AS idjenis_rawat

FROM
transaksi t
JOIN `transaksi_apotek` ta ON ta.`id_transaksi` = t.`id_transaksi`
JOIN `item_transaksi_apotek` ita ON ita.`id_transaksi` = t.`id_transaksi`
JOIN `master_tertanggung` mt ON mt.`id_tertanggung` = t.`id_tertanggung`
JOIN master_karyawan mk ON mk.`id_karyawan` = mt.`id_karyawan`
JOIN rayon_karyawan rk ON rk.`id_rayon` = mk.`id_rayon`
JOIN wilayah_karyawan wk ON wk.`id_wilayah` = rk.`id_wilayah`
LEFT JOIN `transaksi_diagnosa` tdi ON tdi.`id_transaksi` = t.`id_transaksi`
LEFT JOIN master_diagnosa mdi ON mdi.`id_diagnosa` = tdi.`id_diagnosa`
LEFT JOIN master_dokter mdok ON mdok.`id_dokter` = ta.`id_dokter`

GROUP BY t.`id_transaksi`
)
UNION
(
SELECT 
	t.`id_transaksi`
	, t.`tgl_kunjungan`
	, mk.`nip`
	, mk.`nama_karyawan`
	, mk.`ap`
	, mt.`nama_tertanggung`
	, mdok.nama_dokter
	, mt.`status`
	, td.`restitusi`
	, mt.`ditanggung`
--	, td.`id_rujukan`
	, mdi.`nama_diagnosa`
	, rk.id_rayon
	, wk.id_wilayah
	, wk.id_mitra
	, 'D' AS jenis_transaksi
	, '2' AS idjenis_rawat

FROM
transaksi t
JOIN `transaksi_dokter` td ON td.`id_transaksi` = t.`id_transaksi`
JOIN `item_transaksi_dokter` itd ON itd.`id_transaksi` = t.`id_transaksi`
JOIN `master_tertanggung` mt ON mt.`id_tertanggung` = t.`id_tertanggung`
JOIN master_karyawan mk ON mk.`id_karyawan` = mt.`id_karyawan`
JOIN rayon_karyawan rk ON rk.`id_rayon` = mk.`id_rayon`
JOIN wilayah_karyawan wk ON wk.`id_wilayah` = rk.`id_wilayah`
LEFT JOIN `transaksi_diagnosa` tdi ON tdi.`id_transaksi` = t.`id_transaksi`
LEFT JOIN master_diagnosa mdi ON mdi.`id_diagnosa` = tdi.`id_diagnosa`
LEFT JOIN master_dokter mdok ON mdok.`id_dokter` = td.`id_dokter`

GROUP BY t.`id_transaksi`
)
UNION
(
SELECT 
	t.`id_transaksi`
	, t.`tgl_kunjungan`
	, mk.`nip`
	, mk.`nama_karyawan`
	, mk.`ap`
	, mt.`nama_tertanggung`
	, mdok.nama_dokter
	, mt.`status`
	, tg.`restitusi`
	, mt.`ditanggung`
--	, ta.`id_rujukan`
	, mdi.`nama_diagnosa`
	, rk.id_rayon
	, wk.id_wilayah
	, wk.id_mitra
	, 'G' AS jenis_transaksi
	, '2' AS idjenis_rawat

FROM
transaksi t
JOIN `transaksi_gigi` tg ON tg.`id_transaksi` = t.`id_transaksi`
JOIN master_provider mp ON mp.`id_provider` = tg.`id_provider`
JOIN `item_transaksi_gigi` itg ON itg.`id_transaksi` = t.`id_transaksi`


JOIN `master_tertanggung` mt ON mt.`id_tertanggung` = t.`id_tertanggung`
JOIN master_karyawan mk ON mk.`id_karyawan` = mt.`id_karyawan`
JOIN rayon_karyawan rk ON rk.`id_rayon` = mk.`id_rayon`
JOIN wilayah_karyawan wk ON wk.`id_wilayah` = rk.`id_wilayah`
LEFT JOIN `transaksi_diagnosa` tdi ON tdi.`id_transaksi` = t.`id_transaksi`
LEFT JOIN master_diagnosa mdi ON mdi.`id_diagnosa` = tdi.`id_diagnosa`
LEFT JOIN master_dokter mdok ON mdok.`id_dokter` = tg.`id_dokter`
GROUP BY t.`id_transaksi`
)
UNION
(
SELECT 
	t.`id_transaksi`
	, t.`tgl_kunjungan`
	, mk.`nip`
	, mk.`nama_karyawan`
	, mk.`ap`
	, mt.`nama_tertanggung`
	, mdok.nama_dokter
	, mt.`status`
	, tl.`restitusi`
	, mt.`ditanggung`
	, mdi.`nama_diagnosa`
	, rk.id_rayon
	, wk.id_wilayah
	, wk.id_mitra
	, 'L' AS jenis_transaksi
	, '2' AS idjenis_rawat

FROM
transaksi t
JOIN `transaksi_lain` tl ON tl.`id_transaksi` = t.`id_transaksi`
JOIN `item_transaksi_lain` itl ON itl.`id_transaksi` = t.`id_transaksi`

JOIN `master_tertanggung` mt ON mt.`id_tertanggung` = t.`id_tertanggung`
JOIN master_karyawan mk ON mk.`id_karyawan` = mt.`id_karyawan`
JOIN rayon_karyawan rk ON rk.`id_rayon` = mk.`id_rayon`
JOIN wilayah_karyawan wk ON wk.`id_wilayah` = rk.`id_wilayah`
LEFT JOIN `transaksi_diagnosa` tdi ON tdi.`id_transaksi` = t.`id_transaksi`
LEFT JOIN master_diagnosa mdi ON mdi.`id_diagnosa` = tdi.`id_diagnosa`
LEFT JOIN master_dokter mdok ON mdok.`id_dokter` = tl.`id_dokter`
GROUP BY t.`id_transaksi`
)
UNION
(
SELECT 
	t.`id_transaksi`
	, t.`tgl_kunjungan`
	, mk.`nip`
	, mk.`nama_karyawan`
	, mk.`ap`
	, mt.`nama_tertanggung`
	, mdok.nama_dokter
	, mt.`status`
	, top.`restitusi`
	, mt.`ditanggung`
	, mdi.`nama_diagnosa`
	, rk.id_rayon
	, wk.id_wilayah
	, wk.id_mitra
	, 'O' AS jenis_transaksi
	, '2' AS idjenis_rawat

FROM
transaksi t
JOIN `transaksi_optik` top ON top.`id_transaksi` = t.`id_transaksi`
JOIN `item_transaksi_optik` ito ON ito.`id_transaksi` = t.`id_transaksi`
JOIN `master_tertanggung` mt ON mt.`id_tertanggung` = t.`id_tertanggung`
JOIN master_karyawan mk ON mk.`id_karyawan` = mt.`id_karyawan`
JOIN rayon_karyawan rk ON rk.`id_rayon` = mk.`id_rayon`
JOIN wilayah_karyawan wk ON wk.`id_wilayah` = rk.`id_wilayah`
LEFT JOIN `transaksi_diagnosa` tdi ON tdi.`id_transaksi` = t.`id_transaksi`

LEFT JOIN master_diagnosa mdi ON mdi.`id_diagnosa` = tdi.`id_diagnosa`
LEFT JOIN master_dokter mdok ON mdok.`id_dokter` = top.`id_dokter`
GROUP BY t.`id_transaksi`
)
 
UNION
(
SELECT 
	t.`id_transaksi`
	, t.`tgl_kunjungan`
	, mk.`nip`
	, mk.`nama_karyawan`
	, mk.`ap`
	, mt.`nama_tertanggung`
	, mdok.nama_dokter
	, mt.`status`
	, tp.`restitusi`
	, mt.`ditanggung`
	, mdi.`nama_diagnosa`
	, rk.id_rayon
	, wk.id_wilayah
	, wk.id_mitra
	, 'P' AS jenis_transaksi
	, '2' AS idjenis_rawat

FROM
transaksi t
JOIN `transaksi_penunjang` tp ON tp.`id_transaksi` = t.`id_transaksi`
JOIN `item_transaksi_penunjang` itp ON itp.`id_transaksi` = t.`id_transaksi`
JOIN `master_tertanggung` mt ON mt.`id_tertanggung` = t.`id_tertanggung`
JOIN master_karyawan mk ON mk.`id_karyawan` = mt.`id_karyawan`
JOIN rayon_karyawan rk ON rk.`id_rayon` = mk.`id_rayon`
JOIN wilayah_karyawan wk ON wk.`id_wilayah` = rk.`id_wilayah`
LEFT JOIN `transaksi_diagnosa` tdi ON tdi.`id_transaksi` = t.`id_transaksi`
LEFT JOIN master_diagnosa mdi ON mdi.`id_diagnosa` = tdi.`id_diagnosa`
LEFT JOIN master_dokter mdok ON mdok.`id_dokter` = tp.`id_dokter`
GROUP BY t.`id_transaksi`
)
 
UNION
(
SELECT 
	t.`id_transaksi`
	, t.`tgl_kunjungan`
	, mk.`nip`
	, mk.`nama_karyawan`
	, mk.`ap`
	, mt.`nama_tertanggung`
	, mdok.nama_dokter
	, mt.`status`
	, tr.`restitusi`
	, mt.`ditanggung`
	, mdi.`nama_diagnosa`
	, rk.id_rayon
	, wk.id_wilayah
	, wk.id_mitra
	, 'R' AS jenis_transaksi
	, '2' AS idjenis_rawat

FROM
transaksi t
JOIN `transaksi_rmh_sakit` tr ON tr.`id_transaksi` = t.`id_transaksi`
JOIN `item_transaksi_rs` itr ON itr.`id_transaksi` = t.`id_transaksi`
JOIN `master_tertanggung` mt ON mt.`id_tertanggung` = t.`id_tertanggung`
JOIN master_karyawan mk ON mk.`id_karyawan` = mt.`id_karyawan`
JOIN rayon_karyawan rk ON rk.`id_rayon` = mk.`id_rayon`
JOIN wilayah_karyawan wk ON wk.`id_wilayah` = rk.`id_wilayah`
LEFT JOIN `transaksi_diagnosa` tdi ON tdi.`id_transaksi` = t.`id_transaksi`
LEFT JOIN master_diagnosa mdi ON mdi.`id_diagnosa` = tdi.`id_diagnosa`

LEFT JOIN master_dokter mdok ON mdok.`id_dokter` = itr.`id_dokter`WHERE tr.idjenis_rawat = 2
GROUP BY t.`id_transaksi`
)
UNION
(
SELECT 
	t.`id_transaksi`
	, t.`tgl_kunjungan`
	, mk.`nip`
	, mk.`nama_karyawan`
	, mk.`ap`
	, mt.`nama_tertanggung`
	, mdok.nama_dokter
	, mt.`status`
	, tr.`restitusi`
	, mt.`ditanggung`
	, mdi.`nama_diagnosa`
	, rk.id_rayon
	, wk.id_wilayah
	, wk.id_mitra
	, 'Ri' AS jenis_transaksi
	, '1' AS idjenis_rawat

FROM
transaksi t
JOIN `transaksi_rmh_sakit` tr ON tr.`id_transaksi` = t.`id_transaksi`
JOIN `item_transaksi_rs` itr ON itr.`id_transaksi` = t.`id_transaksi`
JOIN `master_tertanggung` mt ON mt.`id_tertanggung` = t.`id_tertanggung`
JOIN master_karyawan mk ON mk.`id_karyawan` = mt.`id_karyawan`
JOIN rayon_karyawan rk ON rk.`id_rayon` = mk.`id_rayon`
JOIN wilayah_karyawan wk ON wk.`id_wilayah` = rk.`id_wilayah`
LEFT JOIN `transaksi_diagnosa` tdi ON tdi.`id_transaksi` = t.`id_transaksi`
LEFT JOIN master_diagnosa mdi ON mdi.`id_diagnosa` = tdi.`id_diagnosa`

LEFT JOIN master_dokter mdok ON mdok.`id_dokter` = itr.`id_dokter`WHERE tr.idjenis_rawat = 1
GROUP BY t.`id_transaksi`
)

 

