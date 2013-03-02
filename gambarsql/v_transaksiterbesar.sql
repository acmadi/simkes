
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_transaksiterbesar` 
    AS
SELECT
    `master_karyawan`.`nip`
    , `master_karyawan`.`nama_karyawan`
    , `transaksi`.`tgl_transaksi`
    , `rayon_karyawan`.`id_rayon`
    , `rayon_karyawan`.`id_wilayah`
    , `wilayah_karyawan`.`id_mitra`
    , COALESCE(SUM(`item_transaksi_apotek`.`total`),0) AS total_apotek
    , COALESCE(SUM(`item_transaksi_dak`.`total`),0) AS total_dak
    , COALESCE(SUM(`item_transaksi_dokter`.`total`),0) AS total_dokter
    , COALESCE(SUM(`item_transaksi_gigi`.`total`),0) AS total_gigi
    , COALESCE(SUM(`item_transaksi_lab`.`total`),0) AS total_lab
    , COALESCE(SUM(`item_transaksi_lain`.`total`),0) AS total_lain
    , COALESCE(SUM(`item_transaksi_optik`.`total`),0) AS total_optik
    , COALESCE(SUM(`item_transaksi_penunjang`.`total`),0) AS total_penunjang
    , COALESCE(SUM(`item_transaksi_rs`.`total`),0) AS total_transaksi_rs
    , COALESCE(SUM(`item_transaksi_apotek`.`total`),0) + COALESCE(SUM(`item_transaksi_dak`.`total`),0) + COALESCE(SUM(`item_transaksi_dokter`.`total`),0) + COALESCE(SUM(`item_transaksi_gigi`.`total`),0) + COALESCE(SUM(`item_transaksi_lab`.`total`),0) + COALESCE(SUM(`item_transaksi_lain`.`total`),0) + (COALESCE(SUM(`item_transaksi_optik`.`total`),0)  + COALESCE(SUM(`item_transaksi_penunjang`.`total`),0) + COALESCE(SUM(`item_transaksi_rs`.`total`),0)) AS total
    
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
    LEFT JOIN `simkesbaru`.`item_transaksi_apotek` 
        ON (`item_transaksi_apotek`.`id_transaksi` = `transaksi`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`item_transaksi_dak` 
        ON (`item_transaksi_dak`.`id_transaksi` = `transaksi`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`item_transaksi_dokter` 
        ON (`item_transaksi_dokter`.`id_transaksi` = `transaksi`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`item_transaksi_gigi` 
        ON (`item_transaksi_gigi`.`id_transaksi` = `transaksi`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`item_transaksi_lab` 
        ON (`item_transaksi_lab`.`id_transaksi` = `transaksi`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`item_transaksi_lain` 
        ON (`item_transaksi_lain`.`id_transaksi` = `transaksi`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`item_transaksi_optik` 
        ON (`item_transaksi_optik`.`id_transaksi` = `transaksi`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`item_transaksi_penunjang` 
        ON (`item_transaksi_penunjang`.`id_transaksi` = `transaksi`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`item_transaksi_rs` 
        ON (`item_transaksi_rs`.`id_transaksi` = `transaksi`.`id_transaksi`)
        
	GROUP BY nip 
	ORDER BY total DESC	
        ;