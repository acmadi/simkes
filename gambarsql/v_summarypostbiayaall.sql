
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_summarypostbiayaall` 
    AS
SELECT
  t.tgl_transaksi,
  t.tgl_kunjungan, 
  `rk`.`id_rayon`       AS `id_rayon`,
  `wk`.`id_wilayah`     AS `id_wilayah`,
  `wk`.`id_mitra`       AS `id_mitra`,
  `md`.`jenis_penyakit` AS `jenis_penyakit`,
  `mk`.`ap`             AS `ap`,
  `mt`.`status`         AS `status`,
  COUNT(*)              AS `jumlah`,
  SUM(COALESCE(`ita`.`total`,0)) + SUM(COALESCE(`itd`.`total`,0)) + SUM(COALESCE(`itda`.`total`,0)) + SUM(COALESCE(`itg`.`total`,0)) + SUM(COALESCE(`itlab`.`total`,0)) + SUM(COALESCE(`itl`.`total`,0)) + SUM(COALESCE(`ito`.`total`,0)) + SUM(COALESCE(`itp`.`total`,0)) + SUM(COALESCE(`itr`.`total`,0)) AS `total_transaksi`
FROM 
`transaksi` `t`
                   LEFT JOIN `item_transaksi_apotek` `ita`
                     ON ((`t`.`id_transaksi` = `ita`.`id_transaksi`))
                  LEFT JOIN `item_transaksi_dak` `itda`
                    ON ((`t`.`id_transaksi` = `itda`.`id_transaksi`))
                 LEFT JOIN `item_transaksi_dokter` `itd`
                   ON ((`t`.`id_transaksi` = `itd`.`id_transaksi`))
                LEFT JOIN `item_transaksi_gigi` `itg`
                  ON ((`t`.`id_transaksi` = `itg`.`id_transaksi`))
               LEFT JOIN `item_transaksi_lab` `itlab`
                 ON ((`t`.`id_transaksi` = `itlab`.`id_transaksi`))
              LEFT JOIN `item_transaksi_lain` `itl`
                ON ((`t`.`id_transaksi` = `itl`.`id_transaksi`))
             LEFT JOIN `item_transaksi_optik` `ito`
               ON ((`t`.`id_transaksi` = `ito`.`id_transaksi`))
            LEFT JOIN `item_transaksi_penunjang` `itp`
              ON ((`t`.`id_transaksi` = `itp`.`id_transaksi`))
           LEFT JOIN `item_transaksi_rs` `itr`
             ON ((`t`.`id_transaksi` = `itr`.`id_transaksi`))
          LEFT JOIN `transaksi_diagnosa` `td`
            ON ((`t`.`id_transaksi` = `td`.`id_transaksi`))
         JOIN `master_diagnosa` `md`
           ON ((`td`.`id_diagnosa` = `md`.`id_diagnosa`))
        LEFT JOIN `master_item` `mi`
          ON (((`ita`.`id_item` = `mi`.`id_item`)
                OR (`itda`.`id_item` = `mi`.`id_item`)
                OR (`itd`.`id_item` = `mi`.`id_item`)
                OR (`itg`.`id_item` = `mi`.`id_item`)
                OR (`itlab`.`id_item` = `mi`.`id_item`)
                OR (`itl`.`id_item` = `mi`.`id_item`)
                OR (`ito`.`id_item` = `mi`.`id_item`)
                OR (`itp`.`id_item` = `mi`.`id_item`)
                OR (`itr`.`id_item` = `mi`.`id_item`)))
       JOIN `jenis_item` `ji`
         ON ((`mi`.`idjns_item` = `ji`.`idjns_item`))
      JOIN `master_tertanggung` `mt`
        ON ((`t`.`id_tertanggung` = `mt`.`id_tertanggung`))
     JOIN `master_karyawan` `mk`
       ON ((`mt`.`id_karyawan` = `mk`.`id_karyawan`))
    JOIN `rayon_karyawan` `rk`
      ON ((`mk`.`id_rayon` = `rk`.`id_rayon`))
   JOIN `wilayah_karyawan` `wk`
     ON ((`rk`.`id_wilayah` = `wk`.`id_wilayah`))
GROUP BY `rk`.`id_rayon`,`md`.`jenis_penyakit`,`mk`.`ap`,`mt`.`status`
