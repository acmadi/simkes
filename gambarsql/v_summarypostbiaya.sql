
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_summarypostbiaya` 
    AS
SELECT
id_rayon
,id_wilayah
,id_mitra
,jenis_penyakit 
,SUM(karyawan)AS karyawan 
,SUM(keluarga_karyawan) AS `keluarga_karyawan`
,SUM(pensinunan) AS `pensinunan`
,SUM(`keluarga_pensiunan`) AS `keluarga_pensiunan`
FROM `v_summarypostbiayarayon` ;
