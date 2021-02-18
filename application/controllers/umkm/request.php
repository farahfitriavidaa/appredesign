<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		if( !$this->session->has_userdata('user') || $this->session->level!=='umkm' ){
			session_destroy();
			redirect('Create/login');
		}

		$this->load->model('Model_umkm');
	}

	public function index()
	{
		$this->load->helper('my_helper');

		$id_umkm		= $this->session->id_umkm;
		$id_data_umkm	= $this->Model_umkm->getAllIdDataUMKM($id_umkm);

		if (empty($id_data_umkm)) {
			$id_data_umkm = '';
		} else {
			$id_data_umkm	= flattenArray($id_data_umkm);
		}


		$daftar_request	= $this->Model_umkm->getDaftarRequest($id_data_umkm);
		$daftar_produk	= $this->Model_umkm->getDaftarProduk($id_data_umkm);

		if( empty($daftar_request) ) {
			$data = array(
				'has_request' => false
			);
		}
		else {
			$data = array(
				'has_request'	=> true,
				'requests'		=> $daftar_request,
				'produks'		=> $daftar_produk
			);
		}

		$this->load->helper('status_helper');
		$this->load->view('umkm/lihatrequest', $data);
	}

	public function buatRequest()
	{
		$desainer	= $this->Model_umkm->getDaftarDesainer();

		$data		= array(
			'desainers' => $desainer
		);

		$this->load->helper('my_helper');
		$this->load->view('umkm/buatrequest', $data);
	}

	public function tambahRequest()
	{
		if($this->input->method() == 'post') {
			$nama_produk		= $this->input->post('nama-produk');
			$keterangan_produk	= $this->input->post('keterangan-produk');
			$keterangan_desain	= $this->input->post('keterangan-desain');

			$data_umkm			= array();
			$alert				= ['sukses','sukses','sukses'];

			$this->load->helper('my_helper');
			$this->load->library('upload');

			if( $_FILES['foto-produk']['error'] != 4 ) {
				$config['upload_path']		= './uploads/foto_produk/';
				$config['allowed_types']	= 'png|jpg|jpeg';
				$config['max_size']			= '32000';

				$this->upload->initialize($config);

				if ( ! $this->upload->do_upload('foto-produk') ) {
					$alert[0]	= $this->upload->display_errors('<span>', '</span>').
						' ('.$this->upload->data('file_name').')';
				}
				else {
					$data_umkm	+= array(
						'Foto_produk' => $this->upload->data('file_name')
					);
				}
			}

			if( $_FILES['logo-produk']['error'] != 4 ) {
				$config['upload_path']		= './uploads/logo_produk/';
				$config['allowed_types']	= 'png|jpg|jpeg';
				$config['max_size']			= '32000';

				$this->upload->initialize($config);

				if ( ! $this->upload->do_upload('logo-produk') ) {
					$alert[1]	= $this->upload->display_errors('<span>', '</span>').
						' ('.$this->upload->data('file_name').')';
				}
				else {
					$data_umkm	+= array(
						'Logo_produk' => $this->upload->data('file_name')
					);
				}
			}

			if( $_FILES['kemasan-produk']['error'] != 4 ) {
				/*
				$config['upload_path']		= './uploads/foto_kemasan_lama/';
				$config['allowed_types']	= 'png|jpg|jpeg';
				$config['max_size']			= '65000';

				$this->upload->initialize($config);

				if ( ! $this->upload->do_upload('kemasan-produk') ) {
					$alert[2]	= $this->upload->display_errors('<span>', '</span>').
						' ('.$this->upload->data('file_name').')';
				}
				else {
					$data_umkm	+= array(
						'Kemasan_produk' => $this->upload->data('file_name')
					);
				}
				*/

				$files			= $_FILES['kemasan-produk'];
				$jumlah_file	= count($files['name']);
				$upload			= true;
				$foto_kemasan_lama	= '';

				for ($i = 0; $i < $jumlah_file; ++$i) {
					$config['upload_path']		= './uploads/foto_kemasan_lama/';
					$config['allowed_types']	= 'png|jpg|jpeg';
					$config['max_size']			= '65000';
		
					$this->upload->initialize($config);
		
					$_FILES['file']['name']		= $files['name'][$i];
					$_FILES['file']['type']		= $files['type'][$i];
					$_FILES['file']['tmp_name']	= $files['tmp_name'][$i];
					$_FILES['file']['error']	= $files['error'][$i];
					$_FILES['file']['size']		= $files['size'][$i];
		
					if ( ! $this->upload->do_upload('file')) {

						$alert[2]	= $this->upload->display_errors('<span>', '</span>').
						' ('.$this->upload->data('file_name').')';

						$upload = false;
						break;
					}
					else {
						$komah = $i == $jumlah_file-1 ? '' : ',';
						$foto_kemasan_lama .= $this->upload->data('file_name').$komah;
					}
				}

				if ($upload) {
					$data_umkm	+= array(
						'Kemasan_produk' => $foto_kemasan_lama
					);
				}
			}

			if( $alert[0]==='sukses' && $alert[1]==='sukses' && $alert[2]==='sukses'){

				$this->load->model('Model_created');

				$id_data_umkm		= $this->Model_created->idDataUMKM();
				$id_umkm			= $this->session->id_umkm;

				$data_umkm		+= array(
					'IDDataUMKM'		=> $id_data_umkm,
					'IDUMKM'			=> $id_umkm,
					'Nama_produk'		=> $nama_produk,
					'Keterangan'		=> $keterangan_produk
				);

				$this->Model_umkm->createUmkmData($data_umkm);

				$id_pesan		= $this->Model_created->idPesan();
				$id_designer	= $this->input->post('desainer');
				$id_designer	= $id_designer==='0'?NULL:'DG'.str_pad($id_designer, 4, '0', STR_PAD_LEFT);
				$status			= '0';
				$tanggal_order	= date('Y-m-d');

				$data_pemesanan	= array(
					'IDPesan'			=> $id_pesan,
					'IDDataUMKM'		=> $id_data_umkm,
					'IDDesigner'		=> $id_designer,
					'Status'			=> $status,
					'Keterangan_design'	=> $keterangan_desain,
					'Tgl_order'			=> $tanggal_order
				);

				$this->Model_umkm->createPemesanan($data_pemesanan);

				$_SESSION['alert'] = array (
					'jenis'	=> 'alert-primary',
					'isi'	=> 'Request berhasil dibuat dan sekarang menunggu respon dari Pengelola.'
				);
				$this->session->mark_as_flash('alert');
				redirect('umkm/request');


				// var_dump($data_umkm);
				// var_dump($data_pemesanan);
				// print_r($alert);
			}
			else{
				$_SESSION['alert'] = $alert;
				$this->session->mark_as_flash('alert');
				redirect('umkm/request/buatRequest');
			}
		}
		else
			redirect('umkm/request/buatRequest');
	}

	public function detilRequest($id_pesan='0')
	{
		if ($id_pesan!=='0') {
			$id_pesan		= 'PS'.str_pad($id_pesan, 4, '0', STR_PAD_LEFT);
			$id_umkm		= $this->session->id_umkm;

			$detil_request	= $this->Model_umkm->getRequest($id_umkm, $id_pesan);

			if(is_null($detil_request)) {
				$_SESSION['alert'] = array(
					'jenis' => 'alert-danger',
					'isi'	=> 'Request tidak diketahui.'
				);
				$this->session->mark_as_flash('alert');

				redirect('umkm/request');
			}// else {

			$id_data_umkm	= $detil_request->IDDataUMKM;
			$data_produk	= $this->Model_umkm->getUmkmData($id_data_umkm);

			$data_desainer	= array();
			if(is_null($detil_request->IDDesigner)){
				$data_desainer['desainer']	= 'Ditentukan Pengelola';
				$data_desainer['ada']		= FALSE;
			}
			else{
				$desainer 					= $this->Model_umkm->getNamaDesainer($detil_request->IDDesigner);
				$data_desainer['desainer']	= $desainer->Nama_lengkap;
				$data_desainer['ada']		= TRUE;
			}

			$data			= array(
				'detil_request'	=> $detil_request,
				'data_produk'	=> $data_produk,
				'desainer'		=> $data_desainer
			);

			$this->load->helper( array('my_helper', 'status_helper') );
			$this->load->view('umkm/detilrequest', $data);
			//} // end of else
		} else {
			http_response_code('400');
		}
	}

	public function editRequest( $id_pesan='0' )
	{
		if ($id_pesan!=='0') {
			$id_pesan		= 'PS'.str_pad($id_pesan, 4, '0', STR_PAD_LEFT);
			$id_umkm		= $this->session->id_umkm;

			$detil_request	= $this->Model_umkm->getRequest($id_umkm, $id_pesan);

			if(is_null($detil_request)) {
				$_SESSION['alert'] = array(
					'jenis' => 'alert-danger',
					'isi'	=> 'Request tidak diketahui.'
				);
				$this->session->mark_as_flash('alert');

				redirect('umkm/request');
			}// else {

			$id_data_umkm	= $detil_request->IDDataUMKM;
			$data_produk	= $this->Model_umkm->getUmkmData($id_data_umkm);

			$data			= array(
				'detil_request'	=> $detil_request,
				'data_produk'	=> $data_produk
			);

			$this->load->helper('my_helper');
			$this->load->view('umkm/editrequest', $data);
			//} // end of else
		} else {
			http_response_code('400');
		}
	}

	public function updateRequest()
	{
		if($this->input->method() == 'post') {
			$id_pesan			= 'PS'.str_pad($this->input->post('np'), 4, '0', STR_PAD_LEFT);
			$id_umkm			= $this->session->id_umkm;

			$cekUmkmdanRequest	= $this->Model_umkm->cekUmkmdanRequest($id_umkm, $id_pesan);

			if(is_null($cekUmkmdanRequest)) {
				$_SESSION['alert'] = array(
					'jenis' => 'alert-danger',
					'isi'	=> 'Gagal mengedit request. Request tidak diketahui.'
				);
				$this->session->mark_as_flash('alert');

				redirect('Umkm/lihatRequest');
			} // else {

			$nama_produk		= $this->input->post('nama-produk');
			$keterangan_produk	= $this->input->post('keterangan-produk');
			$keterangan_desain	= $this->input->post('keterangan-desain');

			$data_umkm			= array();
			$alert				= ['sukses','sukses','sukses'];

			$this->load->helper('my_helper');
			$this->load->library('upload');

			if( $_FILES['foto-produk']['error'] != 4 ){
				$config['upload_path']		= './uploads/foto_produk/';
				$config['allowed_types']	= 'png|jpg|jpeg';
				$config['max_size']			= '65000';

				$this->upload->initialize($config);

				if ( ! $this->upload->do_upload('foto-produk') ) {
					$alert[0]	= $this->upload->display_errors('<span>', '</span>').
						' ('.$this->upload->data('file_name').')';
				}
				else {
					$data_umkm	+= array(
						'Foto_produk' => $this->upload->data('file_name')
					);
				}
			}
			if( $_FILES['logo-produk']['error'] != 4 ){
				$config['upload_path']		= './uploads/logo_produk/';
				$config['allowed_types']	= 'png|jpg|jpeg';
				$config['max_size']			= '65000';

				$this->upload->initialize($config);

				if ( ! $this->upload->do_upload('logo-produk') ) {
					$alert[1]	= $this->upload->display_errors('<span>', '</span>').
						' ('.$this->upload->data('file_name').')';
				}
				else {
					$data_umkm	+= array(
						'Logo_produk' => $this->upload->data('file_name')
					);
				}
			}
			if( $_FILES['kemasan-produk']['error'] != 4 ){
				$files			= $_FILES['kemasan-produk'];
				$jumlah_file	= count($files['name']);
				$upload			= true;
				$foto_kemasan_lama	= '';

				for ($i = 0; $i < $jumlah_file; ++$i) {
					$config['upload_path']		= './uploads/foto_kemasan_lama/';
					$config['allowed_types']	= 'png|jpg|jpeg';
					$config['max_size']			= '65000';
		
					$this->upload->initialize($config);
		
					$_FILES['file']['name']		= $files['name'][$i];
					$_FILES['file']['type']		= $files['type'][$i];
					$_FILES['file']['tmp_name']	= $files['tmp_name'][$i];
					$_FILES['file']['error']	= $files['error'][$i];
					$_FILES['file']['size']		= $files['size'][$i];
		
					if ( ! $this->upload->do_upload('file')) {

						$alert[2]	= $this->upload->display_errors('<span>', '</span>').
						' ('.$this->upload->data('file_name').')';

						$upload = false;
						break;
					}
					else {
						$komah = $i == $jumlah_file-1 ? '' : ',';
						$foto_kemasan_lama .= $this->upload->data('file_name').$komah;
					}
				}

				if ($upload) {
					$data_umkm	+= array(
						'Kemasan_produk' => $foto_kemasan_lama
					);
				}
			}


			if( $alert[0]==='sukses' && $alert[1]==='sukses' && $alert[2]==='sukses'){

				$id_data_umkm		= $this->Model_umkm->getIdDataUmkmFromIdPesan($id_pesan);

				$data_umkm		+= array(
					'Nama_produk'		=> $nama_produk,
					'Keterangan'		=> $keterangan_produk
				);

				$this->Model_umkm->updateUmkmData($id_data_umkm->IDDataUMKM, $data_umkm);

				$data_pemesanan	= array(
					'Keterangan_design'	=> $keterangan_desain
				);

				$this->Model_umkm->updatePemesanan($id_pesan, $data_pemesanan);

				$_SESSION['alert'] = array (
					'jenis'	=> 'alert-primary',
					'isi'	=> 'Request berhasil diubah.'
				);
				$this->session->mark_as_flash('alert');
				redirect('umkm/request');
			}
			else{
				$_SESSION['alert'] = $alert;
				$this->session->mark_as_flash('alert');
				redirect('umkm/request/editRequest/'.$this->input->post('np'));
			}
			//} // end of else
		}
		else
			redirect('umkm');
	}

	public function hapusRequest($id_pesan='0')
	{
		if ($id_pesan!=='0') {
			$id_pesan		= 'PS'.str_pad($id_pesan, 4, '0', STR_PAD_LEFT);
			$id_umkm		= $this->session->id_umkm;

			$detil_request	= $this->Model_umkm->getRequest($id_umkm, $id_pesan);

			if(is_null($detil_request)) {
				$_SESSION['alert'] = array(
					'jenis' => 'alert-danger',
					'isi'	=> 'Request tidak diketahui.'
				);
				$this->session->mark_as_flash('alert');

				redirect('umkm/request');
			}// else {

			if($detil_request->Status == 0){
				$id_data_umkm	= $this->Model_umkm->getIdDataUmkmFromIdPesan($id_pesan);

				$this->Model_umkm->deleteRequest($id_pesan);
				$this->Model_umkm->deleteUmkmData($id_data_umkm->IDDataUMKM);

				$_SESSION['alert'] = array (
					'jenis'	=> 'alert-primary',
					'isi'	=> 'Request berhasil dihapus'
				);
				$this->session->mark_as_flash('alert');
				redirect('umkm/request');
			}
			else{
				$_SESSION['alert'] = array (
					'jenis'	=> 'alert-danger',
					'isi'	=> 'Request tidak bisa dihapus. Diskusikan dengan Pengelola untuk membatalkan request.'
				);
				$this->session->mark_as_flash('alert');
				redirect('umkm/request');
			}
			//} // end of else
		} else {
			http_response_code('400');
		}
	}

	public function lihatPortofolio($id_designer='0')
	{
		if($id_designer==='0') {
			redirect('umkm');
		}

		$id_designer_asli	= 'DG'.str_pad($id_designer, 4, '0', STR_PAD_LEFT);

		$this->load->model('Model_designer');
		$daftar_portofolio	= $this->Model_designer->getDaftarPortofolio($id_designer_asli);
		$daftar_designer	= $this->Model_umkm->getDaftarDesainer();
		$data_designer		= $this->Model_umkm->getDesainer($id_designer_asli);

		$data				= array(
			'designer'			=> $data_designer,
			'daftar_portofolio'	=> $daftar_portofolio,
			'daftar_designer'	=> $daftar_designer
		);

		$this->load->helper('my_helper');
		$this->load->view('umkm/lihatportofolio', $data);
	}
}