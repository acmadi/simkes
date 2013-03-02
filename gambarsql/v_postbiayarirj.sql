
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_postbiayarirj` 
    AS
SELECT 
 rk.id_rayon, wk.id_wilayah, wk.id_mitra ,t.`id_transaksi`, ji.jenis_item--
-- ,coalesce(ita.`total`,0) 
-- , coalesce(itda.total,0)  
-- , coalesce(itd.`total`,0) 
-- , coalesce(itg.total,0) 
-- ,coalesce( itlab.total,0)
-- , coalesce(itl.total,0)
-- , coalesce(ito.total,0)
-- , COALESCE(itp.total,0)
-- , coalesce(itr.total,0)
-- , sum(COALESCE(ita.`total`,0)) as total_apotek
--  , sum(COALESCE(itd.`total`,0)) as total_dokter 
--  , SUM(coalesce(itda.`total`,0)) AS total_dak
--  , sum(COALESCE(itg.`total`,0)) as total_gigi
--  , SUM(coalesce(itlab.`total`,0)) AS total_lab 
--  , SUM(coalesce(itl.`total`,0)) AS total_lain 
--  , SUM(coalesce(ito.`total`,0)) AS total_optik
--  , SUM(coalesce(itp.`total`,0)) AS total_penunjang 
--  , SUM(coalesce(itr.`total`,0)) AS total_rs
  , (SUM(COALESCE(ita.`total`,0)) + SUM(COALESCE(itd.`total`,0)) + SUM(COALESCE(itda.`total`,0)) +SUM(COALESCE(itg.`total`,0)) + SUM(COALESCE(itlab.`total`,0)) + SUM(COALESCE(itl.`total`,0))
     + SUM(COALESCE(ito.`total`,0)) + SUM(COALESCE(itp.`total`,0)) + SUM(COALESCE(itr.`total`,0)))AS total_transaksi 
 
FROM `simkesbaru`.`transaksi` t 

LEFT JOIN `simkesbaru`.`item_transaksi_apotek` ita ON t.`id_transaksi` = ita.`id_transaksi`
 LEFT JOIN `simkesbaru`.`item_transaksi_dak` itda ON t.`id_transaksi` = itda.`id_transaksi`
 LEFT JOIN `simkesbaru`.`item_transaksi_dokter` itd ON t.`id_transaksi` = itd.`id_transaksi`
 LEFT JOIN `simkesbaru`.`item_transaksi_gigi` itg ON t.`id_transaksi` = itg.`id_transaksi`
 LEFT JOIN `simkesbaru`.`item_transaksi_lab` itlab ON t.`id_transaksi` = itlab.`id_transaksi`
 LEFT JOIN `simkesbaru`.`item_transaksi_lain` itl ON t.`id_transaksi` = itl.`id_transaksi`
 LEFT JOIN `simkesbaru`.`item_transaksi_optik` ito ON t.`id_transaksi` = ito.`id_transaksi`
 LEFT JOIN `simkesbaru`.`item_transaksi_penunjang` itp ON t.`id_transaksi` = itp.`id_transaksi`
 LEFT JOIN simkesbaru.`item_transaksi_rs` itr ON t.`id_transaksi` = itr.id_transaksi
  

LEFT JOIN `master_item` mi ON ita.`id_item` = mi.`id_item`  OR itda.`id_item` = mi.id_item  OR itd.`id_item` = mi.id_item  OR itg.`id_item` = mi.id_item  OR itlab.`id_item` = mi.id_item  OR itl.`id_item` = mi.id_item  OR ito.`id_item` = mi.id_item  OR itp.`id_item` = mi.id_item  OR itr.`id_item` = mi.id_item
 JOIN `simkesbaru`.jenis_item ji ON mi.`idjns_item` = ji.idjns_item
 JOIN `simkesbaru`.`master_tertanggung` mt ON t.`id_tertanggung`=mt.`id_tertanggung` 
 JOIN `simkesbaru`.`master_karyawan` mk ON mt.`id_karyawan` = mk.`id_karyawan`
 JOIN `simkesbaru`.rayon_karyawan rk ON mk.`id_rayon` = rk.`id_rayon`
 JOIN `simkesbaru`.wilayah_karyawan wk ON rk.id_wilayah = wk.id_wilayah 
 -- where rk.id_rayon = 10
  GROUP BY rk.id_rayon,wk.id_wilayah,ji.idjns_item
   
