
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_hasiltransaksirm` 
    AS

SELECT
  `simkesbaru`.`transaksi`.`id_transaksi`              AS `id_transaksi`,
  `simkesbaru`.`transaksi`.`tgl_transaksi`             AS `tgl_transaksi`,
  `simkesbaru`.`transaksi_rekam_medis`.`tgl_masuk`     AS `tgl_masuk`,
  `simkesbaru`.`transaksi_rekam_medis`.`tgl_keluar`    AS `tgl_keluar`,
  `simkesbaru`.`transaksi_rekam_medis`.`no_kamar`    AS `no_rm`,
  `simkesbaru`.`master_karyawan`.`nip`                 AS `nip`,
  `simkesbaru`.`master_karyawan`.`nama_karyawan`       AS `nama_karyawan`,
  `simkesbaru`.`master_tertanggung`.`nama_tertanggung` AS `nama_tertanggung`,
  `simkesbaru`.`master_provider`.`nama_provider`       AS `nama_provider`,
  `simkesbaru`.`periksa_rekam_medis`.`diagnosa_masuk`  AS `diagnosa_masuk`,
  `simkesbaru`.`periksa_rekam_medis`.`diagnosa_keluar` AS `diagnosa_keluar`,
  `simkesbaru`.`periksa_rekam_medis`.`riwayat`         AS `riwayat`,
  `simkesbaru`.`periksa_rekam_medis`.`periksa_fisik`   AS `periksa_fisik`,
  `simkesbaru`.`periksa_rekam_medis`.`hasil_lab`       AS `hasil_lab`,
  `simkesbaru`.`periksa_rekam_medis`.`hasil_rontgen`   AS `hasil_rontgen`,
  `simkesbaru`.`periksa_rekam_medis`.`hasil_lain`      AS `hasil_lain`,
  `simkesbaru`.`periksa_rekam_medis`.`progres_harian`  AS `progres_harian`,
  `simkesbaru`.`periksa_rekam_medis`.`pasca_rawat`     AS `pasca_rawat`,
  `simkesbaru`.`periksa_rekam_medis`.`tindakan`        AS `tindakan`,
  `simkesbaru`.`rayon_karyawan`.`id_rayon`             AS `id_rayon`,
  `simkesbaru`.`wilayah_karyawan`.`id_wilayah`         AS `id_wilayah`,
  `simkesbaru`.`mitra_karyawan`.`id_mitra`             AS `id_mitra`
FROM `simkesbaru`.`transaksi_rekam_medis`
          JOIN `simkesbaru`.`transaksi`
            ON ((`simkesbaru`.`transaksi_rekam_medis`.`id_transaksi` = `simkesbaru`.`transaksi`.`id_transaksi`))
         JOIN `simkesbaru`.`master_tertanggung`
           ON ((`simkesbaru`.`transaksi`.`id_tertanggung` = `simkesbaru`.`master_tertanggung`.`id_tertanggung`))
        JOIN `simkesbaru`.`master_karyawan`
          ON ((`simkesbaru`.`master_tertanggung`.`id_karyawan` = `simkesbaru`.`master_karyawan`.`id_karyawan`))
       JOIN `simkesbaru`.`rayon_karyawan`
         ON ((`simkesbaru`.`master_karyawan`.`id_rayon` = `simkesbaru`.`rayon_karyawan`.`id_rayon`))
      JOIN `simkesbaru`.`wilayah_karyawan`
        ON ((`simkesbaru`.`rayon_karyawan`.`id_wilayah` = `simkesbaru`.`wilayah_karyawan`.`id_wilayah`))
     JOIN `simkesbaru`.`mitra_karyawan`
       ON ((`simkesbaru`.`wilayah_karyawan`.`id_mitra` = `simkesbaru`.`mitra_karyawan`.`id_mitra`))
    JOIN `simkesbaru`.`master_provider`
      ON ((`simkesbaru`.`transaksi_rekam_medis`.`id_provider` = `simkesbaru`.`master_provider`.`id_provider`))
   LEFT JOIN `simkesbaru`.`periksa_rekam_medis`
     ON ((`simkesbaru`.`periksa_rekam_medis`.`id_transaksi` = `simkesbaru`.`transaksi`.`id_transaksi`))