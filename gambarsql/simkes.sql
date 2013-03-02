SELECT
    `transaksi`.`id_transaksi`
    , `transaksi`.`tgl_transaksi`
    , `transaksi`.`tgl_kunjungan`
    , `master_karyawan`.`nip`
    , `master_karyawan`.`nama_karyawan`
    , `master_karyawan`.`ap`
    , `master_tertanggung`.`nama_tertanggung`
    , `master_tertanggung`.`status`
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
ORDER BY `transaksi`.`id_transaksi` ASC;