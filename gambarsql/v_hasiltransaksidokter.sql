
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_hasiltransaksidokter` 
    AS
    
SELECT -- *
 td.`id_transaksi`
 , t.`tgl_kunjungan`
 , t.`tgl_transaksi`
 , td.`no_surat`
 , td.`no_bukti`
 , td.`restitusi`
 , mk.`nip`
 , mk.`nama_karyawan`
 , mk.ap 
 , mt.nama_tertanggung
 , mt.status
 , mb.buku_besar
 ,  (SELECT GROUP_CONCAT(`nama_diagnosa`) FROM `transaksi_diagnosa` tdi
    JOIN `master_diagnosa` md ON md.`id_diagnosa` = tdi.`id_diagnosa` WHERE tdi.id_transaksi = itd.id_transaksi) AS nama_diagnosa
 , mdo.nama_dokter
 , tarif_satuan_dokter AS total
 , itd.jumlah
 , SUM(COALESCE(itd.`total`, itd.jumlah * itd.hrg_satuan)) + COALESCE(td.tarif_satuan_dokter,0) AS total_satuan
 , SUM(COALESCE(itd.`total`, itd.jumlah * mi.harga_item)) + COALESCE(td.tarif_standar_dokter,0) AS total_standar
 , rk.id_rayon
 , wk.id_wilayah
 , wk.id_mitra
 , itd.id_item
 
 
 
FROM `transaksi_dokter` td
JOIN `transaksi` t ON t.`id_transaksi` = td.`id_transaksi`
LEFT JOIN `master_dokter` mdo ON mdo.id_dokter = td.id_dokter
LEFT JOIN `item_transaksi_dokter` itd ON itd.`id_transaksi` = td.`id_transaksi`
LEFT JOIN `master_item` mi ON mi.`id_item` = itd.`id_item`
JOIN `master_buku_besar` mb ON mb.id_transaksi = td.id_transaksi
 JOIN master_tertanggung mt ON mt.`id_tertanggung` = t.`id_tertanggung`
 JOIN `master_karyawan` mk ON mk.`id_karyawan` = mt.`id_karyawan`
 JOIN `rayon_karyawan` rk ON rk.`id_rayon` = mk.`id_rayon`
 JOIN wilayah_karyawan wk ON wk.`id_wilayah` = rk.`id_wilayah`
 GROUP BY td.id_transaksi -- , itd.id_transaksi_dokter


