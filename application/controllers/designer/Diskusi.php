<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Diskusi extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		if( ! $this->session->has_userdata('user') OR $this->session->level !== 'designer' ){
			session_destroy();
			redirect('Create/login');
		}

		$this->load->model('Model_designer');
    }

	/**
	 * Menampilkan thread diskusi suatu request
	 *
	 * re-mapped: base_url()/designer/diskusi/(:num)
	 */
    public function index($id_pesan = '0')
	{
		if ($id_pesan==='0') {
			return http_response_code('400');
		}

		$id_pesan 			= 'PS'.str_pad($id_pesan, 4, '0', STR_PAD_LEFT);
		$id_designer		= $this->session->id_designer;
		// Dapatkan detil pemesanan/request (gabungan tabel tb_pemesanan dan tb_umkm_data)
		$this->load->model('Model_diskusi');
		$detil_pemesanan	= $this->Model_diskusi->getPemesanan($id_pesan, $id_designer, 'designer');

		// Cek jika pemesanan ada hubungannya dengan designer
		if ( is_null($detil_pemesanan) ) {
			$data = array(
				'pemesanan'			=> null
			);

			// TIdak pakai flashdata agar bisa menampilkan flashdata dari tambahKomentar()
			// bug (?)
			$_SESSION['alert'] = 'Diskusi tidak ditemukan';
			$_SESSION['btn_back'] = true;

			$this->session->mark_as_flash(array('alert', 'btn_back'));
		}
		else{

			// Cek designer
			// Jika designer ada, ambil nama designer. Jika tidak, beri keterangan 'Ditentukan Pengelola'
			$data_designer		= array();
			if ( is_null($detil_pemesanan->IDDesigner) ){
				$data_designer['designer']	= 'Ditentukan Pengelola';
				$data_designer['ada']		= FALSE;
			}
			else{
				$designer 					= $this->Model_diskusi->getNamaDesainer($detil_pemesanan->IDDesigner);
				$data_designer['designer']	= $designer->Nama_lengkap;
				$data_designer['ada']		= TRUE;
			}

			// Ambil data diskusi(komentar-komentar) berdasarkan IDPesan
			$daftar_komentar = $this->Model_diskusi->getDispro($id_pesan);

			$data = array(
				'pemesanan'			=> $detil_pemesanan,
				'designer'			=> $data_designer,
				'daftar_komentar'	=> $daftar_komentar
			);
		}

		$this->load->helper(array('my_helper', 'status_helper'));
		$this->load->view('designer/diskusi', $data);
    }

    public function lihatDiskusi($filter = 'belum-selesai', $page = 1)
	{
		if ($filter==='belum-selesai') {
			$status = ['1', '2', '3' ,'4'];
		}
		elseif ($filter==='semua') {
			$status = ['1', '2', '3' ,'4', '5','6', '7'];
		}
		elseif ($filter==='telah-selesai') {
			$status = ['5','6', '7'];
		}
		else {
			redirect('designer/diskusi/lihatDiskusi');
		}

		$this->load->helper('my_helper');

		// Ambil semua IDPesan berdasarkan IDPengelola di tb_pemesanan
		$id_designer	= $this->session->id_designer;
		$id_pesan		= $this->Model_designer->getAllIdPesan($id_designer);

		if (empty($id_pesan)) {
			$id_pesan	= '';
		}
		else {
			// Buat array $id_pesan menjadi array numeric dengan bantuan function flattenArray() dari my_helper
			$id_pesan		= flattenArray($id_pesan);
		}

		$this->load->model('Model_diskusi');
		$jumlah_dispro	= $this->Model_diskusi->getJumlahDispro($id_pesan, $status);
		$jumlah_dispro	= $jumlah_dispro->jumlah;
		// Algoritma pembagian halaman (satu halaman berisi maks. 50 daftar diskum)
		$maks 			= 50;
		if ($page > ($jumlah_dispro/$maks)+1 || $page < 0) {
			redirect('designer/diskusi/lihatDiskusi');
		}

		$hal_selanjutnya	= $page < ($jumlah_dispro/$maks);
		$hal_sebelumnya		= $page>1;

		$limit			= $page*$maks;
		$baris			= ($page-1)*$maks;

		// Ambil daftar diskusi dari tb_diskusiproduk berdasarkan IDPesan tadi
		$daftar_diskusi = $this->Model_diskusi->getDaftarDispro($id_pesan, $status, $baris, $limit);

		// Cek jika $daftar_diskusi kosong beri status has_dispro=false
		// jika ada $daftar_diskusi maka beri status has_dispro=true dan masukan ke $data
		if( empty($daftar_diskusi) && $filter!=='telah-selesai') {
			$data = array(
				'has_dispro'		=> false,
				'filter'			=> $filter,
				'page'				=> $page,
				'hal_selanjutnya'	=> $hal_selanjutnya,
				'hal_sebelumnya'	=> $hal_sebelumnya
			);
		}
		else {
			$data = array(
				'has_dispro'		=> true,
				'daftar_diskusi'	=> $daftar_diskusi,
				'filter'			=> $filter,
				'page'				=> $page,
				'hal_selanjutnya'	=> $hal_selanjutnya,
				'hal_sebelumnya'	=> $hal_sebelumnya
			);
		}

		$this->load->helper('status_helper');
		$this->load->view('designer/lihatdiskusi', $data);
    }

    public function tambahKomentar()
	{
		if($this->input->method() == 'post') {

			$this->load->helper('my_helper');

			// Kembalikan IDPesan sesuai format, 1 -> PS0001
			$id_pesan		= $this->input->post('np');
			$id_pesan_asli	= 'PS'.str_pad($id_pesan, 4, '0', STR_PAD_LEFT);

			$data			= array();
			$alert			= '';

			// Jika tidak ada foto yang di-upload maka lewati bagian if() ini
			if( $_FILES['foto-komentar']['error'] !== 4 ){

				$this->load->library('upload');

				$config['upload_path']		= './uploads/foto_dispro/';
				$config['allowed_types']	= 'png|jpg|jpeg';
				$config['max_size']			= '65000';

				$this->upload->initialize($config);

				if ( ! $this->upload->do_upload('foto-komentar') ) {
					$alert = $this->upload->display_errors();
				}
				else {
					$data	+= array(
						'Foto_dispro' => $this->upload->data('file_name')
					);
				}
			}

			// Cek apakah upload foto berhasil
			// Jika berhasil tambahkan ke database, jika tidak berhasil lempar peringatan ke halaman diskusi
			if( empty($alert) ){
				$this->load->model('Model_created');
				$id_dispro		= $this->Model_created->idDispro();

				$komentar		= $this->input->post('komentar');
				$tanggal_waktu	= date('Y-m-d h:i:s');
				// $now			= new DateTime('now',new DateTimeZone('Asia/Jakarta'));
				// $tanggal_waktu	= $now->format('Y-m-d H:i:s');

				// IDUMKM dikosongkan karena pengirim komentar adalah Pengelola
				$data 			+= array(
					'IDDispro'		=> $id_dispro,
					'IDDesigner'	=> $this->session->id_designer,
					'IDPesan'		=> $id_pesan_asli,
					'Komentar'		=> $komentar,
					'Tanggal_waktu'	=> $tanggal_waktu
				);
				// var_dump($data);

				$this->load->model('Model_diskusi');
				$this->Model_diskusi->createDispro($data);

				redirect('designer/diskusi/'.$id_pesan);

			}
			else{
				$_SESSION['alert'] = $alert;
				$this->session->mark_as_flash('alert');
				redirect('designer/diskusi/'.$id_pesan);
			}
		}
		else
			redirect('designer');
	}
}