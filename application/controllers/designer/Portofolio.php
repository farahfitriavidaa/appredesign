<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portofolio extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		if( !$this->session->has_userdata('user') || $this->session->level!=='designer' ){
			session_destroy();
			redirect('Create/login');
		}

		$this->load->model('Model_designer');
    }

    public function index()
	{
		$id_designer		= $this->session->id_designer;
		$daftar_portofolio	= $this->Model_designer->getDaftarPortofolio($id_designer);
		$detil_designer		= $this->Model_designer->getSimpleDesigner($id_designer);

		$data				= array(
			'designer'			=> $detil_designer,
			'daftar_portofolio'	=> $daftar_portofolio
		);

		$this->load->helper('my_helper');
		$this->load->view('designer/lihatportofolio', $data);
	}

	public function buatPortofolio()
	{
		$this->load->view('designer/buatportofolio');
	}

	public function tambahPortofolio()
	{
		if ($this->input->method()!=='post') {
			redirect('designer');
		}

		$judul	= $this->input->post('judul-portofolio');
		$detil	= $this->input->post('detil-portofolio');
		$bukti	= '';

		if ( isset($_FILES['bukti-portofolio']) && $_FILES['bukti-portofolio']['error'] != 4 ) {

			$this->load->library('upload');

			$config['upload_path']		= './uploads/bukti_portofolio/';
			$config['allowed_types']	= 'png|jpg|jpeg';
			$config['max_size']			= '65000';

			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('bukti-portofolio') ) {
				$isi_pesan	= $this->upload->display_errors().
					'<span>Allowed filetype: png or jpg.</span>';

				$_SESSION['alert'] = $isi_pesan;
				$this->session->mark_as_flash('alert');

				redirect('designer/portofolio/buatPortofolio');
			}
			else {
				$bukti	= $this->upload->data('file_name');
			}
		}
		else {
			$bukti	= $this->input->post('link-portofolio');
		}
		
		$this->load->model('Model_created');

		$data	= array(
			'IDPortofolio'		=> $this->Model_created->idPortofolio(),
			'IDDesigner'		=> $this->session->id_designer,
			'Judul'			 	=> $judul,
			'Bukti_portofolio'	=> $bukti,
			'Detail_portofolio'	=> $detil
		);

		$this->Model_designer->createPortofolio($data);

		$_SESSION['alert'] = array (
			'jenis'	=> 'alert-primary',
			'isi'	=> 'Portofolio berhasil dibuat'
		);
		$this->session->mark_as_flash('alert');
		redirect('designer/portofolio');
	}

	public function editPortofolio($id_portofolio='0')
	{
		if ($id_portofolio=='0') {
			return http_response_code('400');
		}

		$id_prt_asli		= 'PRT'.str_pad($id_portofolio, 4, '0', STR_PAD_LEFT);
		$id_designer		= $this->session->id_designer;

		$data_portofolio	= $this->Model_designer->getPortofolio($id_designer, $id_prt_asli);

		if (is_null($data_portofolio)) {
			$_SESSION['alert'] = array(
				'jenis' => 'alert-danger',
				'isi'	=> 'Portofolio tidak diketahui.'
			);
			$this->session->mark_as_flash('alert');

			redirect('designer/portofolio');
		}

        $this->load->helper('my_helper');
		$bukti				= cekPortofolio($data_portofolio->Bukti_portofolio);

		$data				= array(
			'id_portofolio'	=> $id_portofolio,
			'bukti'			=> $bukti,
			'portofolio'	=> $data_portofolio
		);

		$this->load->view('designer/editportofolio', $data);
	}

	public function updatePortofolio()
	{
		if ($this->input->method()!=='post') {
			redirect('designer');
		}

		$id_prt_asli		= $this->input->post('np');
		$id_portofolio		= 'PRT'.str_pad($id_prt_asli, 4, '0', STR_PAD_LEFT);
		$id_designer		= $this->session->id_designer;

		$data_portofolio	= $this->Model_designer->getPortofolio($id_designer, $id_portofolio);

		if (is_null($data_portofolio)) {
			$_SESSION['alert'] = array(
				'jenis' => 'alert-danger',
				'isi'	=> 'Portofolio tidak diketahui.'
			);
			$this->session->mark_as_flash('alert');

			redirect('designer/portofolio');
		}

		$judul	= $this->input->post('judul-portofolio');
		$detil	= $this->input->post('detil-portofolio');
		$link	= $this->input->post('link-portofolio');
		$bukti	= '';

		if ( isset($_FILES['bukti-portofolio']) && $_FILES['bukti-portofolio']['error'] != 4 ) {
			
			$this->load->library('upload');

			$config['upload_path']		= './uploads/bukti_portofolio/';
			$config['allowed_types']	= 'png|jpg|jpeg';
			$config['max_size']			= '65000';

			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('bukti-portofolio') ) {
				$isi_pesan	= $this->upload->display_errors().
					'<span>Allowed filetype: png or jpg.</span>';

				$_SESSION['alert'] = $isi_pesan;
				$this->session->mark_as_flash('alert');
				
				redirect('designer/portofolio/editPortofolio/'.$id_prt_asli);
			}
			else {
				$bukti	= $this->upload->data('file_name');
			}
		}
		elseif ( ! empty($link) ) {
			$bukti	= $link;
		}
		
		$data	= array(
			'Judul'			 	=> $judul,
			'Detail_portofolio'	=> $detil
		);

		if ( $bukti !== '' ) {
			$data	+= array(
				'Bukti_portofolio'	=> $bukti
			);
		}

		$this->Model_designer->updatePortofolio($id_portofolio, $data);

		$_SESSION['alert'] = array (
			'jenis'	=> 'alert-primary',
			'isi'	=> 'Portofolio berhasil diubah'
		);
		$this->session->mark_as_flash('alert');
		redirect('designer/portofolio');

	}

	public function hapusPortofolio($id_portofolio='0')
	{
		if($id_portofolio==='0'){
			return http_response_code('400');
		}

		$id_prt_asli	= 'PRT'.str_pad($id_portofolio, 4, '0', STR_PAD_LEFT);
		$id_designer		= $this->session->id_designer;

		$data_portofolio	= $this->Model_designer->getPortofolio($id_designer, $id_prt_asli);

		if (is_null($data_portofolio)) {
			$_SESSION['alert'] = array(
				'jenis' => 'alert-danger',
				'isi'	=> 'Portofolio tidak diketahui.'
			);
			$this->session->mark_as_flash('alert');

			redirect('designer/portofolio');
		}

		$this->Model_designer->deletePortofolio($id_prt_asli);

		$_SESSION['alert'] = array (
			'jenis'	=> 'alert-primary',
			'isi'	=> 'Portofolio berhasil dihapus'
		);
		$this->session->mark_as_flash('alert');
		redirect('designer/portofolio');

	}
}