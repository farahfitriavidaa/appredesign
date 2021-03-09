<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Diskusi extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		if( ! $this->session->has_userdata('user') OR $this->session->level !== 'umkm'){
			session_destroy();
			redirect('Create/login');
		}

		$this->load->model('Model_umkm');
	}

	/**
	 * Menampilkan thread diskusi suatu request
	 *
	 * re-mapped: base_url()/umkm/diskusi/(:num)
	 */
	public function index($id_pesan='0')
	{
		// Cek IDPesan dan pastikan user tidak input alamat ".../Umkm/diskusi" tanpa IDPesan
		if ($id_pesan!=='0') {
			$id_umkm			= $this->session->id_umkm;

			// Kembalikan IDPesan sesuai format, 1 -> PS0001
			$id_pesan			= 'PS'.str_pad($id_pesan, 4, '0', STR_PAD_LEFT);

			// Dapatkan detil pemesanan/request (gabungan tabel tb_pemesanan dan tb_umkm_data)
			$this->load->model('Model_diskusi');
			$detil_pemesanan	= $this->Model_diskusi->getPemesanan($id_pesan, $id_umkm, 'umkm');

			// Cek jika pemesanan ada hubungannya dengan designer
			if ( is_null($detil_pemesanan) ) {
				$data = array(
					'pemesanan'			=> null
				);

				$_SESSION['alert'] = 'Diskusi tidak ditemukan';
				$this->session->mark_as_flash('alert');
			}
			else{
				unset($_SESSION['alert']);

				// Cek designer
				// Jika ada ambil nama designer, jika tidak beri keterangan 'Ditentukan Pengelola'
				$data_designer		= array();
				if( is_null($detil_pemesanan->IDDesigner) ){
					$data_designer['designer']	= 'Ditentukan Pengelola';
					$data_designer['ada']		= FALSE;
				}
				else{
					$designer 					= $this->Model_diskusi->getNamaDesainer($detil_pemesanan->IDDesigner);
					$data_designer['designer']	= $designer->Nama_lengkap;
					$data_designer['ada']		= TRUE;
				}

				// Ambil data diskusi berdasarkan IDPesan
				$daftar_diskusi	= $this->Model_diskusi->getDiskum($id_pesan);

				$data			= array(
					'pemesanan'			=> $detil_pemesanan,
					'designer'			=> $data_designer,
					'daftar_diskusi'	=> $daftar_diskusi
				);
			}
			// Load helper untuk memotong IDPesan (PS0015 -> 15) dan untuk cetak badge status
			$this->load->helper( array('my_helper' ,'status_helper') );
			$this->load->view('umkm/diskusi', $data);

		} else {
			http_response_code('400');
		}
	}

	public function lihatDiskusi($filter='belum-selesai', $page=1)
	{
		if ($filter==='belum-selesai') {
			$status = ['0', '1', '2', '3' ,'4', '5', '6'];
		}
		elseif ($filter==='semua') {
			$status = ['0', '1', '2', '3' ,'4', '5', '6', '7'];
		}
		elseif ($filter==='telah-selesai') {
			$status = ['7'];
		}
		else {
			redirect('umkm/diskusi/lihatDiskusi');
		}

		$this->load->helper( array('my_helper', 'status_helper') );

		// Ambil semua IDPesan berdasarkan IDUMKM
		$id_umkm	= $this->session->id_umkm;
		$id_pesan	= $this->Model_umkm->getAllIdPesan($id_umkm);

		if (empty($id_pesan)) {
			$id_pesan	= '';
		}
		else {
			// Buat array $id_pesan menjadi array numeric dengan bantuan function flattenArray() dari my_helper
			$id_pesan		= flattenArray($id_pesan);
		}

		$this->load->model('Model_diskusi');
		$jumlah_diskusi	= $this->Model_diskusi->getJumlahDiskum($id_pesan, $status);
		$jumlah_diskusi	= $jumlah_diskusi->jumlah;
		// Algoritma pembagian halaman (satu halaman berisi maks. 10 daftar diskum)
		$maks			= 10;
		if ($page > ($jumlah_diskusi/$maks)+1 || $page < 0) {
			redirect('umkm/diskusi/lihatDiskusi');
		}

		$hal_selanjutnya	= $page < ($jumlah_diskusi/$maks);
		$hal_sebelumnya		= $page > 1;

		$limit			= $page*$maks;
		$baris			= ($page-1)*$maks;

		// Ambil daftar diskusi dari tb_diskusiumkm berdasarkan IDPesan tadi
		$daftar_diskusi = $this->Model_diskusi->getDaftarDiskum($id_pesan, $status, $baris, $limit);

		// Cek jika daftar diskusi kosong beri status has_diskum=false
		// jika ada daftar diskusi maka beri status has_diskum=true dan masukan ke $data
		if( empty($daftar_diskusi) ) {
			$data = array(
				'has_diskum' 		=> false,
				'filter'			=> $filter,
				'page'				=> $page,
				'hal_selanjutnya'	=> $hal_selanjutnya,
				'hal_sebelumnya'	=> $hal_sebelumnya
			);
		}
		else {
			$data = array(
				'has_diskum'		=> true,
				'daftar_diskusi'	=> $daftar_diskusi,
				'filter'			=> $filter,
				'page'				=> $page,
				'hal_selanjutnya'	=> $hal_selanjutnya,
				'hal_sebelumnya'	=> $hal_sebelumnya
			);
		}

		$this->load->view('umkm/lihatdiskusi', $data);
	}

	public function tambahKomentar()
	{
		// Cek kalo user ke alamat ini dengan method post (tidak mengetik secara langsung alamat "../Umkm/tambahKomentar")
		if($this->input->method() == 'post') {

			$this->load->helper('my_helper');

			// Kembalikan IDPesan sesuai format, 1 -> PS0001
			$id_terpotong	= $this->input->post('np');
			$id_pesan		= 'PS'.str_pad($id_terpotong, 4, '0', STR_PAD_LEFT);

			$data			= array();
			$alert			= '';

			// Proses upload foto dengan library upload
			// Jika tidak ada foto yang di-upload maka lewati bagian if() ini
			if( $_FILES['foto-komentar']['error'] !== 4 ){

				$this->load->library('upload');

				$config['upload_path']		= './uploads/foto_diskum/';
				$config['allowed_types']	= 'png|jpg|jpeg';
				$config['max_size']			= '65000';

				$this->upload->initialize($config);

				if ( ! $this->upload->do_upload('foto-komentar') ) {
					$alert = $this->upload->display_errors();
				}
				else {
					$data	+= array(
						'Foto_diskum' => $this->upload->data('file_name')
					);
				}
			}

			// Cek apakah upload foto berhasil
			// Jika berhasil tambahkan ke database, jika tidak berhasil lempar peringatan ke halaman diskusi
			if( empty($alert) ){
				$this->load->model('Model_created');
				$id_diskum		= $this->Model_created->idDiskum();

				$komentar		= $this->input->post('komentar');

				$now			= new DateTime('now', new DateTimeZone('Asia/Jakarta'));
				$tanggal_waktu	= $now->format('Y-m-d H:i:s');

				// IDPengelola dikosongkan karena pengirim komentar adalah UMKM
				$data 			+= array(
					'IDDiskum'		=> $id_diskum,
					'IDUMKM'		=> $this->session->id_umkm,
					'IDPesan'		=> $id_pesan,
					'Komentar'		=> $komentar,
					'Tanggal_waktu'	=> $tanggal_waktu
				);

				$this->load->model('Model_diskusi');
				$this->Model_diskusi->createDiskum($data);

				redirect('umkm/diskusi/'.$id_terpotong);

			}
			else{
				$_SESSION['alert'] = $alert;
				$this->session->mark_as_flash('alert');
				redirect('umkm/diskusi/'.$id_terpotong);
			}
		}
		else
			redirect('umkm');
	}
}