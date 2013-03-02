CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_laporanrawatjalan` 
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
	, mdok.kat_dokter
	, mdok.nama_dokter
	, mt.`status`
	, ta.`restitusi`
	, mt.`ditanggung`
	, mi.`nama_item`
	, mi.`hba_item`
	, ita.`hrg_satuan`
	, ita.`jumlah`
	, COALESCE(ita.`total`, ita.hrg_satuan * ita.jumlah) AS total
	, mi.`idjns_item`
--	, ta.`id_rujukan`
	, mp.`nama_provider`
	, mb.`buku_besar`
	, mdi.`nama_diagnosa`
	, rk.id_rayon
	, wk.id_wilayah
	, wk.id_mitra
	, 'A' AS jenis_transaksi

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

LEFT JOIN master_diagnosa mdi ON mdi.`id_diagnosa` = tdi.`id_diagnosa`
LEFT JOIN master_dokter mdok ON mdok.`id_dokter` = ta.`id_dokter`

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
	, mdok.kat_dokter
	, mdok.nama_dokter
	, mt.`status`
	, td.`restitusi`
	, mt.`ditanggung`
	, mi.`nama_item`
	, mi.`hba_item`
	, itd.`hrg_satuan`
	, itd.`jumlah`
	, COALESCE(itd.`total`, itd.hrg_satuan * itd.jumlah) AS total
	, mi.`idjns_item`
--	, td.`id_rujukan`
	, mdok.nama_dokter AS nama_provider
	, mb.`buku_besar`
	, mdi.`nama_diagnosa`
	, rk.id_rayon
	, wk.id_wilayah
	, wk.id_mitra
	, 'D' AS jenis_transaksi

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

LEFT JOIN master_diagnosa mdi ON mdi.`id_diagnosa` = tdi.`id_diagnosa`
LEFT JOIN master_dokter mdok ON mdok.`id_dokter` = td.`id_dokter`

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
	, mdok.kat_dokter
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
	, 'G' AS jenis_transaksi

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

LEFT JOIN master_diagnosa mdi ON mdi.`id_diagnosa` = tdi.`id_diagnosa`
LEFT JOIN master_dokter mdok ON mdok.`id_dokter` = tg.`id_dokter`
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
	, mdok.kat_dokter
	, mdok.nama_dokter
	, mt.`status`
	, tl.`restitusi`
	, mt.`ditanggung`
	, mi.`nama_item`
	, mi.`hba_item`
	, itl.`hrg_satuan`
	, COALESCE(itl.`jumlah`,itl.hrg_satuan * itl.jumlah) AS total
	, itl.`total`
	, mi.`idjns_item`
--	, ta.`id_rujukan`
	, mp.`nama_provider`
	, mb.`buku_besar`
	, mdi.`nama_diagnosa`
	, rk.id_rayon
	, wk.id_wilayah
	, wk.id_mitra
	, 'L' AS jenis_transaksi

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

LEFT JOIN master_diagnosa mdi ON mdi.`id_diagnosa` = tdi.`id_diagnosa`
LEFT JOIN master_dokter mdok ON mdok.`id_dokter` = tl.`id_dokter`
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
	, mdok.kat_dokter
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
	, 'O' AS jenis_transaksi

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

LEFT JOIN master_diagnosa mdi ON mdi.`id_diagnosa` = tdi.`id_diagnosa`
LEFT JOIN master_dokter mdok ON mdok.`id_dokter` = top.`id_dokter`
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
	, mdok.kat_dokter
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
	, 'P' AS jenis_transaksi

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

LEFT JOIN master_diagnosa mdi ON mdi.`id_diagnosa` = tdi.`id_diagnosa`
LEFT JOIN master_dokter mdok ON mdok.`id_dokter` = tp.`id_dokter`
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
	, mdok.kat_dokter
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
	, 'R' AS jenis_transaksi

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

LEFT JOIN master_diagnosa mdi ON mdi.`id_diagnosa` = tdi.`id_diagnosa`

LEFT JOIN master_dokter mdok ON mdok.`id_dokter` = itr.`id_dokter`
WHERE tr.idjenis_rawat = 2
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
	, mdok.kat_dokter
	, mdok.nama_dokter
	, mt.`status`
	, tr.`restitusi`
	, mt.`ditanggung`
	, NULL
	, NULL
	, NULL
	, NULL
	, SUM(tov.hrg_satuan)
	, NULL
--	, ta.`id_rujukan`
	, NULL -- mp.`nama_provider`
	, NULL
	, NULL
	, rk.id_rayon
	, wk.id_wilayah
	, wk.id_mitra
	, 'DR' AS jenis_transaksi


FROM
transaksi t
JOIN `transaksi_rmh_sakit` tr ON tr.`id_transaksi` = t.`id_transaksi`
-- JOIN master_provider mp ON mp.`id_provider` = tr.`id_provider`
JOIN `transaksi_ov` tov ON tov.`id_transaksi` = t.`id_transaksi`


JOIN `master_tertanggung` mt ON mt.`id_tertanggung` = t.`id_tertanggung`
JOIN master_karyawan mk ON mk.`id_karyawan` = mt.`id_karyawan`
JOIN rayon_karyawan rk ON rk.`id_rayon` = mk.`id_rayon`
JOIN wilayah_karyawan wk ON wk.`id_wilayah` = rk.`id_wilayah`
LEFT JOIN master_dokter mdok ON mdok.`id_dokter` = tov.`id_dokter`
WHERE tr.idjenis_rawat = 2
 GROUP BY tov.`id_transaksi`
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
	, NULL
	, mdok.nama_dokter
	, mt.`status`
	, td.`restitusi`
	, mt.`ditanggung`
	, NULL
	, NULL
	, NULL
	, NULL
	, td.tarif_satuan_dokter
	, NULL
--	, td.`id_rujukan`
	, NULL
	, NULL
	, NULL
	, rk.id_rayon
	, wk.id_wilayah
	, wk.id_mitra
	, 'DD' AS jenis_transaksi

FROM
transaksi t
JOIN `transaksi_dokter` td ON td.`id_transaksi` = t.`id_transaksi`


JOIN `master_tertanggung` mt ON mt.`id_tertanggung` = t.`id_tertanggung`
JOIN master_karyawan mk ON mk.`id_karyawan` = mt.`id_karyawan`
JOIN rayon_karyawan rk ON rk.`id_rayon` = mk.`id_rayon`
JOIN wilayah_karyawan wk ON wk.`id_wilayah` = rk.`id_wilayah`
LEFT JOIN master_dokter mdok ON mdok.`id_dokter` = td.`id_dokter`

GROUP BY t.`id_transaksi`
)

 




