<?php

class Querypage extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
    }
    function insert_chapter($dataarray)
    {
        for($i=1;$i<count($dataarray);$i++){
            $data = array(
                'chapternumber'=>$dataarray[$i]['chapternumber'],
                'title'=>$dataarray[$i]['title'],
                'text1'=>$dataarray[$i]['text1'],
                'text2'=>$dataarray[$i]['text2']
                //'dateinserted' => date('Y-m-d H:i:s', now())
            );
            $this->db->insert('content', $data);
        }
	}
	
	function update_chapter($dataarray)
      {
        for($i=1;$i<count($dataarray);$i++){
            $data = array(
                'chapternumber'=>$dataarray[$i]['chapternumber'],
                'title'=>$dataarray[$i]['title'],
                'text1'=>$dataarray[$i]['text1'],
                'text2'=>$dataarray[$i]['text2'],
                //'dateupdated' => date('Y-m-d H:i:s', now())
            );
            $param = array(
               'chapternumber'=>$dataarray[$i]['chapternumber']
            );
            $this->db->where($param);
           return $this->db->update('content',$data);   
        }
 }
  function search_chapter($dataarray)
  {
        for($i=1;$i<count($dataarray);$i++)
		{
            $search = array(
                'chapternumber'=>$dataarray[$i]['chapternumber']
            );
		}
		
  $data = array();
  $this->db->where($search);
  $this->db->limit(1);
  $Q = $this->db->get('content');
  if($Q->num_rows() > 0)
  {
  $data = $Q->row_array();
  }
  $Q->free_result();
  return $data;
 }
 }
?>