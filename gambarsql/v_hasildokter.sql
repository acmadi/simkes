SELECT
    `transaksi`.`id_transaksi`
    , `transaksi`.`tgl_transaksi`
    , `transaksi`.`tgl_kunjungan`
    , `transaksi_dokter`.`no_surat`
    , `transaksi_dokter`.`no_bukti`
    , `transaksi_dokter`.`restitusi`
    , `master_karyawan`.`nip`
    , `master_karyawan`.`nama_karyawan`
    , `master_tertanggung`.`nama_tertanggung`
    , `master_diagnosa`.`nama_diagnosa`
    , `master_dokter`.`tarif_standar`
    , `rayon_karyawan`.`id_rayon`
    , `wilayah_karyawan`.`id_wilayah`
    , `mitra_karyawan`.`id_mitra`
    , `master_dokter`.`nama_dokter`
    , `master_buku_besar`.`buku_besar`
FROM
    `simkesbaru`.`transaksi_dokter`
    INNER JOIN `simkesbaru`.`transaksi` 
        ON (`transaksi_dokter`.`id_transaksi` = `transaksi`.`id_transaksi`)
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
        ON (`transaksi_dokter`.`id_dokter` = `master_dokter`.`id_dokter`)
    INNER JOIN `simkesbaru`.`transaksi_diagnosa` 
        ON (`transaksi_diagnosa`.`id_transaksi` = `transaksi`.`id_transaksi`)
    INNER JOIN `simkesbaru`.`master_diagnosa` 
        ON (`transaksi_diagnosa`.`id_diagnosa` = `master_diagnosa`.`id_diagnosa`)
    LEFT JOIN `simkesbaru`.`master_buku_besar` 
        ON (`master_buku_besar`.`id_transaksi` = `transaksi`.`id_transaksi`);