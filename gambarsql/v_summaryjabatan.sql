
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_summaryjabatanterbanyak` 
    AS

SELECT
     `rayon_karyawan`.`id_rayon`
    , transaksi.id_transaksi 
    ,`transaksi`.`tgl_transaksi`
    ,`transaksi`.`tgl_kunjungan`
    , `rayon_karyawan`.`id_wilayah`
    , `wilayah_karyawan`.`id_mitra`
    , `bagian_karyawan`.`nama_bagian`
    , `bagian_karyawan`.`id_bagian`
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
    LEFT JOIN `simkesbaru`.`bagian_karyawan` 
        ON (`master_karyawan`.`id_bagian` = `bagian_karyawan`.`id_bagian`)
   -- WHERE rayon_karyawan.id_rayon = 10  
      
--	GROUP BY rayon_karyawan.`id_rayon`,master_karyawan.`id_bagian`
   GROUP BY transaksi.`id_transaksi` 
      
--	ORDER BY total DESC	
        ;
