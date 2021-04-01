<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Create extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_created');
		$this->load->model('Model_cdc');
		$this->load->model('Model_admin');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->load->view('register');
	}

	public function login()
	{
		$this->load->view('login');
	}

	public function register()
	{
		$level = $this->input->post('level');
		$id    = $this->Model_created->idUser();
		$idP   = $this->Model_created->idPengelola();

		$this->form_validation->set_rules('username','Username','required|is_unique[tb_user.Username]',
			array(
			'required' => 'Username tidak boleh kosong',
			'is_unique'=> 'Username sudah ada, coba lagi'
			));

		$this->form_validation->set_rules('namalengkap','Nama Lengkap','required',
			array(
				'required' => 'Nama lengkap tidak boleh kosong',
			));

		$this->form_validation->set_rules('password','Password','required|min_length[8]',
			array(
				'required'      => '%s tidak boleh kosong',
				'min_length'    => 'Masukan password minimal 8 character',
			));

		$this->form_validation->set_rules('telp','Nomor Telp','required|min_length[10]|numeric|greater_than[0]',
			array(
				'required'    => '%s tidak boleh kosong',
				'min_length'  => '%s diisi minimal 10 angka',
				'numeric'     => '%s wajib menggunakan angka',
				'greater_than'=> '%s tidak boleh minus'
			));

		$this->form_validation->set_rules('email','Email','required|valid_email',
			array(
			'required'      => 'Email tidak boleh kosong',
			'valid_email'   => 'Harus berformat email yang valid (contoh : email@gmail.com)'
			));

		$this->form_validation->set_rules('level','Bagian','required',
			array(
			'required'      => 'Bagian harus diisi (Pengelola/UMKM/Designer/CDC Telkom)',
			));
		
		if($this->form_validation->run() == FALSE){
			$this->index();
		}
		else{
			if($level == 'Pengelola'){
				$data = array(
					'IDUser'        => $id,
					'Username'      => $this->input->post('username'),
					'Password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					'Nama_lengkap'  => $this->input->post('namalengkap'),
					'Foto'          => 'pengelola.png',
					'Email'         => $this->input->post('email'),
					'Level'         => 'Pengelola',
					'Status'        => 'Aktif'
				);

				$dataa = array(
					'IDUser'        => $id,
					'IDPengelola'   => $idP,
					'No_telp'       => $this->input->post('telp')
				);

				$cek 	= $this->Model_created->create_user($data);
				$cekk	= $this->Model_created->create_pengelola($dataa);
	
				redirect('Create/login');
			}
			else if($level == 'Designer'){
				$idD = $this->Model_created->idDesigner();
				$data = array(
					'IDUser'        => $id,
					'Username'      => $this->input->post('username'),
					'Password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					'Nama_lengkap'  => $this->input->post('namalengkap'),
					'Foto'          => 'designer.png',
					'Email'         => $this->input->post('email'),
					'Level'         => 'Designer',
					'Status'        => 'Aktif'
				);

				$dataa = array(
					'IDUser'        => $id,
					'IDDesigner'    => $idD,
					'No_telp'       => $this->input->post('telp')
				);

				$cek = $this->Model_created->create_user($data);
				$cekk = $this->Model_created->create_design($dataa);

				$d = array(
					'id' => $id
				);

				$this->load->view('registerdesigner',$d);

			}
			else if($level == 'UMKM'){
				$idU = $this->Model_created->idUMKM();

				$data = array(
					'IDUser'        => $id,
					'Username'      => $this->input->post('username'),
					'Password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					'Nama_lengkap'  => $this->input->post('namalengkap'),
					'Foto'          => 'umkm.png',
					'Email'         => $this->input->post('email'),
					'Level'         => 'UMKM',
					'Status'        => 'Aktif'
				);
				$dataa = array(
					'IDUMKM'        => $idU,
					'IDUser'        => $id,
					'No_telp'       => $this->input->post('telp')
				);

				$cek = $this->Model_created->create_user($data);
				$cekk = $this->Model_created->create_umkm($dataa);

				$d = array(
					'id' => $id
				);

				$this->load->view('registerumkm',$d);
			}
			else if($level == 'CDC Telkom'){
				$idT = $this->Model_created->idTelkom();

				$data = array(
					'IDUser'        => $id,
					'Username'      => $this->input->post('username'),
					'Password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					'Nama_lengkap'  => $this->input->post('namalengkap'),
					'Foto'          => 'cdc.png',
					'Email'         => $this->input->post('email'),
					'Level'         => 'CDC',
					'Status'        => 'Aktif'
				);

				$dataa = array(
					'IDTelkom'      => $idT,
					'IDUser'        => $id,
					'No_telp'       => $this->input->post('telp')
				);

				$cek = $this->Model_created->create_user($data);
				$cekk = $this->Model_created->create_telkom($dataa);

				$d = array(
					'id' => $id
				);

				$this->load->view('registertelkom',$d);
			}
			else{
				echo "Mohon registrasi ulang";
			}
		}
	}

	public function registerDesigner()
	{
		$id  = $this->input->post('iduser');
		$dataa = array(
			'Keterangan'	=> $this->input->post('keterangan')
		);
		$cekk	= $this->Model_created->update_design($id,$dataa);
		redirect('Create/login');
	}

	public function registerUMKM()
	{
		$id  = $this->input->post('iduser');
		$dataa = array(
			'Nama_umkm'		=> $this->input->post('namaumkm'),
			'Regional'		=> $this->input->post('regional'),
			'Alamat'			=> $this->input->post('alamat'),
		);
		$cekk	= $this->Model_created->update_umkm($id,$dataa);
		redirect('Create/login');
	}

	public function registerTelkom()
	{
		$id  = $this->input->post('iduser');
		$dataa = array(
			'Regional'		=> $this->input->post('regional')
		);
		$cekk	= $this->Model_created->update_telkom($id,$dataa);
		redirect('Create/login');
	}

	public function cekUser()
	{
		$this->form_validation->set_rules('username','Username','required',
			array(
				'required' => 'Username tidak boleh kosong',
			));

		$this->form_validation->set_rules('password','Password','required',
			array(
				'required' => 'Password tidak boleh kosong',
			));

		if($this->form_validation->run() == FALSE){
			$this->login();
		}
		else{
			$user	= $this->input->post('username');
			$pass	= $this->input->post('password');
			
			$cek	= $this->Model_created->login($user);
			
			if ( ! password_verify($pass, $cek->Password))
				$cek->Level = null;

			if( $cek->Level === 'Pengelola' ) {
				$this->session->user  = $user;
				$this->session->level = 'admin';

				$data = array(
					'akun'          => $cek,
					'umkm'          => $this->Model_admin->jumlahUMKM(),
					'designer'      => $this->Model_admin->jumlahDesigner(),
					'order'         => $this->Model_admin->jumlahOrder(),
					'pesanan'       => $this->Model_admin->jumlahOrderan(),
					'pemesanan'     => $this->Model_admin->dataPemesananPending(),
					'ongoing'       => $this->Model_admin->dataOrderOnGoing(),
					'selesai'       => $this->Model_admin->dataOrderSelesai(),
					'transaksi'     => $this->Model_admin->dataOrderTransaksi(),
					'dataumkm'      => $this->Model_admin->dataUMKMNew()
				);

				$this->load->view('admin/dashboard',$data);
			}
			elseif( $cek->Level === 'UMKM' ) {
				$this->session->user  = $user;
				$this->session->level = 'umkm';

				redirect('umkm');
			}
			elseif( $cek->Level === 'CDC' ){
				$this->session->user  = $user;
				$this->session->level = 'cdc';

				$data = array(
					'akun'          => $cek,
					'jumlahumkm'    => $this->Model_cdc->getJumlahUMKM(),
					'jumlahreq'     => $this->Model_cdc->getJumlahReq(),
					'jumlahongoing' => $this->Model_cdc->getJumlahOnGoing(),
					'jumlahselesai' => $this->Model_cdc->getJumlahSelesai(),
					'pemesanan'     => $this->Model_cdc->dataPemesanan(),
					'umkm'          => $this->Model_cdc->dataUMKM()
				);

				$this->load->view('cdc/dashboard',$data);
			}
			elseif( $cek->Level === 'Designer' ) {
				$this->session->user  = $user;
				$this->session->level = 'designer';

				redirect('designer');
			}
			else {
				$_SESSION['alert'] = '<div class="text-danger" style="text-align:center;">Username atau Password kurang tepat</div>';
				$this->session->mark_as_flash('alert');

				redirect('Create/login');
			}
		}
	}

	public function buatRequest()
	{
		if ($this->input->method() === 'get') {
			$this->load->helper('my_helper');
			$this->load->view('buatrequest');
		}
		elseif ($this->input->method() === 'post')
		{
			// TODO: test ini
			$nama_produk        = $this->input->post('nama-produk');
			$keterangan_produk  = $this->input->post('keterangan-produk');
			$keterangan_desain  = $this->input->post('keterangan-desain');

			$data_umkm          = array();
			$alert              = ['sukses','sukses','sukses'];

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

				// $this->Model_umkm->createUmkmData($data_umkm);

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

				// $this->Model_umkm->createPemesanan($data_pemesanan);

				$_SESSION['alert'] = array (
					'jenis'	=> 'alert-primary',
					'isi'	=> 'Request berhasil dibuat dan sekarang menunggu respon dari Pengelola.'
				);
				$this->session->mark_as_flash('alert');
				redirect('umkm/request');
			}
			else{
				$_SESSION['alert'] = $alert;
				$this->session->mark_as_flash('alert');
				redirect('umkm/request/buatRequest');
			}
		}
	}

	public function logout()
	{
		session_destroy();
		redirect('Create');
		// Ngga ke halaman log in aja?
	}
}
