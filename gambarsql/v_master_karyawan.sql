
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_master_karyawan` 
    AS
(SELECT
  `mk`.`id_karyawan`   AS `id_karyawan`,
  `mk`.`nip`           AS `nip`,
  `mk`.`nama_karyawan` AS `nama_karyawan`,
  `mk`.`alamat`        AS `alamat`,
  `mk`.`sex`           AS `sex`,
  `mk`.`telp`          AS `telp`,
  `mk`.`ttl`           AS `ttl`,
  `mk`.`tgl_lahir`     AS `tgl_lahir`,
  `mk`.`ap`            AS `ap`,
  `mk`.`status`        AS `status`,
  `sk`.`nama_status`   AS `nama_status`,
  `mk`.`kelas_kamar`   AS `kelas_kamar`,
   mk.`id_bagian`      AS  `id_bagian`,
  `bk`.`nama_bagian`   AS `nama_bagian`,
  `rk`.`id_rayon`      AS `id_rayon`,
  `rk`.`id_wilayah`    AS `id_wilayah`,
  `wk`.`id_mitra`      AS `id_mitra`,
  `rk`.`nama_rayon`    AS `nama_rayon`
FROM `master_karyawan` `mk`
     JOIN `rayon_karyawan` `rk`
       ON (`rk`.`id_rayon` = `mk`.`id_rayon`)
    JOIN `wilayah_karyawan` `wk`
      ON (`wk`.`id_wilayah` = `rk`.`id_wilayah`)
    LEFT JOIN `bagian_karyawan` `bk`
     ON (`bk`.`id_bagian` = `mk`.`id_bagian`)
    LEFT JOIN `status_karyawan` sk
     ON sk.`id_status` = mk.`status` 

);
