<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diskusi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_created');
		$this->load->model('Model_admin');
		$this->load->model('Model_diskusi');
		$this->load->library('form_validation');
	}

	public function lihatDiskum($filter='belum-selesai', $page=1)
	{
		$cek 			= $this->Model_admin->cekAkun($this->session->user);

		// Set $status sesuai parameter $filter
		// Jika ada yang mengisi $filter dengan hal lain maka redirect ke halaman default lihatDiskum
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
			redirect('admin/Diskusi/lihatDiskum');
		}

		$this->load->helper('my_helper');

		// Ambil semua IDPesan berdasarkan IDPengelola di tb_pemesanan
		$pengelola		= $this->Model_admin->getAkunPengelola($this->session->user);
		$id_pengelola	= $pengelola->IDPengelola;
		$id_pesan		= $this->Model_admin->getAllIdPesan($id_pengelola);

		if (empty($id_pesan)) {
			$id_pesan	= '';
		}
		else {
			// Buat array $id_pesan menjadi array numeric dengan bantuan function flattenArray() dari my_helper
			$id_pesan		= flattenArray($id_pesan);
		}

		$this->load->model('Model_diskusi');
		$jumlah_diskum	= $this->Model_diskusi->getJumlahDiskum($id_pesan, $status);
		$jumlah_diskum	= $jumlah_diskum->jumlah;
		// Algoritma pembagian halaman (satu halaman berisi maks. 50 daftar diskum)
		$maks			= 50;
		if ($page > ($jumlah_diskum/$maks)+1 || $page < 0) {
			redirect('admin/Diskusi/lihatDiskum');
		}

		$hal_selanjutnya	= $page < ($jumlah_diskum/$maks);
		$hal_sebelumnya		= $page > 1;

		$limit			= $page*$maks;
		$baris			= ($page-1)*$maks;

		// Ambil daftar diskusi dari tb_diskusiumkm berdasarkan IDPesan tadi
		$daftar_diskusi = $this->Model_diskusi->getDaftarDiskum($id_pesan, $status, $baris, $limit);

		// Cek jika $daftar_diskusi kosong beri status has_diskum=false
		// jika ada $daftar_diskusi maka beri status has_diskum=true dan masukan ke $data
		if( empty($daftar_diskusi) && $filter!=='telah-selesai') {
			$data = array(
				'has_diskum'		=> false,
				'akun'				=> $cek,
				'filter'			=> $filter,
				'page'				=> $page,
				'hal_selanjutnya'	=> $hal_selanjutnya,
				'hal_sebelumnya'	=> $hal_sebelumnya
			);
		}
		else {
			$data = array(
				'has_diskum'		=> true,
				'akun'				=> $cek,
				'daftar_diskusi'	=> $daftar_diskusi,
				'filter'			=> $filter,
				'page'				=> $page,
				'hal_selanjutnya'	=> $hal_selanjutnya,
				'hal_sebelumnya'	=> $hal_sebelumnya
			);
		}

		$this->load->view('admin/lihatdiskum', $data);
	}

	/**
	 * Function untuk melihat detil diskum
	 *
	 * Boleh ganti nama function-nya nanti
	 */
	public function diskum($id_pesan='0')
	{
		// Cek IDPesan dan pastikan user tidak input alamat "appredesign/Admin/diskusi" tanpa IDPesan
		if ($id_pesan!=='0') {
			// Ambil data user
			$cek 				= $this->Model_admin->cekAkun($this->session->user);
			$pengelola			= $this->Model_admin->getAkunPengelola($this->session->user);
			$id_pengelola		= $pengelola->IDPengelola;

			// Dapatkan detil pemesanan/request (gabungan tabel tb_pemesanan dan tb_umkm_data)
			$this->load->model('Model_diskusi');
			$detil_pemesanan	= $this->Model_diskusi->getPemesanan($id_pesan, $id_pengelola, 'pengelola');

			// Cek jika pemesanan ada hubungannya dengan pengelola
			if ( is_null($detil_pemesanan) ) {
				$data = array(
					'akun'				=> $cek,
					'pemesanan'			=> null
				);

				$_SESSION['alert'] = 'Diskusi tidak ditemukan';
				$this->session->mark_as_flash('alert');
			}
			else{
				unset($_SESSION['alert']);

				// Cek designer
				// Jika designer ada, ambil nama designer. Jika tidak, beri keterangan 'Ditentukan Pengelola'
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

				// Ambil data diskusi(komentar-komentar) berdasarkan IDPesan
				$daftar_komentar = $this->Model_diskusi->getDiskum($id_pesan);

				$data = array(
					'akun'				=> $cek,
					'pemesanan'			=> $detil_pemesanan,
					'designer'			=> $data_designer,
					'daftar_komentar'	=> $daftar_komentar
				);
			}

			// var_dump($data); // untuk liat isi array $data

			// Load helper untuk memformat tanggal di view "admin/diskum"
			$this->load->helper('my_helper');

			// Load view
			$this->load->view('admin/diskum', $data);

		} else {
			http_response_code('400');
		}
	}

	/**
	 * Function untuk menambah komentar di diskum
	 */
	public function tambahKomentar()
	{
		// Cek kalo user ke alamat ini dengan method post (tidak mengetik secara langsung alamat "appredesign/Admin/tambahKomentar")
		if($this->input->method() == 'post') {
			// Ambil IDPengelola
			$pengelola		= $this->Model_admin->getAkunPengelola($this->session->user);
			$id_pengelola	= $pengelola->IDPengelola;

			// Kembalikan IDPesan sesuai format, 1 -> PS0001
			$id_terpotong	= $this->input->post('np');
			$id_pesan		= 'PS'.str_pad($id_terpotong, 4, '0', STR_PAD_LEFT);

			$data			= array();
			$alert			= '';

			// Proses upload foto dengan bantuan function uploadFoto() dari my_helper
			// Jika tidak ada foto yang di-upload maka lewati bagian if() ini
			$this->load->helper('my_helper');
			if( $_FILES['foto-komentar']['error'] !== 4 ){
				$alert	= uploadFoto('foto-komentar', 'foto_diskum');
				$data	+= array(
					'Foto_diskum' => $_FILES['foto-komentar']['name']
				);
			}

			// Cek apakah upload foto berhasil
			// Jika berhasil tambahkan ke database, jika tidak berhasil lempar peringatan ke halaman diskusi
			if($alert==='sukses' || $alert===''){
				$this->load->model('Model_created');
				$id_diskum		= $this->Model_created->idDiskum();

				$komentar		= $this->input->post('komentar');
				$tanggal_waktu	= date('Y-m-d h:i:s');
				// $now			= new DateTime('now',new DateTimeZone('Asia/Jakarta'));
				// $tanggal_waktu	= $now->format('Y-m-d H:i:s');

				// IDUMKM dikosongkan karena pengirim komentar adalah Pengelola
				$data 			+= array(
					'IDDiskum'		=> $id_diskum,
					'IDPengelola'	=> $id_pengelola,
					'IDPesan'		=> $id_pesan,
					'Komentar'		=> $komentar,
					'Tanggal_waktu'	=> $tanggal_waktu
				);
				// var_dump($data);

				$this->load->model('Model_diskusi');
				$this->Model_diskusi->createDiskum($data);

				redirect('admin/Diskusi/diskum/'.$id_pesan);

			}
			else{
				$_SESSION['alert'] = $alert;
				$this->session->mark_as_flash('alert');
				redirect('admin/Diskusi/diskum/'.$id_terpotong);
			}
		}
		else
			redirect('admin/Diskusi');
	}

	public function dispro($id_pesan='0')
	{
		// Cek IDPesan dan pastikan user tidak input alamat "appredesign/Admin/diskusi" tanpa IDPesan
		if ($id_pesan!=='0') {
			// Ambil data user
			$cek 				= $this->Model_admin->cekAkun($this->session->user);
			$pengelola			= $this->Model_admin->getAkunPengelola($this->session->user);
			$id_pengelola		= $pengelola->IDPengelola;

			// Dapatkan detil pemesanan/request (gabungan tabel tb_pemesanan dan tb_umkm_data)
			$this->load->model('Model_diskusi');
			$detil_pemesanan	= $this->Model_diskusi->getPemesanan($id_pesan, $id_pengelola, 'pengelola');

			// Cek jika pemesanan ada hubungannya dengan pengelola
			if ( is_null($detil_pemesanan) ) {
				$data = array(
					'akun'				=> $cek,
					'pemesanan'			=> null
				);

				$_SESSION['alert'] = 'Diskusi tidak ditemukan';
				$this->session->mark_as_flash('alert');
			}
			else{
				unset($_SESSION['alert']);

				// Cek designer
				// Jika designer ada, ambil nama designer. Jika tidak, beri keterangan 'Ditentukan Pengelola'
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

				// Ambil data diskusi(komentar-komentar) berdasarkan IDPesan
				$daftar_komentar = $this->Model_diskusi->getDispro($id_pesan);

				$data = array(
					'akun'				=> $cek,
					'pemesanan'			=> $detil_pemesanan,
					'designer'			=> $data_designer,
					'daftar_komentar'	=> $daftar_komentar
				);
			}
			// var_dump($data['daftar_diskusi']); // untuk liat isi array $data

			$this->load->helper('my_helper');

			// Load view
			$this->load->view('admin/dispro', $data);

		} else {
			http_response_code('400');
		}
	}

	public function tambahKomen()
	{
		// Cek kalo user ke alamat ini dengan method post (tidak mengetik secara langsung alamat "appredesign/Admin/tambahKomentar")
		if($this->input->method() == 'post') {
			// Ambil IDPengelola
			$pengelola		= $this->Model_admin->getAkunPengelola($this->session->user);
			$id_pengelola	= $pengelola->IDPengelola;

			// Kembalikan IDPesan sesuai format, 1 -> PS0001
			$id_terpotong	= $this->input->post('np');
			$id_pesan		= 'PS'.str_pad($id_terpotong, 4, '0', STR_PAD_LEFT);

			$data			= array();
			$alert			= '';

			// Proses upload foto dengan bantuan function uploadFoto() dari my_helper
			// Jika tidak ada foto yang di-upload maka lewati bagian if() ini
			$this->load->helper('my_helper');
			if( $_FILES['foto-komentar']['error'] !== 4 ){
				$alert	= uploadFoto('foto-komentar', 'foto_dispro');
				$data	+= array(
					'Foto_dispro' => $_FILES['foto-komentar']['name']
				);
			}

			// Cek apakah upload foto berhasil
			// Jika berhasil tambahkan ke database, jika tidak berhasil lempar peringatan ke halaman diskusi
			if($alert==='sukses' || $alert===''){
				$this->load->model('Model_created');
				$id_diskum		= $this->Model_created->idDispro();

				$komentar		= $this->input->post('komentar');
				$tanggal_waktu	= date('Y-m-d h:i:s');
				// $now			= new DateTime('now',new DateTimeZone('Asia/Jakarta'));
				// $tanggal_waktu	= $now->format('Y-m-d H:i:s');

				// IDUMKM dikosongkan karena pengirim komentar adalah Pengelola
				$data 			+= array(
					'IDDispro'		=> $id_diskum,
					'IDPengelola'	=> $id_pengelola,
					'IDPesan'		=> $id_pesan,
					'Komentar'		=> $komentar,
					'Tanggal_waktu'	=> $tanggal_waktu
				);
				// var_dump($data);

				$this->load->model('Model_diskusi');
				$this->Model_diskusi->createDispro($data);

				redirect('admin/Diskusi/dispro/'.$id_pesan);

			}
			else{
				$_SESSION['alert'] = $alert;
				$this->session->mark_as_flash('alert');
				redirect('admin/Diskusi/dispro/'.$id_terpotong);
			}
		}
		else
			redirect('admin/Diskusi');
	}

	public function lihatDispro($filter='belum-selesai', $page=1)
	{
		$cek 			= $this->Model_admin->cekAkun($this->session->user);

		// Set $status sesuai parameter $filter
		// Jika ada yang mengisi $filter dengan hal lain maka redirect ke halaman default lihatDiskum
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
			redirect('admin/Diskusi/lihatDispro');
		}

		$this->load->helper('my_helper');

		// Ambil semua IDPesan berdasarkan IDPengelola di tb_pemesanan
		$pengelola		= $this->Model_admin->getAkunPengelola($this->session->user);
		$id_pengelola	= $pengelola->IDPengelola;
		$id_pesan		= $this->Model_admin->getAllIdPesan($id_pengelola);

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
		$maks			= 50;
		if ($page > ($jumlah_dispro/$maks)+1 || $page < 0) {
			redirect('admin/Diskusi/lihatDispro');
		}

		$hal_selanjutnya	= $page < ($jumlah_dispro/$maks);
		$hal_sebelumnya		= $page > 1;

		$limit			= $page*$maks;
		$baris			= ($page-1)*$maks;

		// Ambil daftar diskusi dari tb_diskusiumkm berdasarkan IDPesan tadi
		$daftar_diskusi = $this->Model_diskusi->getDaftarDispro($id_pesan, $status, $baris, $limit);

		// Cek jika $daftar_diskusi kosong beri status has_diskum=false
		// jika ada $daftar_diskusi maka beri status has_diskum=true dan masukan ke $data
		if( empty($daftar_diskusi) && $filter!=='telah-selesai') {
			$data = array(
				'has_diskum'		=> false,
				'akun'				=> $cek,
				'filter'			=> $filter,
				'page'				=> $page,
				'hal_selanjutnya'	=> $hal_selanjutnya,
				'hal_sebelumnya'	=> $hal_sebelumnya
			);
		}
		else {
			$data = array(
				'has_diskum'		=> true,
				'akun'				=> $cek,
				'daftar_diskusi'	=> $daftar_diskusi,
				'filter'			=> $filter,
				'page'				=> $page,
				'hal_selanjutnya'	=> $hal_selanjutnya,
				'hal_sebelumnya'	=> $hal_sebelumnya
			);
		}

		$this->load->view('admin/lihatdispro', $data);
	}


}

?>
