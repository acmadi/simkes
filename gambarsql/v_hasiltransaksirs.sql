
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_hasiltransaksirs` 
    AS
SELECT
    `transaksi`.`id_transaksi`
    , `transaksi`.`tgl_transaksi`
    , `transaksi_rmh_sakit`.`no_surat`
    , `transaksi_rmh_sakit`.`no_bukti`
    , `transaksi_rmh_sakit`.`restitusi`
    , `master_karyawan`.`nip`
    , `master_karyawan`.`nama_karyawan`
    , `master_tertanggung`.`nama_tertanggung`
    , `transaksi_rmh_sakit`.`tgl_masuk`
    , `transaksi_rmh_sakit`.`tgl_keluar`
    , `jenis_rawat`.`nama_rawat`
    , `master_provider`.`nama_provider`
    , GROUP_CONCAT(`master_diagnosa`.`nama_diagnosa` SEPARATOR ",") AS nama_diagnosa
    , `rayon_karyawan`.`id_rayon`
    , `wilayah_karyawan`.`id_wilayah`
    , `mitra_karyawan`.`id_mitra`
    , `master_buku_besar`.`buku_besar`
FROM
    `simkesbaru`.`transaksi_rmh_sakit`
    INNER JOIN `simkesbaru`.`transaksi` 
        ON (`transaksi_rmh_sakit`.`id_transaksi` = `transaksi`.`id_transaksi`)
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
    LEFT JOIN `simkesbaru`.`jenis_rawat` 
        ON (`transaksi_rmh_sakit`.`idjenis_rawat` = `jenis_rawat`.`idjenis_rawat`)
    LEFT JOIN `simkesbaru`.`master_provider` 
        ON (`transaksi_rmh_sakit`.`id_provider` = `master_provider`.`id_provider`)
    LEFT JOIN `simkesbaru`.`transaksi_diagnosa` 
        ON (`transaksi_diagnosa`.`id_transaksi` = `transaksi`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`master_diagnosa` 
        ON (`transaksi_diagnosa`.`id_diagnosa` = `master_diagnosa`.`id_diagnosa`)
    LEFT JOIN `simkesbaru`.`master_buku_besar` 
        ON (`master_buku_besar`.`id_transaksi` = `transaksi`.`id_transaksi`)
    GROUP BY id_transaksi		
        ;