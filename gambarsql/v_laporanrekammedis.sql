
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_laporanrekammedis` 
    AS

(
SELECT 
	t.`id_transaksi`
	, t.`tgl_kunjungan`
	, t.`tgl_transaksi`
	, mk.`nip`
	, mk.`nama_karyawan`
	, mk.`ap`
	, mt.`nama_tertanggung`
	, mdok.nama_dokter
	, mt.`status`
	, ta.`restitusi`
	, mt.`ditanggung`
	, mi.`nama_item`
	, mi.`hba_item`
	, ita.`hrg_satuan`
	, ita.`jumlah`
	, COALESCE(ita.`total`,ita.hrg_satuan * ita.jumlah) AS total
	, mi.`idjns_item`
--	, ta.`id_rujukan`
	, mp.`nama_provider`
	, mb.`buku_besar`
	, mdi.`nama_diagnosa`
	, rk.id_rayon
	, wk.id_wilayah
	, wk.id_mitra
	, 'Transaksi Apotek' AS jenis_transaksi
	, NULL AS tgl_keluar
	, mdos.nama_dosis

FROM
transaksi t
JOIN `transaksi_apotek` ta ON ta.`id_transaksi` = t.`id_transaksi`
JOIN master_provider mp ON mp.`id_provider` = ta.`id_provider`
JOIN `item_transaksi_apotek` ita ON ita.`id_transaksi` = t.`id_transaksi`
JOIN master_item mi ON mi.`id_item` = ita.`id_item`


JOIN `master_tertanggung` mt ON mt.`id_tertanggung` = t.`id_tertanggung`
JOIN master_karyawan mk ON mk.`id_karyawan` = mt.`id_karyawan`
JOIN rayon_karyawan rk ON rk.`id_rayon` = mk.`id_rayon`
JOIN wilayah_karyawan wk ON wk.`id_wilayah` = rk.`id_wilayah`
LEFT JOIN `transaksi_diagnosa` tdi ON tdi.`id_transaksi` = t.`id_transaksi`
LEFT JOIN master_buku_besar mb ON mb.`id_transaksi` = t.`id_transaksi`

JOIN master_diagnosa mdi ON mdi.`id_diagnosa` = tdi.`id_diagnosa`
LEFT JOIN master_dokter mdok ON mdok.`id_dokter` = ta.`id_dokter`
LEFT JOIN `dosis_item` di ON di.id_transaksi = t.id_transaksi
LEFT JOIN `master_dosis` mdos ON mdos.id_dosis = di.id_dosis

GROUP BY t.`id_transaksi`, ita.id_item
)
UNION
(
SELECT 
	t.`id_transaksi`
	, t.`tgl_kunjungan`
	, t.`tgl_transaksi`
	, mk.`nip`
	, mk.`nama_karyawan`
	, mk.`ap`
	, mt.`nama_tertanggung`
	, mdok.nama_dokter
	, mt.`status`
	, td.`restitusi`
	, mt.`ditanggung`
	, mi.`nama_item`
	, mi.`hba_item`
	, itd.`hrg_satuan`
	, itd.`jumlah`
	, COALESCE(itd.`total`,itd.hrg_satuan * itd.jumlah) AS total
	, mi.`idjns_item`
--	, td.`id_rujukan`
	, mdok.nama_dokter AS nama_provider
	, mb.`buku_besar`
	, mdi.`nama_diagnosa`
	, rk.id_rayon
	, wk.id_wilayah
	, wk.id_mitra
	, 'Transaksi Dokter' AS jenis_transaksi
	, NULL AS tgl_keluar
	, mdos.nama_dosis

FROM
transaksi t
JOIN `transaksi_dokter` td ON td.`id_transaksi` = t.`id_transaksi`
JOIN `item_transaksi_dokter` itd ON itd.`id_transaksi` = t.`id_transaksi`
JOIN master_item mi ON mi.`id_item` = itd.`id_item`


JOIN `master_tertanggung` mt ON mt.`id_tertanggung` = t.`id_tertanggung`
JOIN master_karyawan mk ON mk.`id_karyawan` = mt.`id_karyawan`
JOIN rayon_karyawan rk ON rk.`id_rayon` = mk.`id_rayon`
JOIN wilayah_karyawan wk ON wk.`id_wilayah` = rk.`id_wilayah`
LEFT JOIN `transaksi_diagnosa` tdi ON tdi.`id_transaksi` = t.`id_transaksi`
LEFT JOIN master_buku_besar mb ON mb.`id_transaksi` = t.`id_transaksi`

JOIN master_diagnosa mdi ON mdi.`id_diagnosa` = tdi.`id_diagnosa`
LEFT JOIN master_dokter mdok ON mdok.`id_dokter` = td.`id_dokter`
LEFT JOIN `dosis_item` di ON di.id_transaksi = t.id_transaksi
LEFT JOIN `master_dosis` mdos ON mdos.id_dosis = di.id_dosis

GROUP BY t.`id_transaksi`,itd.id_item
)
UNION
(
SELECT 
	t.`id_transaksi`
	, t.`tgl_kunjungan`
	, t.`tgl_transaksi`
	, mk.`nip`
	, mk.`nama_karyawan`
	, mk.`ap`
	, mt.`nama_tertanggung`
	, mdok.nama_dokter
	, mt.`status`
	, tg.`restitusi`
	, mt.`ditanggung`
	, mi.`nama_item`
	, mi.`hba_item`
	, itg.`hrg_satuan`
	, itg.`jumlah`
	, COALESCE(itg.`total`,itg.hrg_satuan * itg.jumlah) AS total
	, mi.`idjns_item`
--	, ta.`id_rujukan`
	, mp.`nama_provider`
	, mb.`buku_besar`
	, mdi.`nama_diagnosa`
	, rk.id_rayon
	, wk.id_wilayah
	, wk.id_mitra
	, 'Transaksi Gigi' AS jenis_transaksi
	, NULL AS tgl_keluar
	, mdos.nama_dosis

FROM
transaksi t
JOIN `transaksi_gigi` tg ON tg.`id_transaksi` = t.`id_transaksi`
JOIN master_provider mp ON mp.`id_provider` = tg.`id_provider`
JOIN `item_transaksi_gigi` itg ON itg.`id_transaksi` = t.`id_transaksi`
JOIN master_item mi ON mi.`id_item` = itg.`id_item`


JOIN `master_tertanggung` mt ON mt.`id_tertanggung` = t.`id_tertanggung`
JOIN master_karyawan mk ON mk.`id_karyawan` = mt.`id_karyawan`
JOIN rayon_karyawan rk ON rk.`id_rayon` = mk.`id_rayon`
JOIN wilayah_karyawan wk ON wk.`id_wilayah` = rk.`id_wilayah`
LEFT JOIN `transaksi_diagnosa` tdi ON tdi.`id_transaksi` = t.`id_transaksi`
LEFT JOIN master_buku_besar mb ON mb.`id_transaksi` = t.`id_transaksi`

JOIN master_diagnosa mdi ON mdi.`id_diagnosa` = tdi.`id_diagnosa`
LEFT JOIN master_dokter mdok ON mdok.`id_dokter` = tg.`id_dokter`
LEFT JOIN `dosis_item` di ON di.id_transaksi = t.id_transaksi
LEFT JOIN `master_dosis` mdos ON mdos.id_dosis = di.id_dosis
GROUP BY t.`id_transaksi`, itg.id_item
)
UNION
(
SELECT 
	t.`id_transaksi`
	, t.`tgl_kunjungan`
	, t.`tgl_transaksi`
	, mk.`nip`
	, mk.`nama_karyawan`
	, mk.`ap`
	, mt.`nama_tertanggung`
	, mdok.nama_dokter
	, mt.`status`
	, tl.`restitusi`
	, mt.`ditanggung`
	, mi.`nama_item`
	, mi.`hba_item`
	, itl.`hrg_satuan`
	, itl.`jumlah`
	, COALESCE(itl.`total`,itl.hrg_satuan * itl.jumlah) AS total
	, mi.`idjns_item`
--	, ta.`id_rujukan`
	, mp.`nama_provider`
	, mb.`buku_besar`
	, mdi.`nama_diagnosa`
	, rk.id_rayon
	, wk.id_wilayah
	, wk.id_mitra
	, 'Transaksi Lain' AS jenis_transaksi
	, NULL AS tgl_keluar
	, mdos.nama_dosis

FROM
transaksi t
JOIN `transaksi_lain` tl ON tl.`id_transaksi` = t.`id_transaksi`
JOIN master_provider mp ON mp.`id_provider` = tl.`id_provider`
JOIN `item_transaksi_lain` itl ON itl.`id_transaksi` = t.`id_transaksi`
JOIN master_item mi ON mi.`id_item` = itl.`id_item`


JOIN `master_tertanggung` mt ON mt.`id_tertanggung` = t.`id_tertanggung`
JOIN master_karyawan mk ON mk.`id_karyawan` = mt.`id_karyawan`
JOIN rayon_karyawan rk ON rk.`id_rayon` = mk.`id_rayon`
JOIN wilayah_karyawan wk ON wk.`id_wilayah` = rk.`id_wilayah`
LEFT JOIN `transaksi_diagnosa` tdi ON tdi.`id_transaksi` = t.`id_transaksi`
LEFT JOIN master_buku_besar mb ON mb.`id_transaksi` = t.`id_transaksi`

JOIN master_diagnosa mdi ON mdi.`id_diagnosa` = tdi.`id_diagnosa`
LEFT JOIN master_dokter mdok ON mdok.`id_dokter` = tl.`id_dokter`
LEFT JOIN `dosis_item` di ON di.id_transaksi = t.id_transaksi
LEFT JOIN `master_dosis` mdos ON mdos.id_dosis = di.id_dosis
GROUP BY t.`id_transaksi`,itl.id_item
)
UNION
(
SELECT 
	t.`id_transaksi`
	, t.`tgl_kunjungan`
	, t.`tgl_transaksi`
	, mk.`nip`
	, mk.`nama_karyawan`
	, mk.`ap`
	, mt.`nama_tertanggung`
	, mdok.nama_dokter
	, mt.`status`
	, top.`restitusi`
	, mt.`ditanggung`
	, mi.`nama_item`
	, mi.`hba_item`
	, ito.`hrg_satuan`
	, ito.`jumlah`
	, COALESCE(ito.`total`,ito.hrg_satuan * ito.jumlah) AS total
	, mi.`idjns_item`
--	, ta.`id_rujukan`
	, mp.`nama_provider`
	, mb.`buku_besar`
	, mdi.`nama_diagnosa`
	, rk.id_rayon
	, wk.id_wilayah
	, wk.id_mitra
	, 'Transaksi Optik' AS jenis_transaksi
	, NULL AS tgl_keluar
	, mdos.nama_dosis

FROM
transaksi t
JOIN `transaksi_optik` top ON top.`id_transaksi` = t.`id_transaksi`
JOIN master_provider mp ON mp.`id_provider` = top.`id_provider`
JOIN `item_transaksi_optik` ito ON ito.`id_transaksi` = t.`id_transaksi`
JOIN master_item mi ON mi.`id_item` = ito.`id_item`


JOIN `master_tertanggung` mt ON mt.`id_tertanggung` = t.`id_tertanggung`
JOIN master_karyawan mk ON mk.`id_karyawan` = mt.`id_karyawan`
JOIN rayon_karyawan rk ON rk.`id_rayon` = mk.`id_rayon`
JOIN wilayah_karyawan wk ON wk.`id_wilayah` = rk.`id_wilayah`
LEFT JOIN `transaksi_diagnosa` tdi ON tdi.`id_transaksi` = t.`id_transaksi`
LEFT JOIN master_buku_besar mb ON mb.`id_transaksi` = t.`id_transaksi`

JOIN master_diagnosa mdi ON mdi.`id_diagnosa` = tdi.`id_diagnosa`
LEFT JOIN master_dokter mdok ON mdok.`id_dokter` = top.`id_dokter`
LEFT JOIN `dosis_item` di ON di.id_transaksi = t.id_transaksi
LEFT JOIN `master_dosis` mdos ON mdos.id_dosis = di.id_dosis
GROUP BY t.`id_transaksi`,ito.id_item
)
 
UNION
(
SELECT 
	t.`id_transaksi`
	, t.`tgl_kunjungan`
	, t.`tgl_transaksi`
	, mk.`nip`
	, mk.`nama_karyawan`
	, mk.`ap`
	, mt.`nama_tertanggung`
	, mdok.nama_dokter
	, mt.`status`
	, tp.`restitusi`
	, mt.`ditanggung`
	, mi.`nama_item`
	, mi.`hba_item`
	, itp.`hrg_satuan`
	, itp.`jumlah`
	, COALESCE(itp.`total`,itp.hrg_satuan * itp.jumlah) AS total
	, mi.`idjns_item`
--	, ta.`id_rujukan`
	, mp.`nama_provider`
	, mb.`buku_besar`
	, mdi.`nama_diagnosa`
	, rk.id_rayon
	, wk.id_wilayah
	, wk.id_mitra
	, 'Transaksi Penunjang' AS jenis_transaksi
	, NULL AS tgl_keluar
	, mdos.nama_dosis

FROM
transaksi t
JOIN `transaksi_penunjang` tp ON tp.`id_transaksi` = t.`id_transaksi`
JOIN master_provider mp ON mp.`id_provider` = tp.`id_provider`
JOIN `item_transaksi_penunjang` itp ON itp.`id_transaksi` = t.`id_transaksi`
JOIN master_item mi ON mi.`id_item` = itp.`id_item`


JOIN `master_tertanggung` mt ON mt.`id_tertanggung` = t.`id_tertanggung`
JOIN master_karyawan mk ON mk.`id_karyawan` = mt.`id_karyawan`
JOIN rayon_karyawan rk ON rk.`id_rayon` = mk.`id_rayon`
JOIN wilayah_karyawan wk ON wk.`id_wilayah` = rk.`id_wilayah`
LEFT JOIN `transaksi_diagnosa` tdi ON tdi.`id_transaksi` = t.`id_transaksi`
LEFT JOIN master_buku_besar mb ON mb.`id_transaksi` = t.`id_transaksi`

JOIN master_diagnosa mdi ON mdi.`id_diagnosa` = tdi.`id_diagnosa`
LEFT JOIN master_dokter mdok ON mdok.`id_dokter` = tp.`id_dokter`
LEFT JOIN `dosis_item` di ON di.id_transaksi = t.id_transaksi
LEFT JOIN `master_dosis` mdos ON mdos.id_dosis = di.id_dosis
GROUP BY t.`id_transaksi`,itp.id_item
)
 
UNION
(
SELECT 
	t.`id_transaksi`
	, t.`tgl_kunjungan`
	, t.`tgl_transaksi`
	, mk.`nip`
	, mk.`nama_karyawan`
	, mk.`ap`
	, mt.`nama_tertanggung`
	, mdok.nama_dokter
	, mt.`status`
	, tr.`restitusi`
	, mt.`ditanggung`
	, mi.`nama_item`
	, mi.`hba_item`
	, itr.`hrg_satuan`
	, itr.`jumlah`
	, COALESCE(itr.`total`,itr.hrg_satuan * itr.jumlah) AS total
	, mi.`idjns_item`
--	, ta.`id_rujukan`
	, mp.`nama_provider`
	, mb.`buku_besar`
	, mdi.`nama_diagnosa`
	, rk.id_rayon
	, wk.id_wilayah
	, wk.id_mitra
	, 'Transaksi Rumah Sakit' AS jenis_transaksi
	, NULL AS tgl_keluar
	, mdos.nama_dosis

FROM
transaksi t
JOIN `transaksi_rmh_sakit` tr ON tr.`id_transaksi` = t.`id_transaksi`
JOIN master_provider mp ON mp.`id_provider` = tr.`id_provider`
JOIN `item_transaksi_rs` itr ON itr.`id_transaksi` = t.`id_transaksi`
JOIN master_item mi ON mi.`id_item` = itr.`id_item`


JOIN `master_tertanggung` mt ON mt.`id_tertanggung` = t.`id_tertanggung`
JOIN master_karyawan mk ON mk.`id_karyawan` = mt.`id_karyawan`
JOIN rayon_karyawan rk ON rk.`id_rayon` = mk.`id_rayon`
JOIN wilayah_karyawan wk ON wk.`id_wilayah` = rk.`id_wilayah`
LEFT JOIN `transaksi_diagnosa` tdi ON tdi.`id_transaksi` = t.`id_transaksi`
LEFT JOIN master_buku_besar mb ON mb.`id_transaksi` = t.`id_transaksi`

JOIN master_diagnosa mdi ON mdi.`id_diagnosa` = tdi.`id_diagnosa`

LEFT JOIN master_dokter mdok ON mdok.`id_dokter` = itr.`id_dokter`
LEFT JOIN `dosis_item` di ON di.id_transaksi = t.id_transaksi
LEFT JOIN `master_dosis` mdos ON mdos.id_dosis = di.id_dosis
GROUP BY t.`id_transaksi`,itr.id_item
)
UNION
(
SELECT 
	t.`id_transaksi`
	, t.`tgl_kunjungan`
	, t.`tgl_transaksi`
	, mk.`nip`
	, mk.`nama_karyawan`
	, mk.`ap`
	, mt.`nama_tertanggung`
	, mdok.nama_dokter
	, mt.`status`
	, tlab.`restitusi`
	, mt.`ditanggung`
	, mi.`nama_item`
	, mi.`hba_item`
	, NULL AS `hrg_satuan`
	, NULL AS `jumlah`
	, itr.`total`
	, mi.`idjns_item`
--	, ta.`id_rujukan`
	, mp.`nama_provider`
	, mb.`buku_besar`
	, mdi.`nama_diagnosa`
	, rk.id_rayon
	, wk.id_wilayah
	, wk.id_mitra
	, 'Transaksi Lab' AS jenis_transaksi
	, NULL AS tgl_keluar
	, mdos.nama_dosis

FROM
transaksi t
JOIN `transaksi_lab` tlab ON tlab.`id_transaksi` = t.`id_transaksi`
JOIN master_provider mp ON mp.`id_provider` = tlab.`id_provider`
JOIN `item_transaksi_lab` itr ON itr.`id_transaksi` = t.`id_transaksi`
JOIN master_item mi ON mi.`id_item` = itr.`id_item`


JOIN `master_tertanggung` mt ON mt.`id_tertanggung` = t.`id_tertanggung`
JOIN master_karyawan mk ON mk.`id_karyawan` = mt.`id_karyawan`
JOIN rayon_karyawan rk ON rk.`id_rayon` = mk.`id_rayon`
JOIN wilayah_karyawan wk ON wk.`id_wilayah` = rk.`id_wilayah`
LEFT JOIN `transaksi_diagnosa` tdi ON tdi.`id_transaksi` = t.`id_transaksi`
LEFT JOIN master_buku_besar mb ON mb.`id_transaksi` = t.`id_transaksi`

JOIN master_diagnosa mdi ON mdi.`id_diagnosa` = tdi.`id_diagnosa`

LEFT JOIN master_dokter mdok ON mdok.`id_dokter` = tlab.`id_dokter`
LEFT JOIN `dosis_item` di ON di.id_transaksi = t.id_transaksi
LEFT JOIN `master_dosis` mdos ON mdos.id_dosis = di.id_dosis
GROUP BY t.`id_transaksi`,itr.id_item
)


 

