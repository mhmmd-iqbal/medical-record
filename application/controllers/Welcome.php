<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('mymodel');
		$level = $this->session->userdata('level');
	
	}

	function time(){
		$awal 		= date_create(date('Y-m-d'));
		$akhir 		= date_create('2019-07-29');
		$selisih 	= date_diff($awal, $akhir);
		echo "<pre>";
		print_r($selisih);
		echo "</pre>";
		echo $selisih->days;
	}
	public function index()
	{
		$this->load->view('login');	
	}
	function logout(){
		$this->session->sess_destroy();
		redirect('Welcome/');
	}
	function login(){
		$id 		= $this->input->post('username');
		$pass 		= md5($this->input->post('password'));

		$where1		= array('username' 		=> $id,
							'password' 		=> $pass);
		$cekadmin	= $this->mymodel->getData('tb_admin',$where1)->num_rows();
		
		$where2 		= array('kode_dokter'	=> $id,
							'password' 		=> $pass);
		$cekdokter	= $this->mymodel->getData('tb_dokter',$where2)->num_rows();

		if (($cekdokter > 0)&&($cekadmin == 0)) {
			$getDokter	= $this->mymodel->getData('tb_dokter',$where2)->row_array();
			$data 		= array(
				'id'	=> $id,
				'level'	=> 'dokter',
				'nama'	=> $getDokter['nama_dokter'] 
			);
			$this->session->set_userdata($data);
			redirect('Welcome/home');
		}
		elseif (($cekadmin > 0)&&($cekdokter == 0)) {
			$getAdmin	= $this->mymodel->getData('tb_admin',$where1)->row_array();
			$data 		= array(
				'id'	=> $id,
				'level'	=> 'admin',
				'nama'	=> $getAdmin['nama'] 
			);
			$this->session->set_userdata($data);
			redirect('Welcome/home');
		}
		else{
			echo "belum buat";
		}
	}

	function home(){
		$data 		= array(
				'id'	=> $this->session->userdata('id'),
				'level'	=> $this->session->userdata('level'),
				'nama'	=> $this->session->userdata('nama') 
			);
		$this->load->view('index', $data);
	}

	function crud($aksi=null, $table=null, $id=null){
		$level_user	= $this->session->userdata('level');
		if (isset($level_user)) {
			$data['level_user']	= $this->session->userdata('level');
		}
		switch ($aksi) {
			case 'view_all':
				switch ($table) {
					case 'obat':
						$data['obat']		= $this->mymodel->getData('tb_obat')->result_array();
						$data['sukses']		= $this->session->flashdata('sukses');
						$data['error']		= $this->session->flashdata('error');
						$this->load->view('data/obat',$data);
					break;					
					case 'perawatan':
						$data['obat'] 	= $this->mymodel->getData('tb_obat')->result_array();
						$data['sukses']		= $this->session->flashdata('sukses');
						$data['error']		= $this->session->flashdata('error');
						$this->load->view('data/perawatan', $data);
					break;
					case 'spesialis':
						$main_data			= $this->mymodel->getData('tb_spesialisasi')->result_array();
						foreach ($main_data as $key => $value) {
							$where 			= array('id_spesialisasi' => $value['id_spesialisasi']);
							$jumlah_dokter 	= $this->mymodel->getData('tb_dokter', $where)->num_rows();
							
							$data['spesialis'][$key] = array(
								'id_spesialisasi'	 => $value['id_spesialisasi'],
								'spesialisasi'		 => $value['spesialisasi'],
								'jumlah'			 => $jumlah_dokter,	);
						}
						
						$data['sukses']		= $this->session->flashdata('sukses');
						$data['error']		= $this->session->flashdata('error');
						$this->load->view('data/spesialis', $data);
					break;
					case 'dokter':
						$table 				= array('tb_spesialisasi','tb_poliklinik');
						$join 				= array(
								'tb_spesialisasi.id_spesialisasi = tb_dokter.id_spesialisasi',
								'tb_poliklinik.id_klinik = tb_dokter.id_klinik'
							);
						$data['dokter']		= $this->mymodel->join('tb_dokter', $table, $join)->result_array();
						$data['spesialis']	= $this->mymodel->getData('tb_spesialisasi')->result_array();
						$data['poliklinik']	= $this->mymodel->getData('tb_poliklinik')->result_array();
						$data['sukses']		= $this->session->flashdata('sukses');
						$data['error']		= $this->session->flashdata('error');
						$this->load->view('data/dokter', $data);
					break;

					case 'poliklinik':
						$poliklinik 		= $this->mymodel->getData('tb_poliklinik')->result_array();
						foreach ($poliklinik as $key => $value) {
							$where 			= array('id_klinik' => $value['id_klinik']);
							$jumlah_dokter 	= $this->mymodel->getData('tb_dokter', $where)->num_rows();

							$data['poliklinik'][$key]	= array(
								'id_klinik'				=> $value['id_klinik'],
								'nama_klinik'			=> $value['nama_klinik'],
								'jumlah'				=> $jumlah_dokter,
							);
						}
						
						$data['sukses']		= $this->session->flashdata('sukses');
						$data['error']		= $this->session->flashdata('error');
						$this->load->view('data/poliklinik', $data);
					break;
					
					case 'pasien':
						$pasien		= $this->mymodel->getData('tb_pasien')->result_array();
						foreach ($pasien as $key => $value) {
							$where 			= array(
								'kode_pasien'		=> $value['kode_pasien'],
								'keadaan_perawatan'	=> 'dalam perawatan',
							);
							$cek  			= $this->mymodel->getData('tb_perawatan', $where)->num_rows();
							$data['pasien'][$key] = array(
								'kode_pasien'	=> $value['kode_pasien'],
								'nik_pasien'	=> $value['nik_pasien'],
								'nama_pasien'	=> $value['nama_pasien'],
								'stat_perawatan'=> ($cek>0? 'sedang dirawat' : 'tidak sedang dirawat'),
								'label_color'	=> ($cek>0? 'danger' : 'success'),
								'jns_klmn' 		=> $value['jnsklmn_pasien'],
								'pekerjaan'		=> $value['pekerjaan'],
								'stat_nikah'	=> $value['status_perkawinan'],
								'agama'			=> $value['agama'],
								'alamat'		=> $value['alamat_pasien'],
								'tmp_lahir'		=> $value['tmp_lahir'],
								'tgl_lahir'		=> $value['tgl_lahir'],
								'no_hp'			=> $value['no_hp'],
							);
						}
						
						$data['sukses']		= $this->session->flashdata('sukses');
						$data['error']		= $this->session->flashdata('error');
						$this->load->view('data/pasien', $data);
					break;
					
					default:
						echo "tabel belum buat";
					break;
				}

			break;
			case 'view_one':
				switch ($table) {
					case 'obat':
						$data['obat'] 	= $this->mymodel->getData('tb_obat')->result_array();
						$from 		= 'tb_perawatan';
						$table 		= array(
									'tb_dokter','tb_pasien', 'tb_perawatan_harian');
						$join 		= array(
									'tb_perawatan.kode_dokter  = tb_dokter.kode_dokter',
									'tb_perawatan.kode_pasien  = tb_pasien.kode_pasien',
									'tb_perawatan.id_perawatan  = tb_perawatan_harian.id_perawatan',
									);	
						$where 		= array(
							'tb_perawatan.id_perawatan'		=> $id,
							'keadaan_perawatan' 		 	=> 'dalam perawatan',
						);

						$data 		= $this->mymodel->join($from, $table, $join, $where)->row_array();

						$data['tanggal'] 	= $this->mymodel->joinwhereorder($from, $table, $join, $where, 'id_harian','DESC')->result_array();
						$this->load->view('data/obat_perawatan', $data);
					break;
					case 'rekam_medik':
						$this->load->view('data/rekam_medik');
					break;
					default:
						echo "belum buat";
					break;
				}
			break;
			case 'open_form':
				switch ($table) {
					case 'pasien':
							$data['edit']	= '0';
							$this->load->view('form/pasien', $data);
					break;
					
					default:
						echo "belum buat";
					break;
				}
			break;
			case 'edit':
				switch ($table) {
					case 'obat':
						$data 	= array(
							'nama_obat'		 => $this->input->post('nama_obat'),
							'harga'		 => $this->input->post('harga'),
							'keterangan_obat'=> $this->input->post('keterangan_obat'),
						);
						$where 	= array('id_obat' =>$id);
						$this->mymodel->actionData('update', $data, 'tb_obat', $where);
						$this->session->set_flashdata('sukses', 'Data Berhasil di update');
						redirect('Welcome/crud/view_all/obat');
					break;
					case 'pasien':
						$where 	 		= array('kode_pasien' => $id);
						$data['pasien'] = $this->mymodel-> getData('tb_pasien', $where)->row_array();
						$data['edit']	= '1';
						$this->load->view('form/pasien', $data);
					break;
					case 'edit_pasien':
						$where 	= array('kode_pasien' => $id);
						$data 			= array(
							'nik_pasien'		=> $this->input->post('nik'),
							'nama_pasien'		=> $this->input->post('nama'),
							'jnsklmn_pasien'	=> $this->input->post('jns_klm'),
							'alamat_pasien'		=> $this->input->post('alamat'),
							'tmp_lahir'			=> $this->input->post('tmp_lahir'),
							'tgl_lahir'			=> $this->input->post('tgl_lahir'),
							'no_hp'				=> $this->input->post('hp'),
							'pekerjaan'			=> $this->input->post('pekerjaan'),
							'agama'				=> $this->input->post('agama'),
							'status_perkawinan'	=> $this->input->post('status_perkawinan'),
						);
						$this->mymodel->actionData('update', $data, 'tb_pasien', $where);
						$this->session->set_flashdata('sukses', 'Data berhasil di update');
						redirect('Welcome/crud/view_all/pasien');
					break;
					case 'spesialisasi':
						$where 	= array('id_spesialisasi' => $id); 
						$data 	= array('spesialisasi' => $this->input->post('spesialisasi'));
						$this->mymodel->actionData('update', $data, 'tb_spesialisasi', $where);
						$this->session->set_flashdata('sukses', 'Data berhasil di update');
						redirect('Welcome/crud/view_all/spesialis');
					break;
					case 'poliklinik':
						$where 	= array('id_klinik' => $id); 
						$data 	= array('nama_klinik' => $this->input->post('nama_klinik'));
						$this->mymodel->actionData('update', $data, 'tb_poliklinik', $where);
						$this->session->set_flashdata('sukses', 'Data berhasil di update');
						redirect('Welcome/crud/view_all/poliklinik');
					break;
					default:
					break;
				}
			break;
			case 'create_new':
				switch ($table) {
					case 'dokter':
						$kode 			= $this->input->post('kode');
						$nama			= $this->input->post('nama');
						$id_spesialis 	= $this->input->post('id_spesialis');
						$id_klinik 		= $this->input->post('id_klinik');
						$jns_klm 		= $this->input->post('jns_klm');
						$hp 			= $this->input->post('hp');
						$alamat 		= $this->input->post('alamat');
						$pass 			= md5('12345');

						$data 			= array(
							'kode_dokter'		=> $kode,
							'nama_dokter'		=> $nama,
							'id_spesialisasi'	=> $id_spesialis,
							'id_klinik'			=> $id_klinik,
							'jnsklmn_dokter'	=> $jns_klm,
							'alamat_dokter'		=> $alamat,
							'hp_dokter'			=> $hp,
							'password'			=> $pass
						);
						$this->mymodel->actionData('input', $data, 'tb_dokter');
						$this->session->set_flashdata('sukses','Data telah ditambahkan');
						redirect(site_url("Welcome/crud/view_all/dokter"));
					break;
					case 'spesialisasi':
						$data 			= array('spesialisasi' => $this->input->post('spesialisasi'));
						$this->mymodel->actionData('input', $data, 'tb_spesialisasi');						
						$this->session->set_flashdata('sukses','Data telah ditambahkan');
						$this->session->set_flashdata('sukses','Data telah ditambahkan');
						redirect("Welcome/crud/view_all/spesialis");
					break;
					case 'pasien':
						$kode_pasien 	= $this->input->post('kode_pasien');
						$nik 			= $this->input->post('nik');
						$nama 			= $this->input->post('nama');
						$tmp_lahir 		= $this->input->post('tmp_lahir');
						$tgl_lahir 		= $this->input->post('tgl_lahir');
						$jns_klm 		= $this->input->post('jns_klm');
						$alamat 		= $this->input->post('alamat');
						$hp 			= $this->input->post('hp');

						$data 			= array(
							'kode_pasien'		=> $kode_pasien,
							'nik_pasien'		=> $nik,
							'nama_pasien'		=> $nama,
							'jnsklmn_pasien'	=> $jns_klm,
							'alamat_pasien'		=> $alamat,
							'tmp_lahir'			=> $tmp_lahir,
							'tgl_lahir'			=> $tgl_lahir,
							'no_hp'				=> $no_hp,
							'pekerjaan'			=> $this->input->post('pekerjaan'),
							'agama'				=> $this->input->post('agama'),
							'status_perkawinan'	=> $this->input->post('status_perkawinan'),
						);
						$this->mymodel->actionData('input', $data, 'tb_pasien');
						$this->session->set_flashdata('sukses','Data telah ditambahkan');
						redirect("Welcome/crud/view_all/pasien");
					break;

					case 'perawatan':
						if ($this->input->post('status_perawatan') != 'konsultasi') :
							$data 				= array(
								'kode_dokter'		=> $this->input->post('kode_dokter'),
								'kode_pasien'		=> $this->input->post('kode_pasien'),
								'cara_masuk'		=> $this->input->post('cara_masuk'),
								'diagnosa_awal'		=> $this->input->post('diagnosa_awal'),
								'status_perawatan'	=> $this->input->post('status_perawatan'),
							);
							$this->mymodel->actionData('input', $data, 'tb_perawatan');
							$lastId 			= $this->mymodel->getData('tb_perawatan', null, 'id_perawatan', 'DESC')->row_array();

							$data2 				= array(
								'tanggal'		=> date('Y-m-d h:m:s'),
								'kondisi'		=> 'Sesuai gejala diagnosis awal',
								'id_perawatan'	=> $lastId['id_perawatan'],
							);
							$this->mymodel->actionData('input', $data2, 'tb_perawatan_harian');
								redirect('Welcome/home');

						else:
							$total_biaya 	= 0;
							$where 			= array(
							 'kode_dokter' 	=> $this->input->post('kode_dokter'),
							 'kode_pasien' 	=> $this->input->post('kode_pasien'),
							);
							$tmp_obat 		= $this->mymodel->getData('tmp_list_obat', $where)->result_array();
							foreach ($tmp_obat as $i => $d) {
								$harga 		= $this->mymodel->getData('tb_obat', array('id_obat'=> $d['id_obat']))->row_array();
								$total_biaya+= $harga['harga'];
							}
							echo $total_biaya;
							$data 		= array(
								'kode_dokter'		=> $this->input->post('kode_dokter'),
								'kode_pasien'		=> $this->input->post('kode_pasien'),
								'diagnosa_awal'		=> $this->input->post('diagnosa_awal'),
								'status_perawatan'	=> $this->input->post('status_perawatan'),
								'diagnosa_utama'	=> $this->input->post('diagnosa_utama'),
								'biaya_perawatan'	=> $this->input->post('biaya_perawatan'),
								'total_biaya'		=> $total_biaya + $this->input->post('biaya_perawatan'),
								'keadaan_perawatan'	=> 'tidak dalam perawatan',
							);
							// INSERT TB PERAWATAN
							$this->mymodel->actionData('input', $data, 'tb_perawatan');
							// AMBIL LAST DATA DARI TB PERAWATAN
							$tb_perawatan 	= $this->mymodel->getData('tb_perawatan', $where, 'id_perawatan', 'DESC')->row_array();

							foreach ($tmp_obat as $key => $value) {
								$data1 		= array(
									'id_obat'		=> $value['id_obat'],
									'penggunaan'	=> $value['penggunaan'],
									'id_perawatan'	=> $tb_perawatan['id_perawatan'],
								);
								$this->mymodel->actionData('input', $data1, 'tb_list_obat_konsultasi');
								// HAPUS DATA TMP
								$where1 	= array('id_tmp_obat' => $value['id_tmp_obat']); 
								$this->mymodel->actionData('delete', null, 'tmp_list_obat', $where1); }
							redirect('Welcome/home');
						endif;
					break;
					case 'obat':
						$data 		= array(
							'nama_obat'		 => $this->input->post('nama_obat'),
							'harga'		 => $this->input->post('harga'),
							'keterangan_obat'=> $this->input->post('keterangan_obat'),
						);
						$this->mymodel->actionData('input', $data, 'tb_obat');
						$this->session->set_flashdata('sukses','Data telah ditambahkan');
						$this->session->set_flashdata('sukses','Data telah ditambahkan');
						redirect('Welcome/crud/view_all/obat');
					break;
					case 'poliklinik':
						$data 		= array(
							'nama_klinik'	 => $this->input->post('nama_klinik'),
						);
						$this->mymodel->actionData('input', $data, 'tb_poliklinik');
						$this->session->set_flashdata('sukses','Data telah ditambahkan');
						$this->session->set_flashdata('sukses','Data telah ditambahkan');
						redirect('Welcome/crud/view_all/poliklinik');
					break;
					default:
					break;
				}
			break;
			case 'delete':
				switch ($table) {
					case 'pasien':
						$where = array('kode_pasien' => $id);
						$this->mymodel->actionData('delete', $data=null, 'tb_pasien', $where);
						$this->session->set_flashdata('sukses','Data berhasil Dihapus');
						redirect('Welcome/crud/view_all/pasien');
					break;		
					case 'spesialisasi':
						$where = array('id_spesialisasi' => $id);
						$this->mymodel->actionData('delete', $data=null, 'tb_spesialisasi', $where);
						$this->session->set_flashdata('sukses','Data berhasil Dihapus');
						redirect('Welcome/crud/view_all/spesialis');
					break;
					case 'poliklinik':
						$where = array('id_klinik' => $id);
						$this->mymodel->actionData('delete', $data=null, 'tb_poliklinik', $where);
						$this->session->set_flashdata('sukses','Data berhasil Dihapus');
						redirect('Welcome/crud/view_all/poliklinik');
					break;
					case 'obat':
						$where = array('id_obat' => $id);
						$this->mymodel->actionData('delete', $data=null, 'tb_obat', $where);
						$this->session->set_flashdata('sukses','Data berhasil Dihapus');
						redirect('Welcome/crud/view_all/obat');
					break;
					default:
					break; }
			break;
			default:
				echo "belum buat";
			break;
		}
	}

	function diagnosa($aksi=null){
		switch ($aksi) {
			case 'open_form':
				$data['sess'] 	= array(
					'sess_id'		=> $this->session->userdata('id'),		
					'sess_name'		=> $this->session->userdata('nama'),		
					'sess_level'	=> $this->session->userdata('level'),		
				);
				$data['obat'] 	= $this->mymodel->getData('tb_obat')->result_array();
				$this->load->view('form/diagnosa', $data);
			break;
			
			default:
			break;
		}
	}

	// JSON GET 
	function getWhere($kode_pasien){
		$where	= array('kode_pasien' => $kode_pasien );
		$data 	= $this->mymodel->getData('tb_pasien', $where)->row_array();
		$pasien	= array(
			'kode_pasien' 	=> $data['kode_pasien'], 
			'nama_pasien' 	=> $data['nama_pasien'], 
			'nik_pasien'	=> $data['nik_pasien'],
			'jns_klm'		=> $data['jnsklmn_pasien'],
			'pekerjaan'		=> $data['pekerjaan'],
			'status'		=> $data['status_perkawinan'],
			'agama'			=> $data['agama'],
			'alamat'		=> $data['alamat_pasien'],
			'tmp_lahir'		=> $data['tmp_lahir'],
			'tgl_lahir'		=> $data['tgl_lahir'],
			'no_hp'			=> $data['no_hp'],
			// TAMBAH BARU
			'gender'		=> ($data['jnsklmn_pasien']=='L')?'Laki-Laki':'Perempuan',
			'ttl'			=> $data['tmp_lahir'].', '.date('d/m/Y', strtotime($data['tgl_lahir'])),
		);
		echo json_encode($pasien);
	}

	function perawatan_pasien($kode_pasien){
		$from 		= 'tb_perawatan';
		$table 		= array(
					'tb_dokter','tb_pasien');
		$join 		= array(
					'tb_perawatan.kode_dokter = tb_dokter.kode_dokter',
					'tb_perawatan.kode_pasien = tb_pasien.kode_pasien',
					);	
		$where 		= array(
			'tb_perawatan.kode_pasien' 		=> $kode_pasien,
			'keadaan_perawatan' 		 	=> 'dalam perawatan',
			'status_perawatan !=' 		 	=> 'konsultasi',
		);
		$bycolumn	= 'id_perawatan';
		$perawatan 	= $this->mymodel->joinwhereorder($from, $table, $join, $where, $bycolumn, 'DESC')->row_array();
		$data 		= array(
			'nama_pasien'		=> $perawatan['nama_pasien'],
			'kode_pasien'		=> $perawatan['kode_pasien'],
			'nik_pasien'		=> $perawatan['nik_pasien'],
			'jns_klm'			=> ($perawatan['jnsklmn_pasien']=='L')?'Laki-laki':'Perempuan',
			'pekerjaan'			=> $perawatan['pekerjaan'],
			'status_nikah'		=> $perawatan['status_perkawinan'],
			'agama'				=> $perawatan['agama'],
			'tmp_lahir'			=> $perawatan['tmp_lahir'],
			'tgl_lahir'			=> date('d-m-Y', strtotime($perawatan['tgl_lahir'])),
			'usia'				=> date('Y')-date('Y', strtotime($perawatan['tgl_lahir']))." tahun",
			'kode_dokter'		=> $perawatan['kode_dokter'],
			'nama_dokter'		=> $perawatan['nama_dokter'],
			'id_perawatan'		=> $perawatan['id_perawatan'],
			'diagnosa_awal'		=> $perawatan['diagnosa_awal'],
			'diagnosa_utama'	=> $perawatan['diagnosa_utama'],
			'status_perawatan'	=> $perawatan['status_perawatan'],
			'penanggung'		=> $perawatan['pj'],
			'hp_penanggung'		=> $perawatan['hp_pj'],
			'tanggal_mulai'		=> date('d-m-Y', strtotime($perawatan['log_perawatan'])),
		);
		$where 		= array('tb_perawatan_harian.id_perawatan' => $perawatan['id_perawatan']);

		$perawatan 	=$this->mymodel->getData('tb_perawatan_harian', $where, 'log_harian', 'DESC')->result_array();
		foreach ($perawatan as $key => $value) {
			$data['perawatan'][$key]	= array(
				'no'			=> $key+1,
				'id_harian'		=> $value['id_harian'],
				'tanggal'		=> date('d-m-Y', strtotime($value['tanggal'])),
				'kondisi'		=> $value['kondisi'],
			);
		}
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		echo json_encode($data);
	}

	function konfirmasi($id=null){
		$data 		= array('password'	=> md5('12345'));
		$where 		= array('kode_dokter'	=> $id,);
		$this->mymodel->actionData('update', $data, 'tb_dokter', $where);
		$this->session->set_flashdata('sukses','Password telah dirubah');
		redirect('Welcome/crud/view_all/dokter');
	}

	function list_obat($id){
		$table 	= array('tb_perawatan_harian', 'tb_obat');
		$join 	= array(
			'tb_list_obat.id_harian=tb_perawatan_harian.id_harian',
			'tb_list_obat.id_obat=tb_obat.id_obat');
		$where 	= array('tb_list_obat.id_harian' => $id);
		$obat 	= $this->mymodel->join('tb_list_obat', $table, $join, $where)->result_array();
		foreach ($obat as $key => $value) {
			$data[$key] 	= array(
				'id_list_obat'		=> $value['id_list_obat'],
				'id_obat'			=> $value['id_obat'],
				'id_harian'			=> $value['id_harian'],
				'nama_obat'			=> $value['nama_obat'],
				'harga'				=> $value['harga'],
				'keterangan'		=> $value['keterangan_obat'],
			);
		}
		echo json_encode($data);
	}

	function add_list_obat($id_harian){
		$id_obat 	= $this->input->post('id_obat');
		$id_harian	= $id_harian;
		$data = array(
			'id_obat' 	=> $id_obat,
			'id_harian' => $id_harian,
		);
		$data 		= $this->mymodel->actionData('input', $data,'tb_list_obat');
		echo json_encode($data);
	}
	function add_perawatan_harian($id_perawatan){
		$kondisi 		= $this->input->post('kondisi');
		$data 			= array(
			'tanggal'		=> date('Y-m-d h:m:s'),
			'kondisi'		=> $kondisi,
			'id_perawatan'	=> $id_perawatan,
		);
		$data 			= $this->mymodel->actionData('input', $data,'tb_perawatan_harian');
		echo json_encode($data);
	}
	function delete_perawatan_harian($id_harian){
		$where 			= array(
			'id_harian'	=> $id_harian,
		);
		$data 			= $this->mymodel->actionData('delete', null,'tb_perawatan_harian',$where);
		echo json_encode($data);
	}

	function update_perawatan($id_perawatan){
		$where 	= array('id_perawatan'	=> $id_perawatan);
		$table 	= array('tb_list_obat', 'tb_obat');	
		$join 	= array(
		 'tb_perawatan_harian.id_harian = tb_list_obat.id_harian',
		 'tb_list_obat.id_obat = tb_obat.id_obat'
		);	
		$obat 	= $this->mymodel->join('tb_perawatan_harian', $table, $join, $where)->result_array();
		$total_biaya = 0;
		foreach ($obat as $i => $d) {
			$total_biaya += $d['harga']; 
		}

		$data 	= array(
			'diagnosa_utama'	=> $this->input->post('diagnosa_utama'),
			'cara_keluar'		=> $this->input->post('cara_keluar'),
			'keadaan_keluar'	=> $this->input->post('keadaan_keluar'),
			'pj'				=> $this->input->post('pj'),
			'hp_pj'				=> $this->input->post('hp_pj'),
			'keadaan_perawatan'	=> $this->input->post('keadaan_perawatan'),
			'biaya_perawatan' 	=> (int)$this->input->post('biaya_perawatan'),
			'total_biaya'		=> $this->input->post('biaya_perawatan') + $total_biaya,
		);
		$data 			= $this->mymodel->actionData('update', $data, 'tb_perawatan', $where);		
		echo json_encode($data);
	}
	function add_tmp_list_obat(){
		$data  				= array(
			'kode_pasien'	=> $this->input->post('kode_pasien'),
			'kode_dokter'	=> $this->input->post('kode_dokter'),
			'id_obat'		=> $this->input->post('id_obat'),
			'penggunaan'	=> $this->input->post('penggunaan'),
		);
		$data 				= $this->mymodel->actionData('input', $data, 'tmp_list_obat');
		echo json_encode($data);
	}

	function get_tmp_list_obat($kode_pasien, $kode_dokter){
		$table 				= array('tb_obat');
		$join 				= array('tb_obat.id_obat = tmp_list_obat.id_obat');
		$where 				= array('kode_pasien' => $kode_pasien, 'kode_dokter' => $kode_dokter);
		$tmp_obat 			= $this->mymodel->joinwhere('tmp_list_obat', $where, $table, $join)->result_array();
		foreach ($tmp_obat as $key => $value) {
			$data[$key]		= array(
				'no'			=> $key+1,
				'harga'			=> $value['harga'],
				'id_tmp_obat'	=> $value['id_tmp_obat'],
				'nama_obat'		=> $value['nama_obat'],	
				'penggunaan'	=> $value['penggunaan'],
			);	
		}
		echo json_encode($data);
	}

	function delete_tmp_list_obat($id_tmp_obat){
		$where 		= array('id_tmp_obat' 	=> $id_tmp_obat);
		$data 		= $this->mymodel->actionData('delete', null, 'tmp_list_obat', $where);
		echo json_encode($data);
	}
	function jml_data_home(){
		$data['pasien'] 	= $this->mymodel->getData('tb_pasien')->num_rows();
		$data['dokter'] 	= $this->mymodel->getData('tb_dokter')->num_rows();
		$data['obat'] 		= $this->mymodel->getData('tb_obat')->num_rows();
		$data['poliklinik'] = $this->mymodel->getData('tb_poliklinik')->num_rows();

		echo json_encode($data);
	}

	function daftar_perawatan($kode_pasien){
		$table 		= array('tb_dokter');
		$join 		= array('tb_perawatan.kode_dokter = tb_dokter.kode_dokter');
		$where 		= array('kode_pasien' => $kode_pasien, 'status_perawatan !=' => 'konsultasi',);
		$perawatan 	= $this->mymodel->joinwhereorder('tb_perawatan',  $table, $join, $where, 'tb_perawatan.id_perawatan', 'DESC')->result_array();
		foreach ($perawatan as $key => $value) {
			// MENCARI TANGGAL MULAI DAN TANGGAL AKHIR DAN MEMBUAT SELISIH 
			$where1 = array('id_perawatan' => $value['id_perawatan']); 
			$hari_1	= $this->mymodel->getData('tb_perawatan_harian', $where1, 'id_harian', 'ASC')->row_array();
			$hari_2	= $this->mymodel->getData('tb_perawatan_harian', $where1, 'id_harian', 'DESC')->row_array();
			$h_mulai= date_create(date('Y-m-d', strtotime($hari_1['tanggal'])));
			$h_akhir= date_create(date('Y-m-d', strtotime($hari_2['tanggal'])));
			$selisih= date_diff($h_mulai, $h_akhir);
			// END MENCARI TANGGAL MULAI DAN TANGGAL AKHIR DAN MEMBUAT SELISIH 

			$data[$key]	= array(
				'id_perawatan'	=> $value['id_perawatan'],
				'dokter'		=> $value['nama_dokter'],
				'total_biaya'	=> $value['total_biaya'],
				'diagnosa_utama'=> ($value['diagnosa_utama']!= null)?$value['diagnosa_utama']:'Diagnosis awal '.$value['diagnosa_awal'],
				'keadaan_keluar'=> ($value['keadaan_keluar']!= null)?$value['keadaan_keluar']:'Pasien masih dirawat',
				'lama_perawatan'=> (($selisih->days)+1)." hari",
				'tanggal'		=> date('d-m-Y', strtotime($hari_1['tanggal'])),
				'status_perawatan'=> ($value['status_perawatan']=='inap'?'Rawat Inap':'Rawat Jalan'),
			);
		}
		echo json_encode($data);
	}

	function daftar_konsultasi($kode_pasien){
		$table 		= array('tb_dokter');
		$join 		= array('tb_perawatan.kode_dokter = tb_dokter.kode_dokter');
		$where 		= array('kode_pasien' => $kode_pasien, 'status_perawatan ' => 'konsultasi',);
		$konsultasi = $this->mymodel->joinwhereorder('tb_perawatan', $table, $join, $where, 'tb_perawatan.id_perawatan', 'DESC')->result_array();

		foreach ($konsultasi as $key => $d) {
			$data[$key]				 = array(
				'id_perawatan'		 => $d['id_perawatan'],
				'total_biaya'		 => $d['total_biaya'],	
				'dokter'			 => $d['nama_dokter'],
				'diagnosa_utama'	 => $d['diagnosa_utama'],
				'tanggal'			 => date('d-m-Y', strtotime($d['log_perawatan'])),
			);
		}
		echo json_encode($data);
	}

	function get_perawatan_harian($id_perawatan){
		$where 	= array('id_perawatan' => $id_perawatan);
		$harian = $this->mymodel->getData('tb_perawatan_harian', $where)->result_array();
		foreach ($harian as $key=> $d) {
			$data[$key]			=  array(
				'id_harian'		=> $d['id_harian'], 
				'tanggal'		=> date('d-m-Y', strtotime($d['tanggal'])),
				'kondisi' 		=> $d['kondisi'],
			);
		}
		echo json_encode($data);
	}

	function list_obat_konsultasi($id_perawatan){
		$where 	= array('id_perawatan' 	=> $id_perawatan);
		$table 	= array('tb_obat');
		$join 	= array('tb_obat.id_obat = tb_list_obat_konsultasi.id_obat');
		$obat 	= $this->mymodel->join('tb_list_obat_konsultasi', $table, $join, $where)->result_array();
		foreach ($obat as $key 	 => $value) {
			$data[$key] 		 = array(
				'nama_obat'		 => $value['nama_obat'],
				'keterangan_obat'=> $value['keterangan_obat'],
				'penggunaan'	 => $value['penggunaan'],
			);
		}
		echo json_encode($data);
	}
}

?>