<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		if( !$this->session->has_userdata('user') || $this->session->level!=='designer' ){
			session_destroy();
			redirect('Create/login');
		}

		$this->load->model('Model_designer');
    }

	/**
	 * Menampilkan detel request/pemesanan
	 * 
	 * re-mapped: base_url()/designer/request/(:num)  
	 */
	public function index($id_pesan='0')
	{
		if ($id_pesan==='0') {
			return http_response_code(400);
		}

		$id_pesan		= 'PS'.str_pad($id_pesan, 4, '0', STR_PAD_LEFT);
		$detil_request	= $this->Model_designer->getRequest($id_pesan, $this->session->id_designer);

		if(is_null($detil_request)){
			$data = array(
				'detil_request'	=> null
			);

			$_SESSION['alert'] = 'Data request tidak ditemukan';
			$this->session->mark_as_flash('alert');
			redirect('designer/request/lihatRequest');
		}

		$data			= array(
			'request'	=> $detil_request
		);

		// print_r($data);
		$this->load->helper(array('my_helper', 'status_helper'));
		$this->load->view('designer/request', $data);
	}

    public function lihatRequest()
	{
		$id_designer	= $this->session->id_designer;
		$daftar_request	= $this->Model_designer->getAllRequest($id_designer);

		if( empty($daftar_request) ) {
			$data = array(
				'has_request' => false
			);
		}
		else {
			$data = array(
				'has_request'		=> true,
				'daftar_request'	=> $daftar_request,
			);
		}

		$this->load->helper(array('my_helper', 'status_helper'));
		$this->load->view('designer/lihatrequest', $data);
	}

	public function uploadDesain()
	{
		if ($this->input->method()!=="post") {
			return http_response_code(400);
		}

		$this->load->helper('my_helper');
		$id_designer	= trimId('DG',$this->session->id_designer);

		$id_pesan		= $this->input->post('np');
		$id_pesan_asli	= 'PS'.str_pad($id_pesan, 4, '0', STR_PAD_LEFT);

		$status			= $this->Model_designer->getStatusRequest($id_pesan_asli, $this->session->id_designer);

		if (is_null($status)) {
			$_SESSION['alert'] = array(
				'jenis'		=> 'alert-danger',
				'isi'		=> 'Gagal mengunggah file'
			);
			$this->session->mark_as_flash('alert');

			redirect('designer/request/'.$id_pesan);
		}

		$files			= $_FILES['hasil-design'];
		$jumlah_file	= count($files['name']);
		$upload			= true;
		$file_terunggah	= '';

		$this->load->library('upload');
		for ($i=0; $i < $jumlah_file; $i++) {
			$config['allowed_types']	= 'jpg|png';
			$config['max_size']			= 32000;
			$config['overwrite']		= TRUE;

			if ($status<=3) {
				$config['upload_path']		= './uploads/hasil_design/';
				$config['file_name']	  	= 'H_'.($id_pesan+16).($id_pesan*$id_designer).($id_designer+4).$i;
			}
			else {
				$config['upload_path']		= './uploads/revisi_design/';
				$config['file_name']	  	= 'R_'.($id_pesan+16).($id_pesan*$id_designer).($id_designer+4).$i;
			}

			$this->upload->initialize($config);

			$_FILES['file']['name']		= $files['name'][$i];
			$_FILES['file']['type']		= $files['type'][$i];
			$_FILES['file']['tmp_name']	= $files['tmp_name'][$i];
			$_FILES['file']['error']	= $files['error'][$i];
			$_FILES['file']['size']		= $files['size'][$i];

			if ( ! $this->upload->do_upload('file')) {
				$isi_pesan	= $this->upload->display_errors();

				$_SESSION['alert'] = array(
					'jenis'		=> 'alert-danger',
					'isi'		=> $isi_pesan
				);
				$upload = false;
				break;
			}
			else {
				$komah=$i==$jumlah_file-1?'':',';
				$file_terunggah .= $this->upload->data('file_name').$komah;
			}
		}

		if ($upload) {
			if ($status<=3) {

				$this->Model_designer->uploadDesain($file_terunggah, $id_pesan_asli);
				$this->Model_designer->updateStatus('3', $id_pesan_asli);

				$_SESSION['alert'] = array(
					'jenis'		=> 'alert-primary',
					'isi'		=> 'Berhasil mengunggah hasil desain'
				);
			} else {

				$this->Model_designer->uploadRevisi($file_terunggah, $id_pesan_asli);

				$_SESSION['alert'] = array(
					'jenis'		=> 'alert-primary',
					'isi'		=> 'Berhasil mengunggah revisi'
				);
			}
		}

		$this->session->mark_as_flash('alert');
		redirect('designer/request/'.$id_pesan);
	}

	public function hapusDesain($id_pesan='0')
	{
		if ($id_pesan==='0') {
			return http_response_code(400);
		}

		$id_pesan_asli	= 'PS'.str_pad($id_pesan, 4, '0', STR_PAD_LEFT);
		$id_designer	= $this->session->id_designer;

		$status			= $this->Model_designer->getStatusRequest($id_pesan_asli, $id_designer);

		if($status>3) {
			$_SESSION['alert'] = array (
				'jenis'	=> 'alert-danger',
				'isi'	=> 'Hasil desain tidak bisa dihapus karena desain masih di-review atau sudah disetujui'
			);

			$this->session->mark_as_flash('alert');
			redirect('designer/request/'.$id_pesan);
		}

		$hapus			= $this->Model_designer->deleteDesain($id_pesan_asli, $id_designer);

		if (!$hapus) {
			$_SESSION['alert'] = 'Gagal menghapus hasil desain';

			$this->session->mark_as_flash('alert');
			redirect('designer/request/lihatRequest');
		}
		else {
			$_SESSION['alert'] = array (
				'jenis'	=> 'alert-primary',
				'isi'	=> 'Hasil desain berhasil dihapus'
			);

			$this->Model_designer->updateStatus('2', $id_pesan_asli);


			$this->session->mark_as_flash('alert');
			redirect('designer/request/'.$id_pesan);
		}
	}

	public function hapusRevisi($id_pesan='0')
	{
		if ($id_pesan==='0') {
			return http_response_code(400);
		}

		$id_pesan_asli	= 'PS'.str_pad($id_pesan, 4, '0', STR_PAD_LEFT);
		$id_designer	= $this->session->id_designer;

		$status			= $this->Model_designer->getStatusRequest($id_pesan_asli, $id_designer);

		if($status>5) {
			$_SESSION['alert'] = array (
				'jenis'	=> 'alert-danger',
				'isi'	=> 'Revisi tidak bisa dihapus karena desain sudah disetujui'
			);

			$this->session->mark_as_flash('alert');
			redirect('designer/request/'.$id_pesan);
		}

		$hapus			= $this->Model_designer->deleteRevisi($id_pesan_asli, $id_designer);

		if (!$hapus) {
			$_SESSION['alert'] = 'Gagal menghapus revisi';

			$this->session->mark_as_flash('alert');
			redirect('designer/request/lihatRequest');
		}
		else {
			$_SESSION['alert'] = array (
				'jenis'	=> 'alert-primary',
				'isi'	=> 'Revisi berhasil dihapus'
			);

			$this->session->mark_as_flash('alert');
			redirect('designer/request/'.$id_pesan);
		}


	}
}