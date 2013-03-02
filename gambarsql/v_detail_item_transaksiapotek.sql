
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_detail_item_transaksiapotek` 
    AS
    
SELECT 
    `item_transaksi_apotek`.`id_transaksi`
   , `jenis_item`.`jenis_item`
    , `master_item`.`nama_item`
    , `item_transaksi_apotek`.`jumlah`
    , `master_item`.`harga_item`
    , `item_transaksi_apotek`.`id_item_transaksi_apotek`
    , `item_transaksi_apotek`.`hrg_satuan`
    , `master_rekomendasi`.`nama_rekomendasi`
    , `item_transaksi_apotek`.`total`
    , `master_dosis`.`nama_dosis`
FROM
    `simkesbaru`.`item_transaksi_apotek`
    INNER JOIN `simkesbaru`.`transaksi` 
        ON (`item_transaksi_apotek`.`id_transaksi` = `transaksi`.`id_transaksi`)
    INNER JOIN `simkesbaru`.`master_item` 
        ON (`item_transaksi_apotek`.`id_item` = `master_item`.`id_item`)
    LEFT JOIN `simkesbaru`.`master_rekomendasi` 
        ON (`item_transaksi_apotek`.`id_rekomendasi` = `master_rekomendasi`.`id_rekomendasi`)
    INNER JOIN `simkesbaru`.`jenis_item` 
        ON (`master_item`.`idjns_item` = `jenis_item`.`idjns_item`)
    LEFT JOIN `simkesbaru`.`dosis_item` 
       ON (`dosis_item`.`id_item` = `master_item`.`id_item`)  AND (`dosis_item`.`id_transaksi` = `transaksi`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`master_dosis` 
        ON (`dosis_item`.`id_dosis` = `master_dosis`.`id_dosis`)
    GROUP BY `item_transaksi_apotek`.`id_item_transaksi_apotek`, `simkesbaru`.`dosis_item`.`id_item`        
        ;