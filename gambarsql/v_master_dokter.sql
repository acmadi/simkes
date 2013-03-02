
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_master_dokter` 
    AS
(SELECT 
  mdo.`id_dokter`,
  mdo.`nama_dokter`,
  IF(mdo.`langg_dokter` = 'y','Berlangganan','Tidak') AS langg_dokter,
  mdo.`tarif_dokter`,
  mdo.`tarif_standar`,
  gd.`gol_nama`,
  kd.`kat_nama`
FROM `master_dokter` mdo
JOIN `kategori_dokter` kd ON kd.`kat_dokter` = mdo.`kat_dokter`
JOIN `golongan_dokter` gd ON gd.`gol_dokter` = mdo.`gol_dokter`);
