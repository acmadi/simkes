
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_hasiltransaksigigi` 
    AS
SELECT
    `transaksi`.`id_transaksi`
    , `transaksi`.`tgl_transaksi`
    , `transaksi`.`tgl_kunjungan`
    , `transaksi_gigi`.`no_surat`
    , `transaksi_gigi`.`no_bukti`
    , `transaksi_gigi`.`restitusi`
    , `master_karyawan`.`nip`
    , `master_karyawan`.`nama_karyawan`
    , `master_tertanggung`.`nama_tertanggung`
    , `master_dokter`.`nama_dokter`
    , `master_provider`.`nama_provider`
    , GROUP_CONCAT(`master_diagnosa`.`nama_diagnosa` SEPARATOR ",") AS nama_diagnosa
    , `rayon_karyawan`.`id_rayon`
    , `wilayah_karyawan`.`id_wilayah`
    , `mitra_karyawan`.`id_mitra`
    , `master_buku_besar`.`buku_besar`
FROM
    `simkesbaru`.`transaksi_gigi`
    INNER JOIN `simkesbaru`.`transaksi` 
        ON (`transaksi_gigi`.`id_transaksi` = `transaksi`.`id_transaksi`)
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
    INNER JOIN `simkesbaru`.`master_dokter` 
        ON (`transaksi_gigi`.`id_dokter` = `master_dokter`.`id_dokter`)
     JOIN `simkesbaru`.`master_provider` 
        ON (`transaksi_gigi`.`id_provider` = `master_provider`.`id_provider`)
    LEFT JOIN `simkesbaru`.`transaksi_diagnosa` 
        ON (`transaksi_diagnosa`.`id_transaksi` = `transaksi`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`master_diagnosa` 
        ON (`transaksi_diagnosa`.`id_diagnosa` = `master_diagnosa`.`id_diagnosa`)
    LEFT JOIN `simkesbaru`.`master_buku_besar` 
        ON (`master_buku_besar`.`id_transaksi` = `transaksi`.`id_transaksi`)
     GROUP BY  `id_transaksi`
        ;