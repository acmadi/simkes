
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_laporanrawatinap` 
    AS

SELECT
    `transaksi`.`id_transaksi`
    , `transaksi`.`tgl_transaksi`
    , `transaksi`.`tgl_kunjungan`
    , `master_karyawan`.`nip`
    , `master_karyawan`.`nama_karyawan`
    , `master_karyawan`.`ap`
    , `master_tertanggung`.`nama_tertanggung`
    , `master_tertanggung`.`status`
    , `transaksi_rmh_sakit`.`restitusi`
    , `master_item`.`nama_item`
    , `master_item`.`hba_item`
    , `item_transaksi_rs`.`hrg_satuan`
    , `item_transaksi_rs`.`jumlah`
    , SUM(`item_transaksi_rs`.`hrg_satuan` * `item_transaksi_rs`.`jumlah`) AS total_harga
    , `item_transaksi_rs`.`id_item`
    , `rayon_karyawan`.`id_rayon`
    , `wilayah_karyawan`.`id_wilayah`
    , `mitra_karyawan`.`id_mitra`
    , `master_dokter`.`nama_dokter`
    , `transaksi_rmh_sakit`.`tgl_masuk`
    , `transaksi_rmh_sakit`.`tgl_keluar`
    , master_provider.`nama_provider`
    , master_diagnosa.`nama_diagnosa`
    , master_item.`idjns_item`
FROM
    `simkesbaru`.`transaksi`
    INNER JOIN `simkesbaru`.`master_tertanggung` 
        ON (`transaksi`.`id_tertanggung` = `master_tertanggung`.`id_tertanggung`)
    INNER JOIN `simkesbaru`.`master_karyawan` 
        ON (`master_tertanggung`.`id_karyawan` = `master_karyawan`.`id_karyawan`)
    INNER JOIN `simkesbaru`.`rayon_karyawan` 
        ON (`master_karyawan`.`id_rayon` = `rayon_karyawan`.`id_rayon`)
    INNER JOIN `simkesbaru`.`wilayah_karyawan` 
        ON (`rayon_karyawan`.`id_wilayah` = `wilayah_karyawan`.`id_wilayah`)
    INNER JOIN `simkesbaru`.`mitra_karyawan` 
        ON (`wilayah_karyawan`.`id_mitra` = `mitra_karyawan`.`id_mitra`)
    INNER JOIN `simkesbaru`.`transaksi_rmh_sakit` 
        ON (`transaksi_rmh_sakit`.`id_transaksi` = `transaksi`.`id_transaksi`)
    INNER JOIN `simkesbaru`.`item_transaksi_rs` 
        ON (`item_transaksi_rs`.`id_transaksi` = `transaksi`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`master_item` 
        ON (`item_transaksi_rs`.`id_item` = `master_item`.`id_item`)
    LEFT JOIN `simkesbaru`.`master_dokter` 
        ON (`item_transaksi_rs`.`id_dokter` = `master_dokter`.`id_dokter`)
    LEFT JOIN simkesbaru.`master_provider`
        ON (`transaksi_rmh_sakit`.`id_provider` = master_provider.`id_provider`)
    LEFT JOIN `transaksi_diagnosa`
	ON (`transaksi`.`id_transaksi` = transaksi_diagnosa.`id_transaksi`)
    LEFT JOIN master_diagnosa
        ON (transaksi_diagnosa.`id_diagnosa` = master_diagnosa.`id_diagnosa`)	
	WHERE `transaksi_rmh_sakit`.`idjenis_rawat` = 1		
        GROUP BY `transaksi`.`id_transaksi`
       