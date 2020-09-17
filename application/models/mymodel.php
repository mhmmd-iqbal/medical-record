<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mymodel extends CI_Model{
	public function getData($table, $where =null, $bycolumn=null, $order=null)
	{
		if ((!is_null($bycolumn))AND(!is_null($order))) {
			$this->db->order_by($bycolumn, $order);
		}
		if(!is_null($where)){
			$this->db->where($where);
		}
		return $this->db->get($table);
	}
	public function actionData($act, $data=null, $table, $where=null){
		if(!is_null($where)){
			$this->db->where($where);
		}
		switch ($act) {
			case 'input'	: $this->db->insert($table,$data); break;
			case 'update'	: $this->db->update($table,$data); break;
			case 'delete'	: $this->db->delete($table); break;			
			default: break;
		}
	}
	public function join($from, &$table, &$join, $where=null){
		$i = 0;
		foreach ($table as $data ) {
			$tabel = $table[$i];
			$relasi = $join[$i];			
			$this->db->join($tabel, $relasi);
		$i++;
		}
		if (!is_null($where)) {
			$this->db->where($where);
		}
		return $this->db->get($from);
	}
		
	public function joinwhere($from, $where, &$table, &$join){
		$i = 0;
		foreach ($table as $data ) {
			$tabel = $table[$i];
			$relasi = $join[$i];			
			$this->db->join($tabel, $relasi);
		$i++;
		}
		return $this->db->get_where($from,$where);
	}

	public function joinwhereorder($from,  &$table, &$join,$where, $bycolumn, $order){
		$i = 0;
		foreach ($table as $data ) {
			$tabel = $table[$i];
			$relasi = $join[$i];			
			$this->db->join($tabel, $relasi);
		$i++;
		}
		$this->db->order_by($bycolumn, $order);
		return $this->db->get_where($from,$where);
	}
}
?>