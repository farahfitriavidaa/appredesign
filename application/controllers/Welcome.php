<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('training_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['judul']='Training Center';
		$this->form_validation->set_rules('nama_training','Training Title','required');
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('alasan','Alasan','required|max_length[250]');

		if ($this->form_validation->run() == FALSE) {
			$data['kategori']= $this->training_model->getKategori();
			$data['training']= $this->training_model->getTraining();
			$data['trainer']= $this->training_model->getTrainer();
			$this->load->view('trainee/template/header_view.php',$data);
			$this->load->view('trainee/home_view.php',$data);
			$this->load->view('trainee/template/footer_view.php');
		}else {
			$id=$this->training_model->idRequest();
			$this->training_model->tambahRequest($id);
			redirect('Welcome');
		}

	}

	public function detail($id)
	{
		$data['judul']='Detail Training';
		$data['kategori']= $this->training_model->getKategori();
		$data['detail']= $this->training_model->getTrainingById($id);
		$data['modul']= $this->training_model->getModul($id);
		$data['training']= $this->training_model->getTraining();
		$this->load->view('trainee/template/header_view.php',$data);
		$this->load->view('trainee/detailTraining_view.php',$data);
		$this->load->view('trainee/template/footer_view.php');
	}

	public function detailL($id)
	{
		$data['judul']='Detail Training';
		$data['kategori']= $this->training_model->getKategori();
		$data['detail']= $this->training_model->getTrainingById($id);
		$data['modul']= $this->training_model->getModul($id);
		$data['training']= $this->training_model->getTraining();
		$data['trainee']=$this->training_model->getTrainee();
		$data['cek']=$this->training_model->getCekTransaksi($id);
		$this->load->view('trainee/template/headerLogin_view.php',$data);
		$this->load->view('trainee/detailTrainingL_view.php',$data);
		$this->load->view('trainee/template/footer_view.php');
	}

	public function homeLogin()
	{
		$data['judul']='Training Center';
		$this->form_validation->set_rules('nama_training','Training Title','required');
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('alasan','Alasan','required|max_length[250]');

		if ($this->form_validation->run() == FALSE) {
			$data['kategori']= $this->training_model->getKategori();
			$data['training']= $this->training_model->getTraining();
			$data['trainer']= $this->training_model->getTrainer();
			$data['trainee']=$this->training_model->getTrainee();
			$this->load->view('trainee/template/headerLogin_view.php',$data);
			$this->load->view('trainee/homeL_view.php',$data);
			$this->load->view('trainee/template/footer_view.php');
		}else {

			$id=$this->training_model->idRequest();
			$this->training_model->tambahRequest($id);
			redirect('Welcome/homeLogin');
		}
	}

	public function status()
	{
		$data['judul']='Status Pembayaran';
		$data['kategori']= $this->training_model->getKategori();
		$data['training']= $this->training_model->getTraining();
		$data['trainee']=$this->training_model->getTrainee();
		$data['transaksi']=$this->training_model->getTransaksi();
		$this->load->view('trainee/template/headerLogin_view.php',$data);
		$this->load->view('trainee/status_view.php',$data);
		$this->load->view('trainee/template/footer_view.php');
	}

	public function follow()
	{
		$data['judul']='Training yang diikuti';
		$data['kategori']= $this->training_model->getKategori();
		$data['trainee']=$this->training_model->getTrainee();
		$data['follow']=$this->training_model->getFollow();
		$data['cek']= $this->training_model->getCekFollow();
		$this->load->view('trainee/template/headerLogin_view.php',$data);
		$this->load->view('trainee/follow_view.php',$data);
		$this->load->view('trainee/template/footer_view.php');
	}

	public function detailFollow($id)
	{
		$data['judul']='Detail Training';
 	 $data['kategori']= $this->training_model->getKategori();
 	 $data['trainee']=$this->training_model->getTrainee();
	 $data['detail']= $this->training_model->getTrainingById($id);
	 $data['modul']= $this->training_model->getModul($id);
	 $data['presensi']= $this->training_model->getPresensi($id);
 	 $data['dfollow']=$this->training_model->getDetailFollow($id);
 	 $this->load->view('trainee/template/headerLogin_view.php',$data);
 	 $this->load->view('trainee/detailFollow_view.php',$data);
 	 $this->load->view('trainee/template/footer_view.php');
	}

	public function detailConfirm($id)
	{
		$data['judul']='Detail Pembayaran';
 	 $data['kategori']= $this->training_model->getKategori();
	 $data['trainee']=$this->training_model->getTrainee();
 	 $data['confirm']=$this->training_model->getConfirm($id);
 	 $this->load->view('trainee/template/headerLogin_view.php',$data);
 	 $this->load->view('trainee/detailConfirm_view.php',$data);
 	 $this->load->view('trainee/template/footer_view.php');
	}

	public function confirm($id)
	{
		$data['judul']='Konfirmasi Pembayaran';
 	 $data['kategori']= $this->training_model->getKategori();
	 $data['trainee']=$this->training_model->getTrainee();
 	 $data['confirm']=$this->training_model->getConfirm($id);
 	 $this->load->view('trainee/template/headerLogin_view.php',$data);
 	 $this->load->view('trainee/confirm_view.php',$data);
 	 $this->load->view('trainee/template/footer_view.php');
	}

	public function konfirmasiPembayaran($id)
	{
		$config['upload_path'] = "./uploads/foto_bukti/";
		$config['allowed_types'] = "gif|jpg|png";
		$config['max_size'] = 2000;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload',$config);

		if ($this->upload->do_upload('bukti_pembayaran')) {
		$foto = $this->upload->data();
		$data = array(
				'tgl_pembayaran' => $this->input->post('tgl_pembayaran'),
				'status_pembayaran' => 'pending',
				'bukti_pembayaran' => $foto['file_name']
			);
		$this->training_model->konfirmasiPembayaran($id,$data);
		redirect('Welcome/status');
	}
	}

}
