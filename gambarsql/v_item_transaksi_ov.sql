DELIMITER $$

USE `simkesbaru`$$

DROP VIEW IF EXISTS `v_item_transaksi_ov`$$

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_item_transaksi_ov` AS (
SELECT
  `a`.`id_transaksi_ov`  AS `id_transaksi_ov`,
  a.id_transaksi  	 AS id_transaksi,
  `b`.`nama_dokter`      AS `nama_dokter`,
  `b`.`tarif_standar`    AS `tarif_standar`,
  `a`.`hrg_satuan`       AS `hrg_satuan`,
  `a`.`jumlah`           AS `jumlah`,
  (`a`.`hrg_satuan` * `a`.`jumlah`) AS `total`,
  `a`.`ov`               AS `ov`,
  `c`.`nama_rekomendasi` AS `nama_rekomendasi`,
  `a`.`disetujui`        AS `disetujui`
FROM ((`transaksi_ov` `a`
    JOIN `master_dokter` `b`)
   JOIN `master_rekomendasi` `c`
     ON (((`a`.`id_dokter` = `b`.`id_dokter`)
          AND (`a`.`d_rekomendasi` = `c`.`id_rekomendasi`))))
GROUP BY `a`.`id_transaksi_ov`)$$

DELIMITER ;