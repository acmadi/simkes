
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `simkesbaru`.`v_summarypostbiayarayon` 
    AS

SELECT DISTINCT
tgl_transaksi,
tgl_kunjungan,
id_rayon
,id_wilayah
,id_mitra
,jenis_penyakit
, COALESCE( (SELECT SUM(t.`total_transaksi`) FROM v_summarypostbiayaall t 
   WHERE t.`id_rayon`= s.id_rayon AND t.`jenis_penyakit` = s.jenis_penyakit  AND t.`ap` = 'a' AND t.status='ybs'  GROUP BY t.jenis_penyakit, t.ap, t.`status`
   ),0) AS karyawan
, COALESCE((	SELECT  SUM(t.`total_transaksi`) FROM v_summarypostbiayaall t 	
	WHERE t.id_rayon=s.`id_rayon` AND t.`jenis_penyakit`=s.`jenis_penyakit` AND t.`ap` = 'a'  AND (t.`status`='anak' OR t.`status`='istri')  
	GROUP BY t.jenis_penyakit, t.ap),0)AS keluarga_karyawan
, COALESCE((SELECT SUM(t.`total_transaksi`) FROM v_summarypostbiayaall t WHERE t.`id_rayon`= s.id_rayon AND t.`jenis_penyakit` = s.jenis_penyakit AND t.ap = s.`ap` AND t.`ap` = 'p'  AND t.status = 'ybs'  GROUP BY t.jenis_penyakit, t.ap, t.`status`
   ),0) AS pensinunan
, COALESCE((	SELECT  SUM(t.`total_transaksi`) FROM v_summarypostbiayaall t 	
	WHERE  t.`id_rayon`= s.id_rayon AND t.`jenis_penyakit`=s.`jenis_penyakit` AND t.`ap` = 'p'  AND (t.`status`='anak' OR t.`status`='istri')  
	GROUP BY t.jenis_penyakit, t.ap),0) AS keluarga_pensiunan 
FROM v_summarypostbiayaall s
-- group by id_rayon,jenis_penyakit
-- WHERE id_rayon = 1 
 GROUP BY s.tgl_transaksi,id_rayon,jenis_penyakit, ap, s.`status`
 
