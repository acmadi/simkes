CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_detail_item_transaksidokter` 
    AS
SELECT
    `item_transaksi_dokter`.`id_transaksi`
    , `jenis_item`.`jenis_item`
    , `master_item`.`nama_item`
    , `item_transaksi_dokter`.`jumlah`
    , `master_item`.`harga_item`
    , `item_transaksi_dokter`.`id_transaksi_dokter`
    , `item_transaksi_dokter`.`hrg_satuan`
    , `item_transaksi_dokter`.`total`
    , `master_rekomendasi`.`nama_rekomendasi`
    , `master_dosis`.`nama_dosis`
FROM
    `simkesbaru`.`item_transaksi_dokter`
    INNER JOIN `simkesbaru`.`master_item` 
        ON (`item_transaksi_dokter`.`id_item` = `master_item`.`id_item`)
    INNER JOIN `simkesbaru`.`jenis_item` 
        ON (`master_item`.`idjns_item` = `jenis_item`.`idjns_item`)
    LEFT JOIN `simkesbaru`.`master_rekomendasi` 
        ON (`item_transaksi_dokter`.`id_rekomendasi` = `master_rekomendasi`.`id_rekomendasi`)
    LEFT JOIN `simkesbaru`.`dosis_item` 
        ON (`dosis_item`.`id_item` = `master_item`.`id_item`)
    LEFT JOIN `simkesbaru`.`master_dosis` 
        ON (`dosis_item`.`id_dosis` = `master_dosis`.`id_dosis`)
    GROUP BY `simkesbaru`.`item_transaksi_dokter`.`id_transaksi_dokter`, `dosis_item`.`id_item`    
        ;