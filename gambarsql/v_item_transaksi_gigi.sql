
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_item_transaksi_gigi` 
    AS
SELECT itg.`id_item_transaksi_gigi`,
 itg.`id_transaksi`,
 ji.`jenis_item`,
 mi.`nama_item`,
 mi.`harga_item`,
 itg.`hrg_satuan`,
 itg.`jumlah`,
 (itg.`jumlah` * itg.hrg_satuan) AS`total`,
 ((mi.`harga_item` * itg.`jumlah`)-(itg.`jumlah` * itg.hrg_satuan)) AS selisih,
 itg.`satuan`,
 itg.`disetujui`,
 mr.`nama_rekomendasi`
FROM `item_transaksi_gigi` itg
JOIN `master_item` mi ON mi.`id_item` = itg.`id_item`
JOIN `jenis_item` ji ON ji.`idjns_item` = mi.`idjns_item`
JOIN `master_rekomendasi` mr ON mr.`id_rekomendasi` = itg.`id_rekomendasi`