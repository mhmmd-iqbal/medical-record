<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_cetak extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('mymodel');
		$level = $this->session->userdata('level');
	
	}

	function cetak($id_perawatan=null){
		$from 	= 'tb_perawatan';
		$table 	= array('tb_pasien', 'tb_dokter', 'tb_spesialisasi','tb_poliklinik');
		$join 	= array(
			'tb_perawatan.kode_pasien 	= tb_pasien.kode_pasien',
			'tb_perawatan.kode_dokter 	= tb_dokter.kode_dokter',
			'tb_dokter.id_spesialisasi 	= tb_spesialisasi.id_spesialisasi',
			'tb_dokter.id_klinik 		= tb_poliklinik.id_klinik',
		);
		$where 		= array('id_perawatan' => $id_perawatan);
		$perawatan 	= $this->mymodel->join($from, $table, $join, $where)->result_array();
		foreach ($perawatan as $key 	=> $value) {
			$data['perawatan'] 		= array(
				'kode_pasien' 	=> $value['kode_pasien'],
				'nama_pasien'	=> $value['nama_pasien'],
				'jk'			=> ($value['jnsklmn_pasien']=='L'?'Laki - laki':'Perempuan'),
				'pekerjaan'		=> $value['pekerjaan'],
				'status'		=> $value['status_perkawinan'],
				'alamat'		=> $value['alamat_pasien'],
				'ttl'			=> $value['tmp_lahir'].', '.date('d-m-Y', strtotime($value['tgl_lahir'])),
				'usia'			=> date('Y') - date('Y', strtotime($value['tgl_lahir'])),
				'kode_dokter'	=> $value['kode_dokter'],
				'nama_dokter'	=> $value['nama_dokter'],
				'spesialisasi'	=> $value['spesialisasi'],
				'klinik'		=> $value['nama_klinik'],
				'diagnosa'		=> $value['diagnosa_utama'],
				'cara_masuk'	=> $value['cara_masuk'],
				'cara_keluar'	=> $value['cara_keluar'],
				'keadaan'		=> $value['keadaan_keluar'],
				'status_perawatan'=> ($value['status_perawatan']=='inap'?'Rawat Inap':'Rawat Jalan'),
				'pj'			=> $value['pj'],
				'hp'			=> $value['hp_pj'],
				'total_biaya'	=> $value['total_biaya'],
			);
			$where1 = array('id_perawatan' => $value['id_perawatan']);
			$harian = $this->mymodel->getData('tb_perawatan_harian', $where1)->result_array();

			// MENCARI TANGGAL MULAI DAN TANGGAL AKHIR DAN MEMBUAT SELISIH 
			$hari_1	= $this->mymodel->getData('tb_perawatan_harian', $where1, 'id_harian', 'ASC')->row_array();
			$hari_2	= $this->mymodel->getData('tb_perawatan_harian', $where1, 'id_harian', 'DESC')->row_array();
			$h_mulai= date_create(date('Y-m-d', strtotime($hari_1['tanggal'])));
			$h_akhir= date_create(date('Y-m-d', strtotime($hari_2['tanggal'])));
			$selisih= date_diff($h_mulai, $h_akhir);
			// END MENCARI TANGGAL MULAI DAN TANGGAL AKHIR DAN MEMBUAT SELISIH
			foreach ($harian as $key1 => $value1) {
				$data['perawatan']['harian'][$key1] = array(
					'tanggal'	=> $value1['tanggal'],
					'kondisi'	=> $value1['kondisi'],
				);
				$table2 = array('tb_obat');
				$join2  = array('tb_obat.id_obat = tb_list_obat.id_obat');
				$where2 = array('id_harian' => $value1['id_harian']);
				$obat   = $this->mymodel->join('tb_list_obat', $table2, $join2, $where2)->result_array();
				foreach ($obat as $key2 => $value2) {
					$data['perawatan']['harian'][$key1]['obat'][$key2] = array(
						'obat'	=> ($value2['nama_obat'] != null)?$value2['nama_obat']:'',
						'ket'	=> $value2['keterangan_obat'],
					);
				}
				// $lama_perawatan++;
			}
			$data['perawatan']['lama_perawatan'] = (($selisih->days)+1)." hari";
		}


		$this->load->library('pdf');
		$this->pdf->setPaper('A4', 'landscape');
		$this->pdf->filename = "Data Rekam Medik.pdf";
		$this->pdf->load_view('report/rekam_medik', $data);
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		// $this->load->view('report/rekam_medik', $data);
	}
}
?>