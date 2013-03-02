(
SELECT
    `transaksi`.`id_transaksi`
    , `transaksi`.`tgl_transaksi`
    , `transaksi`.`tgl_kunjungan`
    , `master_karyawan`.`nip`
    , `master_karyawan`.`nama_karyawan`
    , `master_karyawan`.`ap`
    , `master_tertanggung`.`nama_tertanggung`
    , `master_tertanggung`.`status`
    , `transaksi_apotek`.`restitusi`
    , `master_tertanggung`.`ditanggung`
    , `master_item`.`nama_item`
    , `master_item`.`hba_item`
    , `item_transaksi_apotek`.`hrg_satuan`
    , `item_transaksi_apotek`.`jumlah`
    , SUM(`item_transaksi_apotek`.`hrg_satuan` * `item_transaksi_apotek`.`jumlah`) AS total_harga
    , `item_transaksi_apotek`.`id_item`
    , `jenis_item`.`jenis_item`
    , `master_item`.`idjns_item`
    , `rayon_karyawan`.`id_rayon`
    , `wilayah_karyawan`.`id_wilayah`
    , `mitra_karyawan`.`id_mitra`
    , `master_dokter`.`nama_dokter`
    , `transaksi_apotek`.`id_rujukan`
    , `master_provider`.`nama_provider`
    , `master_buku_besar`.`buku_besar`
    , `master_diagnosa`.`nama_diagnosa`
    
FROM
    `simkesbaru`.`transaksi`
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
    INNER JOIN `simkesbaru`.`item_transaksi_apotek` 
        ON (`item_transaksi_apotek`.`id_transaksi` = `transaksi`.`id_transaksi`)
    INNER JOIN `simkesbaru`.`master_item` 
        ON (`item_transaksi_apotek`.`id_item` = `master_item`.`id_item`)
    INNER JOIN `simkesbaru`.`jenis_item` 
        ON (`master_item`.`idjns_item` = `jenis_item`.`idjns_item`)
    INNER JOIN `simkesbaru`.`master_rekomendasi` 
        ON (`item_transaksi_apotek`.`id_rekomendasi` = `master_rekomendasi`.`id_rekomendasi`)
    INNER JOIN `simkesbaru`.`transaksi_apotek` 
        ON (`transaksi_apotek`.`id_transaksi` = `transaksi`.`id_transaksi`)
    INNER JOIN `simkesbaru`.`master_dokter` 
        ON (`transaksi_apotek`.`id_dokter` = `master_dokter`.`id_dokter`)
    INNER JOIN `simkesbaru`.`golongan_dokter` 
        ON (`master_dokter`.`gol_dokter` = `golongan_dokter`.`gol_dokter`)
    INNER JOIN `simkesbaru`.`kategori_dokter` 
        ON (`master_dokter`.`kat_dokter` = `kategori_dokter`.`kat_dokter`)
    INNER JOIN `simkesbaru`.`master_rujukan` 
        ON (`transaksi_apotek`.`id_rujukan` = `master_rujukan`.`id_rujukan`)
    INNER JOIN `simkesbaru`.`master_provider` 
        ON (`transaksi_apotek`.`id_provider` = `master_provider`.`id_provider`)
    LEFT JOIN `simkesbaru`.`master_buku_besar` 
        ON (`transaksi`.`id_transaksi` = `master_buku_besar`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`transaksi_diagnosa`
        ON (`transaksi`.`id_transaksi` = `transaksi_diagnosa`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`master_diagnosa`
        ON (`transaksi_diagnosa`.`id_diagnosa` = `master_diagnosa`.`id_diagnosa`)
GROUP BY `transaksi`.`id_transaksi`
	
)
UNION
(
SELECT
    `transaksi`.`id_transaksi`
    , `transaksi`.`tgl_transaksi`
    , `transaksi`.`tgl_kunjungan`
    , `master_karyawan`.`nip`
    , `master_karyawan`.`nama_karyawan`
    , `master_karyawan`.`ap`
    , `master_tertanggung`.`nama_tertanggung`
    , `master_tertanggung`.`status`
    , NULL AS restitusi	
    , `master_tertanggung`.`ditanggung`
    , `master_item`.`nama_item`
    , `master_item`.`hba_item`
    , NULL AS `harga_satuan`
    , `item_transaksi_dak`.`jumlah`
    , NULL  AS total_harga
    , `item_transaksi_dak`.`id_item`
    , `jenis_item`.`jenis_item`
    , `master_item`.`idjns_item`
    , `rayon_karyawan`.`id_rayon`
    , `wilayah_karyawan`.`id_wilayah`
    , `mitra_karyawan`.`id_mitra`
    , `master_dokter`.`nama_dokter`
    , `transaksi_dak`.`id_rujukan`
    , NULL AS `nama_provider`
    , `master_buku_besar`.`buku_besar`
    , `master_diagnosa`.`nama_diagnosa`
FROM
    `simkesbaru`.`transaksi`
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
    INNER JOIN `simkesbaru`.`item_transaksi_dak` 
        ON (`item_transaksi_dak`.`id_transaksi` = `transaksi`.`id_transaksi`)
    INNER JOIN `simkesbaru`.`master_item` 
        ON (`item_transaksi_dak`.`id_item` = `master_item`.`id_item`)
    INNER JOIN `simkesbaru`.`jenis_item` 
        ON (`master_item`.`idjns_item` = `jenis_item`.`idjns_item`)
    INNER JOIN `simkesbaru`.`master_rekomendasi` 
        ON (`item_transaksi_dak`.`id_rekomendasi` = `master_rekomendasi`.`id_rekomendasi`)
    INNER JOIN `simkesbaru`.`transaksi_dak` 
        ON (`transaksi_dak`.`id_transaksi` = `transaksi`.`id_transaksi`)
    INNER JOIN `simkesbaru`.`master_dokter` 
        ON (`transaksi_dak`.`id_dokter` = `master_dokter`.`id_dokter`)
    INNER JOIN `simkesbaru`.`golongan_dokter` 
        ON (`master_dokter`.`gol_dokter` = `golongan_dokter`.`gol_dokter`)
    INNER JOIN `simkesbaru`.`kategori_dokter` 
        ON (`master_dokter`.`kat_dokter` = `kategori_dokter`.`kat_dokter`)
    INNER JOIN `simkesbaru`.`master_rujukan` 
        ON (`transaksi_dak`.`id_rujukan` = `master_rujukan`.`id_rujukan`)
    LEFT JOIN `simkesbaru`.`master_buku_besar` 
        ON (`transaksi`.`id_transaksi` = `master_buku_besar`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`transaksi_diagnosa`
        ON (`transaksi`.`id_transaksi` = `transaksi_diagnosa`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`master_diagnosa`
        ON (`transaksi_diagnosa`.`id_diagnosa` = `master_diagnosa`.`id_diagnosa`)
)
UNION
(
SELECT
    `transaksi`.`id_transaksi`
    , `transaksi`.`tgl_transaksi`
    , `transaksi`.`tgl_kunjungan`
    , `master_karyawan`.`nip`
    , `master_karyawan`.`nama_karyawan`
    , `master_karyawan`.`ap`
    , `master_tertanggung`.`nama_tertanggung`
    , `master_tertanggung`.`status`
    , `transaksi_dokter`.`restitusi`
    , `master_tertanggung`.`ditanggung`
    , `master_item`.`nama_item`
    , `master_item`.`hba_item`
    ,  `item_transaksi_dokter`.`hrg_satuan`
    , `item_transaksi_dokter`.`jumlah`
    , (`item_transaksi_dokter`.`hrg_satuan` * `item_transaksi_dokter`.`jumlah`) AS total_harga
    , `item_transaksi_dokter`.`id_item`	
    , `jenis_item`.`jenis_item`
    , `master_item`.`idjns_item`
    , `rayon_karyawan`.`id_rayon`
    , `wilayah_karyawan`.`id_wilayah`
    , `mitra_karyawan`.`id_mitra`
    , `master_dokter`.`nama_dokter`
    , NULL AS id_rujukan
    , NULL AS `nama_provider`
    , `master_buku_besar`.`buku_besar`
    , `master_diagnosa`.`nama_diagnosa`
FROM
    `simkesbaru`.`transaksi`
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
    INNER JOIN `simkesbaru`.`item_transaksi_dokter` 
        ON (`item_transaksi_dokter`.`id_transaksi` = `transaksi`.`id_transaksi`)
    INNER JOIN `simkesbaru`.`master_item` 
        ON (`item_transaksi_dokter`.`id_item` = `master_item`.`id_item`)
    INNER JOIN `simkesbaru`.`jenis_item` 
        ON (`master_item`.`idjns_item` = `jenis_item`.`idjns_item`)
    INNER JOIN `simkesbaru`.`master_rekomendasi` 
        ON (`item_transaksi_dokter`.`id_rekomendasi` = `master_rekomendasi`.`id_rekomendasi`)
    INNER JOIN `simkesbaru`.`transaksi_dokter` 
        ON (`transaksi_dokter`.`id_transaksi` = `transaksi`.`id_transaksi`)
    INNER JOIN `simkesbaru`.`master_dokter` 
        ON (`transaksi_dokter`.`id_dokter` = `master_dokter`.`id_dokter`)
    INNER JOIN `simkesbaru`.`golongan_dokter` 
        ON (`master_dokter`.`gol_dokter` = `golongan_dokter`.`gol_dokter`)
    INNER JOIN `simkesbaru`.`kategori_dokter` 
        ON (`master_dokter`.`kat_dokter` = `kategori_dokter`.`kat_dokter`)
    LEFT JOIN `simkesbaru`.`master_buku_besar` 
        ON (`transaksi`.`id_transaksi` = `master_buku_besar`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`transaksi_diagnosa`
        ON (`transaksi`.`id_transaksi` = `transaksi_diagnosa`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`master_diagnosa`
        ON (`transaksi_diagnosa`.`id_diagnosa` = `master_diagnosa`.`id_diagnosa`)
)
UNION
(
SELECT
    `transaksi`.`id_transaksi`
    , `transaksi`.`tgl_transaksi`
    , `transaksi`.`tgl_kunjungan`
    , `master_karyawan`.`nip`
    , `master_karyawan`.`nama_karyawan`
    , `master_karyawan`.`ap`
    , `master_tertanggung`.`nama_tertanggung`
    , `master_tertanggung`.`status`
    , `transaksi_gigi`.`restitusi`
    , `master_tertanggung`.`ditanggung`
    , `master_item`.`nama_item`
    , `master_item`.`hba_item`
    ,  `item_transaksi_gigi`.`hrg_satuan`
    , `item_transaksi_gigi`.`jumlah`
    , (`item_transaksi_gigi`.`hrg_satuan` * `item_transaksi_gigi`.`jumlah`) AS total_harga
    , `item_transaksi_gigi`.`id_item`
    , `jenis_item`.`jenis_item`
    , `master_item`.`idjns_item`
    , `rayon_karyawan`.`id_rayon`
    , `wilayah_karyawan`.`id_wilayah`
    , `mitra_karyawan`.`id_mitra`
    , `master_dokter`.`nama_dokter`
    , NULL AS id_rujukan
    , `master_provider`.`nama_provider`
    , `master_buku_besar`.`buku_besar`
    , `master_diagnosa`.`nama_diagnosa`
FROM
    `simkesbaru`.`transaksi`
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
    INNER JOIN `simkesbaru`.`item_transaksi_gigi` 
        ON (`item_transaksi_gigi`.`id_transaksi` = `transaksi`.`id_transaksi`)
    INNER JOIN `simkesbaru`.`master_item` 
        ON (`item_transaksi_gigi`.`id_item` = `master_item`.`id_item`)
    INNER JOIN `simkesbaru`.`jenis_item` 
        ON (`master_item`.`idjns_item` = `jenis_item`.`idjns_item`)
    INNER JOIN `simkesbaru`.`master_rekomendasi` 
        ON (`item_transaksi_gigi`.`id_rekomendasi` = `master_rekomendasi`.`id_rekomendasi`)
    INNER JOIN `simkesbaru`.`transaksi_gigi` 
        ON (`transaksi_gigi`.`id_transaksi` = `transaksi`.`id_transaksi`)
    INNER JOIN `simkesbaru`.`master_dokter` 
        ON (`transaksi_gigi`.`id_dokter` = `master_dokter`.`id_dokter`)
    INNER JOIN `simkesbaru`.`golongan_dokter` 
        ON (`master_dokter`.`gol_dokter` = `golongan_dokter`.`gol_dokter`)
    INNER JOIN `simkesbaru`.`kategori_dokter` 
        ON (`master_dokter`.`kat_dokter` = `kategori_dokter`.`kat_dokter`)
    INNER JOIN `simkesbaru`.`master_provider`
	ON (`transaksi_gigi`.`id_provider` = `master_provider`.`id_provider`)
    LEFT JOIN `simkesbaru`.`master_buku_besar` 
        ON (`transaksi`.`id_transaksi` = `master_buku_besar`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`transaksi_diagnosa`
        ON (`transaksi`.`id_transaksi` = `transaksi_diagnosa`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`master_diagnosa`
        ON (`transaksi_diagnosa`.`id_diagnosa` = `master_diagnosa`.`id_diagnosa`)
)
UNION
(
SELECT
    `transaksi`.`id_transaksi`
    , `transaksi`.`tgl_transaksi`
    , `transaksi`.`tgl_kunjungan`
    , `master_karyawan`.`nip`
    , `master_karyawan`.`nama_karyawan`
    , `master_karyawan`.`ap`
    , `master_tertanggung`.`nama_tertanggung`
    , `master_tertanggung`.`status`
    , `transaksi_lab`.`restitusi`
    , `master_tertanggung`.`ditanggung`
    , `master_item`.`nama_item`
    , `master_item`.`hba_item`
    , NULL AS `hrg_satuan`
    , NULL AS `jumlah`
    , NULL AS total_harga
    , `item_transaksi_lab`.`id_item`
    , `jenis_item`.`jenis_item`
    , `master_item`.`idjns_item`
    , `rayon_karyawan`.`id_rayon`
    , `wilayah_karyawan`.`id_wilayah`
    , `mitra_karyawan`.`id_mitra`
    , `master_dokter`.`nama_dokter`
    , `transaksi_lab`.`id_rujukan`
    , `master_provider`.`nama_provider`
    , `master_buku_besar`.`buku_besar`
    , `master_diagnosa`.`nama_diagnosa`
FROM
    `simkesbaru`.`transaksi`
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
    INNER JOIN `simkesbaru`.`item_transaksi_lab` 
        ON (`item_transaksi_lab`.`id_transaksi` = `transaksi`.`id_transaksi`)
    INNER JOIN `simkesbaru`.`master_item` 
        ON (`item_transaksi_lab`.`id_item` = `master_item`.`id_item`)
    INNER JOIN `simkesbaru`.`jenis_item` 
        ON (`master_item`.`idjns_item` = `jenis_item`.`idjns_item`)
    INNER JOIN `simkesbaru`.`transaksi_lab` 
        ON (`transaksi_lab`.`id_transaksi` = `transaksi`.`id_transaksi`)
    INNER JOIN `simkesbaru`.`master_dokter` 
        ON (`transaksi_lab`.`id_dokter` = `master_dokter`.`id_dokter`)
    INNER JOIN `simkesbaru`.`golongan_dokter` 
        ON (`master_dokter`.`gol_dokter` = `golongan_dokter`.`gol_dokter`)
    INNER JOIN `simkesbaru`.`kategori_dokter` 
        ON (`master_dokter`.`kat_dokter` = `kategori_dokter`.`kat_dokter`)
    INNER JOIN `simkesbaru`.`master_provider`
	ON (`transaksi_lab`.`id_provider` = `master_provider`.`id_provider`)
    INNER JOIN `simkesbaru`.`master_rujukan`
	ON (`transaksi_lab`.`id_rujukan` = master_rujukan.`id_rujukan`)
    LEFT JOIN `simkesbaru`.`master_buku_besar` 
        ON (`transaksi`.`id_transaksi` = `master_buku_besar`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`transaksi_diagnosa`
        ON (`transaksi`.`id_transaksi` = `transaksi_diagnosa`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`master_diagnosa`
        ON (`transaksi_diagnosa`.`id_diagnosa` = `master_diagnosa`.`id_diagnosa`)
)
UNION
(
SELECT
    `transaksi`.`id_transaksi`
    , `transaksi`.`tgl_transaksi`
    , `transaksi`.`tgl_kunjungan`
    , `master_karyawan`.`nip`
    , `master_karyawan`.`nama_karyawan`
    , `master_karyawan`.`ap`
    , `master_tertanggung`.`nama_tertanggung`
    , `master_tertanggung`.`status`
    , `transaksi_lain`.`restitusi`
    , `master_tertanggung`.`ditanggung`
    , `master_item`.`nama_item`
    , `master_item`.`hba_item`
    ,  `item_transaksi_lain`.`hrg_satuan`
    , `item_transaksi_lain`.`jumlah`
    , (`item_transaksi_lain`.`hrg_satuan` * `item_transaksi_lain`.`jumlah`) AS total_harga
    , `item_transaksi_lain`.`id_item`
    , `jenis_item`.`jenis_item`
    , `master_item`.`idjns_item`
    , `rayon_karyawan`.`id_rayon`
    , `wilayah_karyawan`.`id_wilayah`
    , `mitra_karyawan`.`id_mitra`
    , `master_dokter`.`nama_dokter`
    , `transaksi_lain`.`id_rujukan`
    , `master_provider`.`nama_provider`
    , `master_buku_besar`.`buku_besar`
    , `master_diagnosa`.`nama_diagnosa`
FROM
    `simkesbaru`.`transaksi`
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
    INNER JOIN `simkesbaru`.`item_transaksi_lain` 
        ON (`item_transaksi_lain`.`id_transaksi` = `transaksi`.`id_transaksi`)
    INNER JOIN `simkesbaru`.`master_item` 
        ON (`item_transaksi_lain`.`id_item` = `master_item`.`id_item`)
    INNER JOIN `simkesbaru`.`jenis_item` 
        ON (`master_item`.`idjns_item` = `jenis_item`.`idjns_item`)
    INNER JOIN `simkesbaru`.`master_rekomendasi` 
        ON (`item_transaksi_lain`.`id_rekomendasi` = `master_rekomendasi`.`id_rekomendasi`)
    INNER JOIN `simkesbaru`.`transaksi_lain` 
        ON (`transaksi_lain`.`id_transaksi` = `transaksi`.`id_transaksi`)
    INNER JOIN `simkesbaru`.`master_dokter` 
        ON (`transaksi_lain`.`id_dokter` = `master_dokter`.`id_dokter`)
    INNER JOIN `simkesbaru`.`golongan_dokter` 
        ON (`master_dokter`.`gol_dokter` = `golongan_dokter`.`gol_dokter`)
    INNER JOIN `simkesbaru`.`kategori_dokter` 
        ON (`master_dokter`.`kat_dokter` = `kategori_dokter`.`kat_dokter`)
    INNER JOIN `simkesbaru`.`master_provider`
	ON (`transaksi_lain`.`id_provider` = `master_provider`.`id_provider`)
    INNER JOIN `simkesbaru`.`master_rujukan`
	ON (`transaksi_lain`.`id_rujukan` = master_rujukan.`id_rujukan`)
    LEFT JOIN `simkesbaru`.`master_buku_besar` 
        ON (`transaksi`.`id_transaksi` = `master_buku_besar`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`transaksi_diagnosa`
        ON (`transaksi`.`id_transaksi` = `transaksi_diagnosa`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`master_diagnosa`
        ON (`transaksi_diagnosa`.`id_diagnosa` = `master_diagnosa`.`id_diagnosa`)
)
UNION
(
SELECT
    `transaksi`.`id_transaksi`
    , `transaksi`.`tgl_transaksi`
    , `transaksi`.`tgl_kunjungan`
    , `master_karyawan`.`nip`
    , `master_karyawan`.`nama_karyawan`
    , `master_karyawan`.`ap`
    , `master_tertanggung`.`nama_tertanggung`
    , `master_tertanggung`.`status`
    , `transaksi_optik`.`restitusi`
    , `master_tertanggung`.`ditanggung`
    , `master_item`.`nama_item`
    , `master_item`.`hba_item`
    ,  `item_transaksi_optik`.`hrg_satuan`
    , `item_transaksi_optik`.`jumlah`
    , (`item_transaksi_optik`.`hrg_satuan` * `item_transaksi_optik`.`jumlah`) AS total_harga
    , `item_transaksi_optik`.`id_item`
    , `jenis_item`.`jenis_item`
    , `master_item`.`idjns_item`
    , `rayon_karyawan`.`id_rayon`
    , `wilayah_karyawan`.`id_wilayah`
    , `mitra_karyawan`.`id_mitra`
    , `master_dokter`.`nama_dokter`
    , NULL AS id_rujukan
    , `master_provider`.`nama_provider`
    , `master_buku_besar`.`buku_besar`
    , `master_diagnosa`.`nama_diagnosa`
FROM
    `simkesbaru`.`transaksi`
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
    INNER JOIN `simkesbaru`.`item_transaksi_optik` 
        ON (`item_transaksi_optik`.`id_transaksi` = `transaksi`.`id_transaksi`)
    INNER JOIN `simkesbaru`.`master_item` 
        ON (`item_transaksi_optik`.`id_item` = `master_item`.`id_item`)
    INNER JOIN `simkesbaru`.`jenis_item` 
        ON (`master_item`.`idjns_item` = `jenis_item`.`idjns_item`)
    INNER JOIN `simkesbaru`.`master_rekomendasi` 
        ON (`item_transaksi_optik`.`id_rekomendasi` = `master_rekomendasi`.`id_rekomendasi`)
    INNER JOIN `simkesbaru`.`transaksi_optik` 
        ON (`transaksi_optik`.`id_transaksi` = `transaksi`.`id_transaksi`)
    INNER JOIN `simkesbaru`.`master_dokter` 
        ON (`transaksi_optik`.`id_dokter` = `master_dokter`.`id_dokter`)
    INNER JOIN `simkesbaru`.`golongan_dokter` 
        ON (`master_dokter`.`gol_dokter` = `golongan_dokter`.`gol_dokter`)
    INNER JOIN `simkesbaru`.`kategori_dokter` 
        ON (`master_dokter`.`kat_dokter` = `kategori_dokter`.`kat_dokter`)
    INNER JOIN `simkesbaru`.`master_provider`
	ON (`transaksi_optik`.`id_provider` = `master_provider`.`id_provider`)
    LEFT JOIN `simkesbaru`.`master_buku_besar` 
        ON (`transaksi`.`id_transaksi` = `master_buku_besar`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`transaksi_diagnosa`
        ON (`transaksi`.`id_transaksi` = `transaksi_diagnosa`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`master_diagnosa`
        ON (`transaksi_diagnosa`.`id_diagnosa` = `master_diagnosa`.`id_diagnosa`)
)
UNION
(
SELECT
    `transaksi`.`id_transaksi`
    , `transaksi`.`tgl_transaksi`
    , `transaksi`.`tgl_kunjungan`
    , `master_karyawan`.`nip`
    , `master_karyawan`.`nama_karyawan`
    , `master_karyawan`.`ap`
    , `master_tertanggung`.`nama_tertanggung`
    , `master_tertanggung`.`status`
    , `transaksi_penunjang`.`restitusi`
    , `master_tertanggung`.`ditanggung`
    , `master_item`.`nama_item`
    , `master_item`.`hba_item`
    , `item_transaksi_penunjang`.`hrg_satuan`
    , `item_transaksi_penunjang`.`jumlah`
    , (`item_transaksi_penunjang`.`hrg_satuan` * `item_transaksi_penunjang`.`jumlah`) AS total_harga
    , `item_transaksi_penunjang`.`id_item`
    , `jenis_item`.`jenis_item`
    , `master_item`.`idjns_item`
    , `rayon_karyawan`.`id_rayon`
    , `wilayah_karyawan`.`id_wilayah`
    , `mitra_karyawan`.`id_mitra`
    , `master_dokter`.`nama_dokter`
    , `transaksi_penunjang`.`id_rujukan`
    , `master_provider`.`nama_provider`
    , `master_buku_besar`.`buku_besar`
    , `master_diagnosa`.`nama_diagnosa`
FROM
    `simkesbaru`.`transaksi`
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
    INNER JOIN `simkesbaru`.`item_transaksi_penunjang` 
        ON (`item_transaksi_penunjang`.`id_transaksi` = `transaksi`.`id_transaksi`)
    INNER JOIN `simkesbaru`.`master_item` 
        ON (`item_transaksi_penunjang`.`id_item` = `master_item`.`id_item`)
    INNER JOIN `simkesbaru`.`jenis_item` 
        ON (`master_item`.`idjns_item` = `jenis_item`.`idjns_item`)
    INNER JOIN `simkesbaru`.`master_rekomendasi` 
        ON (`item_transaksi_penunjang`.`id_rekomendasi` = `master_rekomendasi`.`id_rekomendasi`)
    INNER JOIN `simkesbaru`.`transaksi_penunjang` 
        ON (`transaksi_penunjang`.`id_transaksi` = `transaksi`.`id_transaksi`)
    INNER JOIN `simkesbaru`.`master_dokter` 
        ON (`transaksi_penunjang`.`id_dokter` = `master_dokter`.`id_dokter`)
    INNER JOIN `simkesbaru`.`golongan_dokter` 
        ON (`master_dokter`.`gol_dokter` = `golongan_dokter`.`gol_dokter`)
    INNER JOIN `simkesbaru`.`kategori_dokter` 
        ON (`master_dokter`.`kat_dokter` = `kategori_dokter`.`kat_dokter`)
    INNER JOIN `simkesbaru`.`master_provider`
	ON (`transaksi_penunjang`.`id_provider` = `master_provider`.`id_provider`)
    LEFT JOIN `simkesbaru`.`master_buku_besar` 
        ON (`transaksi`.`id_transaksi` = `master_buku_besar`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`transaksi_diagnosa`
        ON (`transaksi`.`id_transaksi` = `transaksi_diagnosa`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`master_diagnosa`
        ON (`transaksi_diagnosa`.`id_diagnosa` = `master_diagnosa`.`id_diagnosa`)
)
UNION
(
SELECT
    `transaksi`.`id_transaksi`
    , `transaksi`.`tgl_transaksi`
    , `transaksi`.`tgl_kunjungan`
    , `master_karyawan`.`nip`
    , `master_karyawan`.`nama_karyawan`
    , `master_karyawan`.`ap`
    , `master_tertanggung`.`nama_tertanggung`
    , `master_tertanggung`.`status`
    , `transaksi_rmh_sakit`.`restitusi`
    , `master_tertanggung`.`ditanggung`
    , `master_item`.`nama_item`
    , `master_item`.`hba_item`
    , `item_transaksi_rs`.`hrg_satuan`
    , `item_transaksi_rs`.`jumlah`
    , (`item_transaksi_rs`.`hrg_satuan` * `item_transaksi_rs`.`jumlah`) AS total_harga
    , `item_transaksi_rs`.`id_item`
    , `jenis_item`.`jenis_item`
    , `master_item`.`idjns_item`
    , `rayon_karyawan`.`id_rayon`
    , `wilayah_karyawan`.`id_wilayah`
    , `mitra_karyawan`.`id_mitra`
    , NULL AS `nama_dokter`
    , NULL AS id_rujukan
    , `master_provider`.`nama_provider`
    , `master_buku_besar`.`buku_besar`
    , `master_diagnosa`.`nama_diagnosa`
    
FROM
    `simkesbaru`.`transaksi`
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
    INNER JOIN `simkesbaru`.`item_transaksi_rs` 
        ON (`item_transaksi_rs`.`id_transaksi` = `transaksi`.`id_transaksi`)
    INNER JOIN `simkesbaru`.`master_item` 
        ON (`item_transaksi_rs`.`id_item` = `master_item`.`id_item`)
    INNER JOIN `simkesbaru`.`jenis_item` 
        ON (`master_item`.`idjns_item` = `jenis_item`.`idjns_item`)
    INNER JOIN `simkesbaru`.`master_rekomendasi` 
        ON (`item_transaksi_rs`.`id_rekomendasi` = `master_rekomendasi`.`id_rekomendasi`)
    INNER JOIN `simkesbaru`.`transaksi_rmh_sakit` 
        ON (`transaksi_rmh_sakit`.`id_transaksi` = `transaksi`.`id_transaksi`)
    INNER JOIN `simkesbaru`.`master_provider`
	ON (`transaksi_rmh_sakit`.`id_provider` = `master_provider`.`id_provider`)
    LEFT JOIN `simkesbaru`.`master_buku_besar` 
        ON (`transaksi`.`id_transaksi` = `master_buku_besar`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`transaksi_diagnosa`
        ON (`transaksi`.`id_transaksi` = `transaksi_diagnosa`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`master_diagnosa`
        ON (`transaksi_diagnosa`.`id_diagnosa` = `master_diagnosa`.`id_diagnosa`)
    WHERE `transaksi_rmh_sakit`.`idjenis_rawat` = 2
)
UNION
(
SELECT
    `transaksi`.`id_transaksi`
    , `transaksi`.`tgl_transaksi`
    , `transaksi`.`tgl_kunjungan`
    , `master_karyawan`.`nip`
    , `master_karyawan`.`nama_karyawan`
    , `master_karyawan`.`ap`
    , `master_tertanggung`.`nama_tertanggung`
    , `master_tertanggung`.`status`
    , NULL AS restitusi
    , `master_tertanggung`.`ditanggung`
    , NULL AS `nama_item`
    , NULL AS `hba_item`
    , NULL AS `hrg_satuan`
    , NULL AS `jumlah`
    , NULL AS total_harga
    , NULL AS `id_item`
    , NULL AS `jenis_item`
    , NULL AS `idjns_item`
    , `rayon_karyawan`.`id_rayon`
    , `wilayah_karyawan`.`id_wilayah`
    , `mitra_karyawan`.`id_mitra`
    , `master_dokter`.`nama_dokter`
    , NULL AS id_rujukan
    , `master_provider`.`nama_provider`
    , `master_buku_besar`.`buku_besar`
    , `master_diagnosa`.`nama_diagnosa`
FROM
    `simkesbaru`.`transaksi`
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
    INNER JOIN `simkesbaru`.`transaksi_kunjungan_rs` 
        ON (`transaksi_kunjungan_rs`.`id_transaksi` = `transaksi`.`id_transaksi`)
    INNER JOIN `simkesbaru`.`master_provider` 
        ON (`transaksi_kunjungan_rs`.`id_provider` = `master_provider`.`id_provider`)
    INNER JOIN `simkesbaru`.`periksa_kunjungan_rs` 
        ON (`periksa_kunjungan_rs`.`id_transaksi` = `transaksi`.`id_transaksi`)
    INNER JOIN `simkesbaru`.`master_dokter` 
        ON (`periksa_kunjungan_rs`.`id_dokter` = `master_dokter`.`id_dokter`)
    LEFT JOIN `simkesbaru`.`master_buku_besar` 
        ON (`transaksi`.`id_transaksi` = `master_buku_besar`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`transaksi_diagnosa`
        ON (`transaksi`.`id_transaksi` = `transaksi_diagnosa`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`master_diagnosa`
        ON (`transaksi_diagnosa`.`id_diagnosa` = `master_diagnosa`.`id_diagnosa`)
)
UNION
(
SELECT
    `transaksi`.`id_transaksi`
    , `transaksi`.`tgl_transaksi`
    , `transaksi`.`tgl_kunjungan`
    , `master_karyawan`.`nip`
    , `master_karyawan`.`nama_karyawan`
    , `master_karyawan`.`ap`
    , `master_tertanggung`.`nama_tertanggung`
    , `master_tertanggung`.`status`
    , NULL AS restitusi
    , `master_tertanggung`.`ditanggung`
    , NULL AS `nama_item`
    , NULL AS `hba_item`
    , NULL AS `hrg_satuan`
    , NULL AS `jumlah`
    , NULL AS total_harga
    , NULL AS `id_item`
    , NULL AS `jenis_item`
    , NULL AS `idjns_item`
    , `rayon_karyawan`.`id_rayon`
    , `wilayah_karyawan`.`id_wilayah`
    , `mitra_karyawan`.`id_mitra`
    , NULL AS `nama_dokter`
    , NULL AS id_rujukan
    , `master_provider`.`nama_provider`
    , `master_buku_besar`.`buku_besar`
    , `master_diagnosa`.`nama_diagnosa`
FROM
    `simkesbaru`.`transaksi`
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
    INNER JOIN `simkesbaru`.`transaksi_rekam_medis` 
        ON (`transaksi_rekam_medis`.`id_transaksi` = `transaksi`.`id_transaksi`)
    INNER JOIN `simkesbaru`.`periksa_rekam_medis` 
        ON (`periksa_rekam_medis`.`id_transaksi` = `transaksi`.`id_transaksi`)
    INNER JOIN `simkesbaru`.`master_provider`
	ON (`transaksi_rekam_medis`.`id_provider` = `master_provider`.`id_provider`)
    LEFT JOIN `simkesbaru`.`master_buku_besar` 
        ON (`transaksi`.`id_transaksi` = `master_buku_besar`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`transaksi_diagnosa`
        ON (`transaksi`.`id_transaksi` = `transaksi_diagnosa`.`id_transaksi`)
    LEFT JOIN `simkesbaru`.`master_diagnosa`
        ON (`transaksi_diagnosa`.`id_diagnosa` = `master_diagnosa`.`id_diagnosa`)
)
ORDER BY id_transaksi DESC

;