
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_detail_item_transaksipenunjang` 
    AS
SELECT
    `transaksi`.`id_transaksi`
    , `jenis_item`.`jenis_item`
    , `item_transaksi_penunjang`.`id_item_transaksi_penunjang`
    , `master_item`.`nama_item`
    , `item_transaksi_penunjang`.`jumlah`
    , `master_item`.`harga_item`
    , `item_transaksi_penunjang`.`hrg_satuan`
    , `item_transaksi_penunjang`.`total`
    , `master_rekomendasi`.`nama_rekomendasi`
    , `master_dosis`.`nama_dosis`
FROM
    `simkesbaru`.`item_transaksi_penunjang`
    INNER JOIN `simkesbaru`.`transaksi` 
        ON (`item_transaksi_penunjang`.`id_transaksi` = `transaksi`.`id_transaksi`)
    INNER JOIN `simkesbaru`.`master_item` 
        ON (`item_transaksi_penunjang`.`id_item` = `master_item`.`id_item`)
    INNER JOIN `simkesbaru`.`jenis_item` 
        ON (`master_item`.`idjns_item` = `jenis_item`.`idjns_item`)
    LEFT JOIN `simkesbaru`.`master_rekomendasi` 
        ON (`item_transaksi_penunjang`.`id_rekomendasi` = `master_rekomendasi`.`id_rekomendasi`)
    LEFT JOIN `simkesbaru`.`dosis_item` 
        ON (`dosis_item`.`id_item` = `master_item`.`id_item`) AND (`dosis_item`.`id_transaksi` = `transaksi`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`master_dosis` 
        ON (`dosis_item`.`id_dosis` = `master_dosis`.`id_dosis`)
    GROUP BY `item_transaksi_penunjang`.`id_item_transaksi_penunjang`,`dosis_item`.`id_item`        
        ;