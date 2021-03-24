<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Diskusi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if ( ! $this->session->has_userdata('user') && ! $this->session->has_userdata('level')) {
			session_destroy();
			redirect('Create/login');
		}

		if ($this->uri->segment(1) !== $this->session->level) {
			redirect('Create/logout');
		}

		$this->load->Model('Model_diskusi');
	}

	/**
	 * Menampilkan thread diskusi antara Pengelola dengan UMKM
	 *
	 * @param    String    $diskusi     Jenis diskusi (diskum/dispro)
	 * @param    String    $id_pesan    IDPesan yang telah di-trim
	 */
	public function index($diskusi, $id_pesan = '0')
	{
		if ( ! ($diskusi !== 'diskum' XOR $diskusi !== 'dispro')) {
			return http_response_code(500);
		}

		if ($id_pesan === '0') {
			return http_response_code(400);
		}

		// Mengubah kembali IDPesan yang telah di-trim ke bentuk semula. cth: 15 -> PS0015
		$id_pesan           = 'PS'.str_pad($id_pesan, 4, '0', STR_PAD_LEFT);

		// Level pengguna (admin/designer/umkm)
		$level              = $this->session->level;
		$username           = $this->session->user;

		// id pengguna berdasarkan level (IDPengelola/IDDesigner/IDUMKM)
		$id_level           = $this->_getIdLevel($username, $level);

		// Dapatkan detel pemesanan/request (gabungan tabel tb_pemesanan dan tb_umkm_data)
		$detel_pemesanan    = $this->Model_diskusi->getPemesanan($id_pesan, $id_level, $level);

		// Cek jika pemesanan ada hubungannya dengan user yang akan mengakses
		// Jika tidak ada hubungannya, beri notifikasi
		if (is_null($detel_pemesanan)) {
			$data = array(
				'pemesanan' => NULL
			);

			$_SESSION['alert']     = 'Diskusi tidak ditemukan';
			$_SESSION['btn_back']  = TRUE;

			$this->session->mark_as_flash(array('alert', 'btn_back'));
		}
		else {
			// Cek IDDesigner di pemesanan
			// Jika IDDesigner ada, ambil nama designer. Jika tidak ada, null
			if (is_null($detel_pemesanan->IDDesigner)){
				$designer    = NULL;
			}
			else {
				$designer    = $this->Model_diskusi->getNamaDesainer($detel_pemesanan->IDDesigner);
				$designer    = $designer->Nama_lengkap;
			}

			if ($diskusi === 'diskum')
				$daftar_komentar = $this->Model_diskusi->getDiskum($id_pesan);
			else
				$daftar_komentar = $this->Model_diskusi->getDispro($id_pesan);

			$data = array(
				'pemesanan'         => $detel_pemesanan,
				'designer'          => $designer,
				'daftar_komentar'   => $daftar_komentar,
				'level'             => $level,
				'jenis_diskusi'     => $diskusi
			);
		}

		$this->load->helper(array('my_helper', 'status_helper', 'text'));
		$this->load->view('diskusi/diskusi', $data);
	}

	/**
	 * Menampilkan semua diskusi yang dimiliki setiap pengguna
	 *
	 * @param    String    $diskusi    Jenis diskusi (diskum/dispro)
	 * @param    String    $filter     Filter status diskusi yang ingin ditampilkan
	 * @param    String    $page       halaman
	 */
	public function lihatDiskusi($diskusi, $filter = 'belum-selesai', $page = 1)
	{
		if ( ! ($diskusi !== 'diskum' XOR $diskusi !== 'dispro')) {
			return http_response_code(500);
		}

		$level          = $this->session->level;
		$username       = $this->session->user;

		$status         = $this->_getStatusDiskusi($filter, $level);
		if (is_null($status)) {
			return http_response_code(400);
		}

		// Ambil semua IDPesan berdasarkan id level di tb_pemesanan
		$id_level       = $this->_getIdLevel($username, $level);
		$id_pesan       = $this->Model_diskusi->getAllIdPesan($id_level, $level);

		$this->load->helper('my_helper');
		// flattening $id_pesan menggunakan helper, tujuan: agar dapat diolah oleh Model_diskusi
		$id_pesan       = flattenArray($id_pesan);

		if ($diskusi === 'diskum')
			$jumlah_dispro  = $this->Model_diskusi->getJumlahDiskum($id_pesan, $status);
		else
			$jumlah_dispro  = $this->Model_diskusi->getJumlahDispro($id_pesan, $status);

		$jumlah_dispro  = $jumlah_dispro->jumlah;

		// Algoritma pembagian halaman (satu halaman berisi maks. 25 daftar diskum)
		$maks   = 25;
		if ($page > (($jumlah_dispro / $maks) + 1) OR $page < 0) {
			$page = 1;
		}

		$hal_selanjutnya    = $page < ($jumlah_dispro / $maks);
		$hal_sebelumnya     = $page > 1;

		$limit    = $page * $maks;
		$baris    = ($page - 1) * $maks;

		// Ambil daftar diskusi dari tb_diskusiproduk berdasarkan $id_pesan yang telah di-flatten
		if ($diskusi === 'diskum')
			$daftar_diskusi = $this->Model_diskusi->getDaftarDiskum($id_pesan, $status, $baris, $limit);
		else
			$daftar_diskusi = $this->Model_diskusi->getDaftarDispro($id_pesan, $status, $baris, $limit);

		// Cek jika $daftar_diskusi kosong beri status has_dispro=false
		// jika ada $daftar_diskusi maka beri status has_dispro=true dan masukan ke $data
		if (empty($daftar_diskusi)) {
			$data = array(
				'has_dispro'		=> FALSE,
				'level'             => $level,
				'jenis_diskusi'     => $level === 'admin' ? $diskusi : 'diskusi',
				'filter'			=> $filter,
				'page'				=> $page,
				'hal_selanjutnya'	=> $hal_selanjutnya,
				'hal_sebelumnya'	=> $hal_sebelumnya
			);
		}
		else {
			$data = array(
				'has_dispro'		=> TRUE,
				'level'             => $level,
				'jenis_diskusi'     => $level === 'admin' ? $diskusi : 'diskusi',
				'daftar_diskusi'	=> $daftar_diskusi,
				'filter'			=> $filter,
				'page'				=> $page,
				'hal_selanjutnya'	=> $hal_selanjutnya,
				'hal_sebelumnya'	=> $hal_sebelumnya
			);
		}

		$this->load->helper(array('status_helper', 'text'));
		$this->load->view('diskusi/lihatdiskusi', $data);
	}

	/**
	 * Tambah data komentar di diskum atau dispro
	 *
	 * @param    String    $diskusi    Jenis diskusi (diskum/dispro)
	 */
	public function tambahKomentar($diskusi)
	{
		$level = $this->session->level;

		if ($this->input->method() !== 'post') {
			redirect('Create/logout');
		}

		// cek isi $diskusi
		if ($diskusi === 'diskum') {
			$upload_path  = 'foto_diskum/';
			$createMethod = 'createDiskum';
			$column       = 'Foto_diskum';
		}
		elseif ($diskusi === 'dispro') {
			$upload_path  = 'foto_dispro/';
			$createMethod = 'createDispro';
			$column       = 'Foto_dispro';
		}
		else {
			return http_response_code(500);
		}

		$this->load->helper('my_helper');

		// Kembalikan IDPesan sesuai format, cth: 1 -> PS0001
		$id_pesan       = $this->input->post('np');
		$id_pesan_asli  = 'PS'.str_pad($id_pesan, 4, '0', STR_PAD_LEFT);

		// data yang akan di-insert ke tabel (tb_diskusiproduk/tb_diskusiumkm)
		$data           = array();

		// Jika tidak ada foto yang di-upload maka lewati bagian if() ini
		if($_FILES['foto-komentar']['error'] !== 4){

			$this->load->library('upload');

			$config['upload_path']   = './uploads/'.$upload_path;
			$config['allowed_types'] = 'png|jpg|jpeg';
			$config['max_size']      = '65000';

			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('foto-komentar')) {
				$alert = $this->upload->display_errors();
			}
			else {
				$data += array(
					$column => $this->upload->data('file_name')
				);
			}
		}

		// Cek apakah upload foto berhasil
		// Jika berhasil tambahkan ke database, jika tidak berhasil lempar peringatan ke halaman diskusi
		if(empty($alert)){

			$komentar       = $this->input->post('komentar');

			$now            = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
			$tanggal_waktu  = $now->format('Y-m-d H:i:s');

			$data += $this->_generateDiskusiData($diskusi, $level);

			$data += array(
				'IDPesan'       => $id_pesan_asli,
				'Komentar'      => $komentar,
				'Tanggal_waktu' => $tanggal_waktu
			);
			// var_dump($data);

			$this->load->model('Model_diskusi');
			$this->Model_diskusi->$createMethod($data);

			$redirect_segment = $level !== 'admin' ? 'diskusi' : $diskusi;

			redirect($level.'/'.$redirect_segment.'/'.$id_pesan);

		}
		else{
			$_SESSION['alert'] = $alert;
			$this->session->mark_as_flash('alert');

			$redirect_segment = $level !== 'admin' ? 'diskusi' : $diskusi;

			redirect($level.'/'.$redirect_segment.'/'.$id_pesan);
		}
	}

	/**
	 * Ambil id pengguna berdasarkan level (IDPengelola/IDDesigner/IDUMKM)
	 *
	 * @param    String    $username    Username
	 * @param    String    $level       Level (admin/designer/umkm)
	 *
	 * @return   String    $id_level    id level
	 */
	private function _getIdLevel($username, $level)
	{
		if ( ! $this->session->has_userdata('id_level')) {
			$id_level = $this->Model_diskusi->getIdLevel($username, $level);

			$this->session->id_level = $id_level->IDLevel;

			return $id_level->IDLevel;
		}

		return $this->session->id_level;
	}

	/**
	 * Ambil range status diskusi sesuai filter
	 *
	 * @param    String    $filter    Filter status (belum-selesai/semua/telah-selesai)
	 * @param    String    $level     Level (admin/designer/umkm)
	 *
	 * @return   Array                array status
	 */
	private function _getStatusDiskusi($filter, $level)
	{
		$belum_selesai = ['0', '1', '2', '3' ,'4', '5', '6'];
		$telah_selesai = ['7'];

		if ($level === 'designer') {
			array_slice($belum_selesai, 1, 4);
			array_push($telah_selesai, '5', '6');
		}

		if ($filter === 'belum-selesai') {
			return $belum_selesai;
		}
		elseif ($filter === 'semua') {
			return array_merge($belum_selesai, $telah_selesai);
		}
		elseif ($filter === 'telah-selesai') {
			return $telah_selesai;
		}
		else {
			return NULL;
		}
	}

	/**
	 * Hasilkan data yang akan dimasukan ke tabel diskusi (tb_diskusiproduk/tb_diskusiumkm)
	 *
	 * Hasilkan data array associative berisi id diskusi dan id pengirim komentar
	 *
	 * @param    String    $diskusi    Jenis diskusi (diskum/dispro)
	 * @param    String    $level      Level (admin/designer/umkm)
	 *
	 * @param    Array     $data       data tambahan yang akan dimasukan ke tabel diskusi
	 */
	private function _generateDiskusiData($diskusi, $level)
	{
		$this->load->model('Model_created');

		if ($diskusi === 'diskum') {
			$id_diskusi = $this->Model_created->idDiskum();
			$id_column  = 'IDDiskum';
		}
		else {
			$id_diskusi = $this->Model_created->idDispro();
			$id_column  = 'IDDispro';
		}

		if ($level === 'admin') {
			$sender_column = 'IDPengelola';
		}
		elseif ($level === 'designer') {
			$sender_column = 'IDDesigner';
		}
		elseif ($level === 'umkm') {
			$sender_column = 'IDUMKM';
		}

		$id_level = $this->_getIdLevel($this->session->user, $level);

		$data = array(
			$id_column => $id_diskusi,
			$sender_column => $id_level
		);

		return $data;
	}
}

