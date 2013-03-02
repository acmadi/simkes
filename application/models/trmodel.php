<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
Class Trmodel extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function get_latest_transaksi($limit = 5)
	{
		$this->db->from('transaksi');
		$this->db->where('user',from_session('user_id'));
		$this->db->group_by('nomor');
		$this->db->order_by('nomor','desc');
		$this->db->limit($limit);
		return $this->db->get();
	}
	function get_surdef($intv1,$intv2)
	{
		$this->db->query(
			'
			DROP TEMPORARY TABLE IF EXISTS '.$this->db->dbprefix.'trans
			'
		);
		$this->db->query(
			'
			CREATE TEMPORARY TABLE IF NOT EXISTS '.$this->db->dbprefix.'trans
			(
				SELECT transaksi,debet,kredit,tanggal_transaksi
				FROM '.$this->db->dbprefix.'transaksi
				WHERE user="'.from_session('user_id').'"
				AND tanggal_transaksi BETWEEN "'.$intv1.'" AND "'.$intv2.'"
				GROUP BY nomor
			)
			'
		);
		$this->db->select('
			SUM(IF(b.jenis=1,IF(a.debet=0,a.kredit,a.debet),0)) as pemasukan,
			SUM(IF(b.jenis=2,IF(a.debet=0,a.kredit,a.debet),0)) as pengeluaran
		',false);
		$this->db->from('trans a');
		$this->db->join('jenis_transaksi b','a.transaksi=b.id','left');
		return $this->db->get();
	}
	function get_chart()
	{
		$intv1 = date('Y').'-01-01';
		$intv2 = date('Y-m-d');
		$this->db->query(
			'
			DROP TEMPORARY TABLE IF EXISTS '.$this->db->dbprefix.'trans2
			'
		);
		$this->db->query(
			'
			CREATE TEMPORARY TABLE IF NOT EXISTS '.$this->db->dbprefix.'trans2
			(
				SELECT transaksi,debet,kredit,tanggal_transaksi,MONTH(tanggal_transaksi) as bulan
				FROM '.$this->db->dbprefix.'transaksi
				WHERE user="'.from_session('user_id').'"
				AND tanggal_transaksi BETWEEN "'.$intv1.'" AND "'.$intv2.'"
				GROUP BY nomor
			)
			'
		);
		$this->db->select('
			bulan,
			SUM(IF(b.jenis=1,IF(a.debet=0,a.kredit,a.debet),0)) as pemasukan,
			SUM(IF(b.jenis=2,IF(a.debet=0,a.kredit,a.debet),0)) as pengeluaran
		',false);
		$this->db->from('trans2 a');
		$this->db->join('jenis_transaksi b','a.transaksi=b.id','left');
		$this->db->group_by('bulan');
		$this->db->order_by('bulan');
		$res = $this->db->get();
		foreach($res->result() as $row)
		{
			$s1[] = $row->pemasukan;
			$s2[] = $row->pengeluaran;
			$s3[] = $row->pemasukan - $row->pengeluaran;
			$axis[] = "'".$this->fungsi->bulan($row->bulan)."'";
		}
		if($res->num_rows()==0)
		{
			$data['s1'] = "";
			$data['s2'] = "";
			$data['s3'] = "";
			$data['axis'] = "";
			return $data;
		}
		$data['s1'] = "[".implode(",",$s1)."]";
		$data['s2'] = "[".implode(",",$s2)."]";
		$data['s3'] = "[".implode(",",$s3)."]";
		$data['axis'] = "[".implode(",",$axis)."]";
		
		return $data;
	}
	function get_list_piutang()
	{
		$this->db->select('a.*,b.*,IF(debet=0,kredit,debet) as nominal',false);
		$this->db->from('transaksi a');
		$this->db->join('(SELECT IF(debet=0,kredit,debet) as telahbayar,id_piutang FROM '.$this->db->dbprefix.'transaksi) b','a.nomor=b.id_piutang','left');
		$this->db->where_in('a.transaksi',array(8,14,13));
		$this->db->where('a.user',from_session('user_id'));
		$this->db->where('(IF(debet=0,kredit,debet)-IF(isnull(telahbayar)=1,0,telahbayar))!=0','',false);
		$this->db->group_by('a.nomor');
		return $this->db->get();
	}
	function get_list_piutang2()
	{
		$this->db->select('nomor,keterangan,user,transaksi');
		$this->db->from('transaksi a');
		$this->db->where_in('transaksi',array(8,14,13));
		$this->db->where('user',from_session('user_id'));
		$this->db->group_by('nomor');
		$this->db->order_by('id','desc');
		return $this->db->get();
	}
	function get_telah_bayar_piutang($nomor)
	{
		$this->db->select('IF(debet=0,kredit,debet) as telahbayar',false);
		$this->db->from('transaksi');
		$this->db->where_in('transaksi',array(9));
		$this->db->where('user',from_session('user_id'));
		$this->db->where('id_piutang',$nomor);
		$this->db->group_by('nomor');
		$res = $this->db->get();
		if($res->num_rows() == 0) return 0;
		$row = $res->row();
		return $row->telahbayar;
	}
	function get_jenis_transaksi()
	{
		$this->db->from('jenis_transaksi');
		return $this->db->get();
	}
	function get_preferences($transaksi)
	{
		$this->db->from('jenis_transaksi');
		$this->db->where('id',$transaksi);
		$res = $this->db->get();
		$row = $res->row();
		$debet = $row->buku_debet;
		$kredit = $row->buku_kredit;
		$debet = explode('+',$debet);
		$kredit = explode('+',$kredit);
		$debet = remove_empty_values($debet);
		$kredit = remove_empty_values($kredit);
		return array('debet'=>$debet,'kredit'=>$kredit);
	}
	function get_nomor()
	{
		$this->db->select('MAX(nomor) as nomor');
		$this->db->from('transaksi');
		$this->db->where('user',from_session('user_id'));
		$res = $this->db->get();
		if($res->num_rows()==0) return 0;
		$row = $res->row();
		return ($row->nomor+1);
	}
	function is_exists($nomor,$buku)
	{
		$this->db->from('transaksi');
		$this->db->where('user',from_session('user_id'));
		$this->db->where('nomor',$nomor);
		$this->db->where('buku',$buku);
		$res = $this->db->count_all_results();
		if($res>0)
		{
			return true;
		}
		return false;
	}
	function simpan_transaksi($data,$nomor)
	{
		if($nomor=='')
		{
			$nomor = $this->get_nomor();
			$data['nomor'] = $nomor;
			$this->db->insert('transaksi',$data);
		}
		else
		{
			$data['nomor'] = $nomor;
			$exists = $this->is_exists($nomor,$data['buku']);
			if($exists)
			{
				$this->db->where('nomor',$nomor);
				$this->db->where('buku',$data['buku']);
				$this->db->where('user',from_session('user_id'));
				$this->db->update('transaksi',$data);
			}
			else
			{
				$this->db->insert('transaksi',$data);
			}			
		}
		return $nomor;
	}
	function get_transaksi($transaksi,$bulan,$tahun,$page,$num=false)
	{
		$perpage = 5;
		$this->db->from('transaksi');
		$this->db->where('user',from_session('user_id'));
		$this->db->where('transaksi',$transaksi);
		$this->db->where('DATE_FORMAT(tanggal_transaksi,"%Y-%m")="'.$tahun.'-'.$bulan.'"','',false);
		$this->db->group_by('nomor');
		if($num)
		{
			$r = $this->db->get();
			$n = $r->num_rows();
			return ceil($n/$perpage);
		}
		$this->db->order_by('nomor','desc');
		$this->db->limit($perpage,$page*$perpage);
		return $this->db->get();
	}
	function get_buku()
	{
		$this->db->order_by('id');
		return $this->db->get('buku');
	}
	function get_detail_buku($buku,$bulan,$tahun)
	{
		$this->db->from('transaksi');
		$this->db->where('user',from_session('user_id'));
		$this->db->where('buku',$buku);
		$this->db->where('DATE_FORMAT(tanggal_transaksi,"%Y-%m")="'.$tahun.'-'.$bulan.'"','',false);
		$this->db->order_by('tanggal_transaksi,id,debet desc');
		return $this->db->get();
	}
	function get_saldo($buku,$bulan,$tahun,$detail=false)
	{
		$awal = 0;
		$this->db->select('SUM(IF(DATE_FORMAT(tanggal_transaksi,"%Y-%m")="'.$tahun.'-'.$bulan.'",debet,0)) as debet,SUM(IF(DATE_FORMAT(tanggal_transaksi,"%Y-%m")="'.$tahun.'-'.$bulan.'",kredit,0)) as kredit,(SUM(IF(DATE_FORMAT(tanggal_transaksi,"%Y-%m")<"'.$tahun.'-'.$bulan.'",debet,0))-SUM(IF(DATE_FORMAT(tanggal_transaksi,"%Y-%m")<"'.$tahun.'-'.$bulan.'",kredit,0))) as saldo',false);
		$this->db->from('transaksi');
		$this->db->where('user',from_session('user_id'));
		$this->db->where('buku',$buku);
		//$this->db->where('','',false);
		$res =  $this->db->get();
		if($res->num_rows()>0)
		{
			$row = $res->row();
			if($detail)
				return array($row->saldo,$row->debet,$row->kredit);
			return ($awal + $row->saldo);
		}
		else
		{
			if($detail)
				return array($awal,0,0);
			return $awal;
		}
	}
	function get_saldo_pertanggal($buku,$tanggal)
	{
		$awal = 0;
		$this->db->select('(SUM(debet)-SUM(kredit)) as saldo');
		$this->db->from('transaksi');
		$this->db->where('user',from_session('user_id'));
		$this->db->where('buku',$buku);
		$this->db->where('tanggal_transaksi<="'.$tanggal.'"','',false);
		$res =  $this->db->get();
		if($res->num_rows()>0)
		{
			$row = $res->row();
			return ($awal + $row->saldo);
		}
		else
		{
			return $awal;
		}
	}
	function get_saldo_akhir($awal,$debet,$kredit,$sign)
	{
		if($sign==1) //  default debet
		{
			$akhir = $awal + $debet - $kredit;
		}
		else // default kredit
		{
			$akhir = $awal - $debet + $kredit;
		}
		return $akhir;
	}
	function get_setup()
	{
		$this->db->order_by('id');
		return $this->db->get('jenis_transaksi');
	}
	function simpan_setup($data)
	{
		// new entry
		if(array_key_exists('buku_debet_new',$data) or array_key_exists('buku_kredit_new',$data))
		{
			if(array_key_exists('buku_debet_new',$data))
			{
				$debet = $data['buku_debet_new'];
			}
			else
			{
				$debet = array();
			}			
			if(array_key_exists('buku_kredit_new',$data))
			{
				$kredit = $data['buku_kredit_new'];
			}
			else
			{
				$kredit = array();
			}
			if(count($debet) > 0 or count($kredit) > 0)
			{
				foreach($debet as $id=>$dt)
				{
					$save[$id] = array('buku_debet'=>'+'.implode('+',$dt).'+');
				}
				foreach($kredit as $id=>$dt)
				{
					$save[$id]['buku_kredit'] = '+'.implode('+',$dt).'+';
				}
				foreach($save as $id=>$s)
				{
					$save[$id]['nama'] = $data['nama_new'][$id];
					if(!array_key_exists('buku_kredit',$save[$id])) $save[$id]['buku_kredit'] = '';
					if(!array_key_exists('buku_debet',$save[$id])) $save[$id]['buku_debet'] = '';
				}
				foreach($save as $id=>$s)
				{
					$this->db->insert('jenis_transaksi',$s);
				}
			}
		}
		// update entry
		if(array_key_exists('buku_debet',$data) or array_key_exists('buku_kredit',$data))
		{
			if(array_key_exists('buku_debet',$data))
			{
				$debet = $data['buku_debet'];
			}
			else
			{
				$debet = array();
			}			
			if(array_key_exists('buku_kredit',$data))
			{
				$kredit = $data['buku_kredit'];
			}
			else
			{
				$kredit = array();
			}
			if(count($debet) > 0 or count($kredit) > 0)
			{
				$save = array();
				foreach($debet as $id=>$dt)
				{
					$save[$id] = array('id'=>$id,'buku_debet'=>'+'.implode('+',$dt).'+');
				}
				foreach($kredit as $id=>$dt)
				{
					$save[$id]['buku_kredit'] = '+'.implode('+',$dt).'+';
				}
				foreach($save as $id=>$s)
				{
					$save[$id]['nama'] = $data['nama'][$id];
					$save[$id]['jenis'] = $data['jenis'][$id];
					if(!array_key_exists('buku_kredit',$save[$id])) $save[$id]['buku_kredit'] = '';
					if(!array_key_exists('buku_debet',$save[$id])) $save[$id]['buku_debet'] = '';
				}
				foreach($save as $id=>$s)
				{
					$this->db->where('id',$id);
					$this->db->update('jenis_transaksi',$s);
				}
			}
		}
	}
	function hapus_setup($id)
	{
		$this->db->from('transaksi');
		$this->db->where('transaksi',$id);
		$num = $this->db->count_all_results();
		if($num == 0)
		{
			$this->db->where('id',$id);
			$this->db->delete('jenis_transaksi');
		}
	}
	function simpan_buku($data)
	{
		if($data['nama_new'] != '')
		{
			$this->db->insert('buku',array('nama'=>$data['nama_new']));
		}
		if(array_key_exists('nama',$data))
		{
			foreach($data['nama'] as $key=>$val)
			{
				$this->db->where('id',$key);
				$this->db->update('buku',array('nama'=>$val));
			}
		}
	}
	function hapus_buku($id)
	{
		$this->db->from('transaksi');
		$this->db->where('buku',$id);
		$num = $this->db->count_all_results();
		if($num == 0)
		{
			$this->db->where('id',$id);
			$this->db->delete('buku');
		}
	}
}
