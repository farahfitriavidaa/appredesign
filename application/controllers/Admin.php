<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_created');
		$this->load->model('Model_admin');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$cek = $this->Model_admin->cekAkun($this->session->user);
		$data = array(
			'akun' 				=> $cek,
			'umkm'				=> $this->Model_admin->jumlahUMKM(),
			'designer'		=> $this->Model_admin->jumlahDesigner(),
			'order'				=> $this->Model_admin->jumlahOrder(),
			'pesanan'			=> $this->Model_admin->jumlahOrderan(),
			'pemesanan'		=> $this->Model_admin->dataPemesananPending(),
			'ongoing'			=> $this->Model_admin->dataOrderOnGoing(),
			'selesai'			=> $this->Model_admin->dataOrderSelesai(),
			'transaksi'		=> $this->Model_admin->dataOrderTransaksi(),
			'dataumkm'		=> $this->Model_admin->dataUMKMNew()
		);
		$this->load->view('admin/dashboard',$data);
	}

	public function kelolaProfil()
	{
		$cek = $this->Model_admin->cekAkun($this->session->user);
		$data = array(
			'akun' => $cek,
		);
		$this->load->view('admin/Kelolaprofil',$data);
	}

	public function editProfil($id)
	{
		$this->form_validation->set_rules('nama_lengkap','Nama Lengkap','required',
		array(
			'required' => 'Nama lengkap tidak boleh kosong',
		));
		$this->form_validation->set_rules('password','Password','required|min_length[8]',
		array(
			'required'      => '%s tidak boleh kosong',
			'min_length'    => 'Masukan password minimal 8 character',
		));
		$this->form_validation->set_rules('no_telp','Nomor Telp','required|min_length[10]|numeric|greater_than[0]',
		array(
			'required'    => '%s tidak boleh kosong',
			'min_length'  => '%s diisi minimal 10angka',
			'numeric'     => '%s wajib menggunakan angka',
			'greater_than'=> '%s tidak boleh minus'
		));
		$this->form_validation->set_rules('email','Email','required|valid_email',
		array(
		'required'      => 'Email tidak boleh kosong',
		'valid_email'   => 'Harus berformat email yang valid (contoh : email@gmail.com)'
		));
		if($this->form_validation->run() == FALSE){
			$this->kelolaProfil();
		}else{
		$cek = $this->Model_admin->cekAkun($this->session->user);
		$email    = $this->input->post('email');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$nama     = $this->input->post('nama_lengkap');
		$regional = $this->input->post('regional');
		$notelp   = $this->input->post('no_telp');

		$config['upload_path'] = "./uploads/foto_user";
		$config['allowed_types'] = "gif|jpg|png";
		$config['max_size'] = 2000;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload',$config);

		if ($password == $cek->Password) {
			if ($this->upload->do_upload('fotoprofil')) {
				$foto = $this->upload->data();
			$data   = array(
				'Nama_lengkap'  => $nama,
				'Email'         => $email,
				'Foto'          => $foto['file_name']
			);
			$dataa  = array(
				'No_telp'       => $notelp
			);
		}else{
			$data   = array(
				'Nama_lengkap'  => $nama,
				'Email'         => $email,
			);
			$dataa  = array(
				'No_telp'       => $notelp
			);
		}
		}else{
			if ($this->upload->do_upload('fotoprofil')) {
				$foto = $this->upload->data();
			$data   = array(
				'Password'      => md5($password),
				'Nama_lengkap'  => $nama,
				'Email'         => $email,
				'Foto'          => $foto['file_name']
			);
			$dataa  = array(
				'No_telp'       => $notelp
			);
		}else{
			$data   = array(
				'Password'      => md5($password),
				'Nama_lengkap'  => $nama,
				'Email'         => $email
			);
			$dataa  = array(
				'No_telp'       => $notelp
			);
			}
		}
		$updateprofil   = $this->Model_admin->update_profil($id,$data);
		$updateprofil2  = $this->Model_admin->update_profil2($id,$dataa);
		redirect('Admin/kelolaProfil');
	}
	}

	public function kelolaAkun()
	{
		$cek = $this->Model_admin->cekAkun($this->session->user);
		$data = array(
			'akun'			 => $cek,
			'pengelola'	 => $this->Model_admin->getPengelola()
		);
		$this->load->view('admin/kelolaakun',$data);
	}

	public function kelolaTelkom()
	{
		$cek = $this->Model_admin->cekAkun($this->session->user);
		$data = array(
			'akun'			 => $cek,
			'cdc'	 => $this->Model_admin->getTelkom()
		);
		$this->load->view('admin/kelolatelkom',$data);
	}

	public function kelolaDesigner()
	{
		$cek = $this->Model_admin->cekAkun($this->session->user);
		$data = array(
			'akun'			 => $cek,
			'designer'	 => $this->Model_admin->getDesigner()
		);
		$this->load->view('admin/keloladesigner',$data);
	}

	public function kelolaUMKM()
	{
		$cek = $this->Model_admin->cekAkun($this->session->user);
		$data = array(
			'akun'			 => $cek,
			'umkm'	 		=> $this->Model_admin->getUMKM()
		);
		$this->load->view('admin/kelolaumkm',$data);
	}

	public function tambahPengelola()
	{
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
		$this->form_validation->set_rules('notelp','Nomor Telp','required|min_length[10]|numeric|greater_than[0]',
		array(
			'required'    => '%s tidak boleh kosong',
			'min_length'  => '%s diisi minimal 10angka',
			'numeric'     => '%s wajib menggunakan angka',
			'greater_than'=> '%s tidak boleh minus'
		));
		$this->form_validation->set_rules('email','Email','required|valid_email',
		array(
		'required'      => 'Email tidak boleh kosong',
		'valid_email'   => 'Harus berformat email yang valid (contoh : email@gmail.com)'
		));
		$this->form_validation->set_rules('status','Status','required',
		array(
		'required'      => 'Status harus diisi',
		));
		if($this->form_validation->run() == FALSE){
			$this->kelolaAkun();
		}else{
		$id 		= $this->Model_created->idUser();
		$idP		= $this->Model_created->idPengelola();
		$data 	= array(
			'IDUser'			=> $id,
			'Username'		=> $this->input->post('username'),
			'Password'		=> md5($this->input->post('password')),
			'Nama_lengkap'=> $this->input->post('namalengkap'),
			'Foto'				=> 'pengelola.png',
			'Email'				=> $this->input->post('email'),
			'Level'				=> 'Pengelola',
			'Status'			=> $this->input->post('status')
		);
		$dataa 	= array(
			'IDPengelola' => $idP,
			'IDUser'			=> $id,
			'No_telp'			=> $this->input->post('notelp')
		);
		$cek	= $this->Model_created->create_user($data);
		$cekk = $this->Model_created->create_pengelola($dataa);
		redirect('Admin/kelolaAkun');
		}
	}

	public function editPengelola($id)
	{
		$data 	= array(
			'Username'		=> $this->input->post('username'),
			'Nama_lengkap'=> $this->input->post('namalengkap'),
			'Email'				=> $this->input->post('email'),
			'Status'			=> $this->input->post('status')
		);
		$dataa 	= array(
			'No_telp'			=> $this->input->post('notelp')
		);
		$cek	= $this->Model_created->update_user($id,$data);
		$cekk = $this->Model_created->update_pengelola($id,$dataa);
		redirect('Admin/kelolaAkun');
	}

	public function hapusPengelola($id)
	{
		$hapus = $this->Model_admin->delete_pengelola($id);
		$hapuss = $this->Model_admin->delete_user($id);
		redirect('Admin/kelolaAkun');
	}

	public function hapusCDC($id)
	{
		$hapus = $this->Model_admin->delete_cdc($id);
		$hapuss = $this->Model_admin->delete_user($id);
		redirect('Admin/kelolaTelkom');
	}

	public function editTelkom($id)
	{
		$data 	= array(
			'Username'		=> $this->input->post('username'),
			'Nama_lengkap'=> $this->input->post('namalengkap'),
			'Email'				=> $this->input->post('email'),
			'Status'			=> $this->input->post('status')
		);
		$dataa 	= array(
			'No_telp'			=> $this->input->post('notelp'),
			'Regional'		=> $this->input->post('regional')
		);
		$cek	= $this->Model_created->update_user($id,$data);
		$cekk = $this->Model_created->update_telkom($id,$dataa);
		redirect('Admin/kelolaTelkom');
	}

	public function tambahTelkom()
	{
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
		$this->form_validation->set_rules('notelp','Nomor Telp','required|min_length[10]|numeric|greater_than[0]',
		array(
			'required'    => '%s tidak boleh kosong',
			'min_length'  => '%s diisi minimal 10angka',
			'numeric'     => '%s wajib menggunakan angka',
			'greater_than'=> '%s tidak boleh minus'
		));
		$this->form_validation->set_rules('email','Email','required|valid_email',
		array(
		'required'      => 'Email tidak boleh kosong',
		'valid_email'   => 'Harus berformat email yang valid (contoh : email@gmail.com)'
		));
		$this->form_validation->set_rules('status','Status','required',
		array(
		'required'      => 'Status harus diisi',
		));
		$this->form_validation->set_rules('regional','Regional','required',
		array(
		'required'      => 'Regional harus diisi',
		));
		if($this->form_validation->run() == FALSE){
			$this->kelolaTelkom();
		}else{
		$id 		= $this->Model_created->idUser();
		$idP		= $this->Model_created->idTelkom();
		$data 	= array(
			'IDUser'			=> $id,
			'Username'		=> $this->input->post('username'),
			'Password'		=> md5($this->input->post('password')),
			'Nama_lengkap'=> $this->input->post('namalengkap'),
			'Foto'				=> 'cdc.png',
			'Email'				=> $this->input->post('email'),
			'Level'				=> 'CDC',
			'Status'			=> $this->input->post('status')
		);
		$dataa 	= array(
			'IDTelkom' => $idP,
			'IDUser'			=> $id,
			'Regional'		=> $this->input->post('regional'),
			'No_telp'			=> $this->input->post('notelp')
		);
		$cek	= $this->Model_created->create_user($data);
		$cekk = $this->Model_created->create_telkom($dataa);
		redirect('Admin/kelolaTelkom');
		}
	}

	public function statusAktif($id)
	{
		$data = array(
			'Status'	=> 'Aktif'
		);
		$cek = $this->Model_created->update_user($id,$data);
		redirect('Admin/kelolaTelkom');
	}

	public function statusTdkAktif($id)
	{
		$data = array(
			'Status'	=> 'Tidak Aktif'
		);
		$cek = $this->Model_created->update_user($id,$data);
		redirect('Admin/kelolaTelkom');
	}

	public function hapusDesigner($id)
	{
		$hapus = $this->Model_admin->delete_designer($id);
		$hapuss = $this->Model_admin->delete_user($id);
		redirect('Admin/kelolaDesigner');
	}

	public function tambahDesigner()
	{
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
		$this->form_validation->set_rules('notelp','Nomor Telp','required|min_length[10]|numeric|greater_than[0]',
		array(
			'required'    => '%s tidak boleh kosong',
			'min_length'  => '%s diisi minimal 10angka',
			'numeric'     => '%s wajib menggunakan angka',
			'greater_than'=> '%s tidak boleh minus'
		));
		$this->form_validation->set_rules('email','Email','required|valid_email',
		array(
		'required'      => 'Email tidak boleh kosong',
		'valid_email'   => 'Harus berformat email yang valid (contoh : email@gmail.com)'
		));
		$this->form_validation->set_rules('status','Status','required',
		array(
		'required'      => 'Status harus diisi',
		));
		$this->form_validation->set_rules('keterangan','Keterangan','required',
		array(
		'required'      => 'Keterangan harus diisi',
		));
		if($this->form_validation->run() == FALSE){
			$this->kelolaDesigner();
		}else{
		$id 		= $this->Model_created->idUser();
		$idP		= $this->Model_created->idDesigner();
		$data 	= array(
			'IDUser'			=> $id,
			'Username'		=> $this->input->post('username'),
			'Password'		=> md5($this->input->post('password')),
			'Nama_lengkap'=> $this->input->post('namalengkap'),
			'Foto'				=> 'designer.png',
			'Email'				=> $this->input->post('email'),
			'Level'				=> 'Designer',
			'Status'			=> $this->input->post('status')
		);
		$dataa 	= array(
			'IDDesigner' => $idP,
			'IDUser'			=> $id,
			'No_telp'			=> $this->input->post('notelp'),
			'Keterangan'		=> $this->input->post('keterangan')
		);
		$cek	= $this->Model_created->create_user($data);
		$cekk = $this->Model_created->create_design($dataa);
		redirect('Admin/kelolaDesigner');
		}
	}

	public function editDesigner($id)
	{
		$data 	= array(
			'Username'		=> $this->input->post('username'),
			'Nama_lengkap'=> $this->input->post('namalengkap'),
			'Email'				=> $this->input->post('email'),
			'Status'			=> $this->input->post('status')
		);
		$dataa 	= array(
			'No_telp'			=> $this->input->post('notelp'),
			'Keterangan'		=> $this->input->post('keterangan')
		);
		$cek	= $this->Model_created->update_user($id,$data);
		$cekk = $this->Model_created->update_design($id,$dataa);
		redirect('Admin/kelolaDesigner');
	}

	public function statussAktif($id)
	{
		$data = array(
			'Status'	=> 'Aktif'
		);
		$cek = $this->Model_created->update_user($id,$data);
		redirect('Admin/kelolaDesigner');
	}

	public function statussTdkAktif($id)
	{
		$data = array(
			'Status'	=> 'Tidak Aktif'
		);
		$cek = $this->Model_created->update_user($id,$data);
		redirect('Admin/kelolaDesigner');
	}

	public function statusAktiff($id)
	{
		$data = array(
			'Status'	=> 'Aktif'
		);
		$cek = $this->Model_created->update_user($id,$data);
		redirect('Admin/kelolaUMKM');
	}

	public function statusTdkAktiff($id)
	{
		$data = array(
			'Status'	=> 'Tidak Aktif'
		);
		$cek = $this->Model_created->update_user($id,$data);
		redirect('Admin/kelolaUMKM');
	}

	public function hapusUMKM($id)
	{
		$hapus = $this->Model_admin->delete_umkm($id);
		$hapuss = $this->Model_admin->delete_user($id);
		redirect('Admin/kelolaUMKM');
	}

	public function kelolaDataUMKMId($id)
	{
		$cek = $this->Model_admin->cekAkun($this->session->user);
		$data = array(
			'akun'			 => $cek,
			'umkm'			 => $this->Model_admin->getDataUMKM($id)
		);
		$this->load->view('admin/keloladataumkm2',$data);
	}

	public function kelolaDataUMKMIo($id)
	{
		$cek = $this->Model_admin->cekAkun($this->session->user);
		$data = array(
			'akun'			 => $cek,
			'umkm'			 => $this->Model_admin->getDataUMKM($id)
		);
		$this->load->view('admin/keloladataumkm3',$data);
	}

	public function kelolaDataUMKMIp($id)
	{
		$cek = $this->Model_admin->cekAkun($this->session->user);
		$data = array(
			'akun'			 => $cek,
			'umkm'			 => $this->Model_admin->getDataUMKM($id)
		);
		$this->load->view('admin/keloladataumkm4',$data);
	}

	public function kelolaDataUMKMIc($id)
	{
		$cek = $this->Model_admin->cekAkun($this->session->user);
		$data = array(
			'akun'			 => $cek,
			'umkm'			 => $this->Model_admin->getDataUMKM($id)
		);
		$this->load->view('admin/keloladataumkm5',$data);
	}

	public function tambahUMKM()
	{
			$id 		= $this->Model_created->idUser();
			$idP		= $this->Model_created->idUMKM();
			$data 	= array(
				'IDUser'			=> $id,
				'Username'		=> $this->input->post('username'),
				'Password'		=> md5($this->input->post('password')),
				'Nama_lengkap'=> $this->input->post('namalengkap'),
				'Foto'				=> 'umkm.png',
				'Email'				=> $this->input->post('email'),
				'Level'				=> 'UMKM',
				'Status'			=> $this->input->post('status')
			);
			$dataa 	= array(
				'IDUMKM' 			=> $idP,
				'IDUser'			=> $id,
				'Nama_umkm'		=> $this->input->post('namaumkm'),
				'No_telp'			=> $this->input->post('notelp'),
				'Regional'		=> $this->input->post('regional'),
				'Alamat'			=> $this->input->post('alamat')
			);
			$cek	= $this->Model_created->create_user($data);
			$cekk = $this->Model_created->create_umkm($dataa);
			redirect('Admin/kelolaUMKM');
		}

	public function editUMKM($id)
	{
			$data 	= array(
				'Username'		=> $this->input->post('username'),
				'Nama_lengkap'=> $this->input->post('namalengkap'),
				'Email'				=> $this->input->post('email'),
				'Status'			=> $this->input->post('status')
			);
			$dataa 	= array(
				'No_telp'			=> $this->input->post('notelp'),
				'Regional'		=> $this->input->post('regional'),
				'Nama_umkm'		=> $this->input->post('namaumkm'),
				'Alamat'			=> $this->input->post('alamat')
			);
			$cek	= $this->Model_created->update_user($id,$data);
			$cekk = $this->Model_created->update_umkm($id,$dataa);
			redirect('Admin/kelolaUMKM');
		}

	public function kelolaPemesanan()
	{
			$cek = $this->Model_admin->cekAkun($this->session->user);
			$data = array(
				'akun'			 => $cek,
				'pemesanan'	 => $this->Model_admin->getPemesanan(),
				'umkm'			 => $this->Model_admin->getUMKM(),
				'designer'	 => $this->Model_admin->getDesigner()
			);
			$this->load->view('admin/kelolapemesanan',$data);
	}

	public function createPortofolio($id)
	{
			$cek = $this->Model_admin->cekAkun($this->session->user);
			$data = array(
				'akun'			 => $cek,
				'desainer'	 => $this->Model_admin->getDesignerId($id),
				'portofolio' => $this->Model_admin->getPortofolio($id),
			);
			$this->load->view('admin/kelolaportofolio',$data);
	}

	public function hapusPemesanan($id)
	{
			$hapus = $this->Model_admin->delete_diskum($id);
			$hapuss = $this->Model_admin->delete_pemesanan($id);
			redirect('Admin/kelolaPemesanan');
	}

	public function tambahPemesanan()
	{
				if ($this->input->post('status') == 'Ada') {
					$umkm = $this->Model_admin->getDataUMKM($this->input->post('idumkm'));
					if (!$umkm) {
						echo "
	        	<script type='text/javascript'>
	        		alert('Isi Data UMKM Terlebih Dahulu');
	        		history.back(self);
	        	</script>";
					}else{
					$cek = $this->Model_admin->getAkunPengelola($this->session->user);
					$id 		= $this->Model_created->idPesan();
					$idD		= $this->Model_created->idDiskum();
					$data 	= array(
						'IDPesan'						=> $id,
						'IDUMKM'						=> $this->input->post('idumkm'),
						'IDPengelola'				=> $cek->IDPengelola,
						'IDDesigner'				=> $this->input->post('iddesigner'),
						'Tgl_mulai'					=> $this->input->post('tglmulai'),
						'Keterangan_design'	=> $this->input->post('keterangan'),
						'Status'						=> '0'
					);
					$dataa 	= array(
						'IDDiskum'		=> $idD,
						'IDPengelola'	=> $cek->IDPengelola,
						'IDPesan'			=> $id,
						'Komentar'		=> $this->input->post('keterangan')
					);
					$cek	= $this->Model_admin->create_pemesanan($data);
					$cekk = $this->Model_admin->create_diskum($dataa);
					redirect('Admin/kelolaPemesanan');
					}
				}else if($this->input->post('status') == 'Tidak Ada'){
					echo "
        	<script type='text/javascript'>
        		alert('Isi Data UMKM Terlebih Dahulu');
        		history.back(self);
        	</script>";
				}
	}

	public function tambahDataUMKM()
	{
				$config['upload_path'] = "./uploads/foto_produk";
				$config['allowed_types'] = "gif|jpg|png";
				$config['max_size'] = 2000;
				$config['encrypt_name'] = TRUE;

				$this->load->library('upload',$config);

				if ($this->upload->do_upload('foto_produk')) {
				$foto = $this->upload->data();
				$id 		= $this->Model_created->idDataUMKM();
				$data 	= array(
					'IDDataUMKM'				=> $id,
					'IDUMKM'						=> $this->input->post('idumkm'),
					'Nama_produk'				=> $this->input->post('nama_produk'),
					'Foto_produk'				=> $foto['file_name'],
					'Keterangan'				=> $this->input->post('keterangan'),
				);
				$cek	= $this->Model_admin->create_dataumkm($data);
				}else{
					$data 	= array(
						'IDDataUMKM'				=> $id,
						'IDUMKM'						=> $this->input->post('idumkm'),
						'Nama_produk'				=> $this->input->post('nama_produk'),
						'Foto_produk'				=> $this->input->post('foto_produk'),
						'Keterangan'				=> $this->input->post('keterangan'),
					);
				}
				redirect('Admin/kelolaPemesanan');
	}

	public function editPemesanan()
	{
					$config['upload_path'] = "./uploads/hasil_design";
					$config['allowed_types'] = "rar|jpg|pdf";
					$config['max_size'] = 2000;
					$config['encrypt_name'] = TRUE;

					$this->load->library('upload',$config);
					$id 	= $this->input->post('idpesan');

					if ($this->upload->do_upload('hasil_design')) {
					$foto = $this->upload->data();
					$data = array(
						'IDDesigner' 				=> $this->input->post('iddesigner'),
						'Tgl_mulai'  				=> $this->input->post('tgl_mulai'),
						'Tgl_akhir'	 				=> $this->input->post('tgl_akhir'),
						'Keterangan_design'	=> $this->input->post('keterangan'),
						'Hasil_design'			=> $foto['file_name'],
						'Status'					  => $this->input->post('status')
					);
					}else{
						$data = array(
							'IDDesigner' 				=> $this->input->post('iddesigner'),
							'Tgl_mulai'  				=> $this->input->post('tgl_mulai'),
							'Tgl_akhir'	 				=> $this->input->post('tgl_akhir'),
							'Keterangan_design'	=> $this->input->post('keterangan'),
							'Hasil_design'			=> 'Belum ada',
							'Status'					  => $this->input->post('status')
						);
					}
					$cek = $this->Model_admin->update_pemesanan($id,$data);
					redirect('Admin/kelolaPemesanan');
	}

	public function kelolaDataUMKM()
	{
					$cek = $this->Model_admin->cekAkun($this->session->user);
					$data = array(
						'akun'			 => $cek,
						'dataumkm'	 => $this->Model_admin->getDataaUMKM(),
						'umkm'			 => $this->Model_admin->getUMKM()
					);
					$this->load->view('admin/keloladataumkm',$data);
	}

	public function hapusDataUMKM($id)
	{
					$hapus = $this->Model_admin->delete_dataumkm($id);
					redirect('Admin/kelolaDataUMKM');
	}

	public function UpdateFoto()
	{
		$config['upload_path'] = "./uploads/foto_produk";
		$config['allowed_types'] = "png|jpg|pdf";
		$config['max_size'] = 2000;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload',$config);
		$id 	= $this->input->post('iddataumkm');

		if ($this->upload->do_upload('foto_produk')) {
		$foto = $this->upload->data();
		$data = array(
			'Foto_produk'				=> $foto['file_name'],
		);
		}else{
			$data = array(
				'Foto_produk' 		=> $this->input->post('foto_produk'),
			);
		}
		$cek = $this->Model_admin->update_dataumkm($id,$data);
		redirect('Admin/kelolaDataUMKM');
	}

	public function UpdateLogo()
	{
		$config['upload_path'] = "./uploads/logo_produk";
		$config['allowed_types'] = "png|jpg|pdf";
		$config['max_size'] = 2000;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload',$config);
		$id 	= $this->input->post('iddataumkm');

		if ($this->upload->do_upload('logo_produk')) {
		$foto = $this->upload->data();
		$data = array(
			'Logo_produk'				=> $foto['file_name'],
		);
		}else{
			$data = array(
				'Logo_produk' 		=> $this->input->post('logo_produk'),
			);
		}
		$cek = $this->Model_admin->update_dataumkm($id,$data);
		redirect('Admin/kelolaDataUMKM');
	}

	public function UpdateKemasan()
	{
		$config['upload_path'] = "./uploads/foto_kemasan_lama";
		$config['allowed_types'] = "png|jpg|pdf";
		$config['max_size'] = 2000;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload',$config);
		$id 	= $this->input->post('iddataumkm');

		if ($this->upload->do_upload('kemasan_produk')) {
		$foto = $this->upload->data();
		$data = array(
			'Kemasan_produk'				=> $foto['file_name'],
		);
		}else{
			$data = array(
				'Kemasan_produk' 		=> $this->input->post('kemasan_produk'),
			);
		}
		$cek = $this->Model_admin->update_dataumkm($id,$data);
		redirect('Admin/kelolaDataUMKM');
	}

	public function editDataUMKM($id)
	{
		$data 	= array(
			'Nama_produk'		=> $this->input->post('nama_produk'),
			'Keterangan'		=> $this->input->post('keterangan')
		);
		$cek	= $this->Model_admin->update_dataumkm($id,$data);
		redirect('Admin/kelolaDataUMKM');
	}


	public function kelolaOrderDesigner()
	{
			$cek = $this->Model_admin->cekAkun($this->session->user);
			$data = array(
				'akun'			 			=> $cek,
				'orderpemesanan'	=> $this->Model_admin->getOrderPemesanan()
			);
			$this->load->view('admin/kelolaorderdesigner',$data);
	}

	public function kelolaOrderPermintaan()
	{
		$cek = $this->Model_admin->cekAkun($this->session->user);
		$data = array(
			'akun'			 			=> $cek,
			'orderpemesanan'	=> $this->Model_admin->getOrderPermintaan()
		);
		$this->load->view('admin/kelolaorderpermintaan',$data);
	}

	public function kelolaOrderOnGoing()
	{
		$cek = $this->Model_admin->cekAkun($this->session->user);
		$data = array(
			'akun'			 			=> $cek,
			'orderpemesanan'	=> $this->Model_admin->getOrderOnGoing()
		);
		$this->load->view('admin/kelolaongoing',$data);
	}

	public function kelolaOrderSelesai()
	{
		$cek = $this->Model_admin->cekAkun($this->session->user);
		$data = array(
			'akun'			 			=> $cek,
			'orderpemesanan'	=> $this->Model_admin->getOrderSelesai()
		);
		$this->load->view('admin/kelolaorderselesai',$data);
	}

	public function kelolaTransaksi()
	{
		$cek = $this->Model_admin->cekAkun($this->session->user);
		$data = array(
			'akun'			 			=> $cek,
			'orderpemesanan'	=> $this->Model_admin->getOrderTransaksi()
		);
		$this->load->view('admin/kelolatransaksi',$data);
	}

	/**
	 * Ini function untuk lihat detil diskusinya kah atau daftar diskusi?
	 * 
	 * Penyebab utama kenapa halaman kosong:
	 * function getDaftarDiskum() di model Model_admin ga ada "return"
	 * 
	 * Catatan tambahan
	 * - Function ini manggil view "admin/diskusi.php" berarti mau nampilin **detil diskusi**,
	 * - View "admin/diskusi.php" perlu nge-load helper "my_helper"(baris 884) biar ga ada error
	 * - Juga, getDaftarDiskum(baris 880) itu buat halaman yang nampilin daftar-daftar diskum(bukan detil diskusi)
	 * 
	 */
	public function kelolaDiskUM($id)
	{
		$cek	= $this->Model_admin->cekAkun($this->session->user);

		$data	= array(
			'akun'				=> $cek,
			'pemesanan'			=> $this->Model_admin->getDataUMKMId($id),
			'daftar_diskusi'	=> $this->Model_admin->getDaftarDiskum($id) // <--- Kalo mau pake Model_diskusi aja yang emang dibuat khusus buat nanganin data diskum atau dispro
		);
		// var_dump($data);

		$this->load->helper('my_helper');
		$this->load->view('admin/diskusi',$data);
	}
	

	/**
	 * Function ini untuk lihat daftar-daftar diskum
	 * 
	 * Daftar diskum diambil berdasarkan IDPengelola di tb_pemesanan.
	 * 
	 * Boleh dipake atau ngga
	 */
	public function lihatDiskum()
	{
		$cek 			= $this->Model_admin->cekAkun($this->session->user);

		// Ambil semua IDPesan berdasarkan IDPengelola di tb_pemesanan
		$pengelola		= $this->Model_admin->getAkunPengelola($this->session->user);
		$id_pengelola	= $pengelola->IDPengelola;
		$id_pesan		= $this->Model_admin->getAllIdPesan($id_pengelola);

		// Buat array $id_pesan menjadi array numeric dengan bantuan function flattenArray() dari my_helper
		$this->load->helper('my_helper');
		$id_pesan	= flattenArray($id_pesan);

		// Ambil daftar diskusi dari tb_diskusiumkm berdasarkan IDPesan tadi
		$this->load->model('Model_diskusi');
		$daftar_diskusi = $this->Model_diskusi->getDaftarDiskum($id_pesan);

		// Cek jika $daftar_diskusi kosong beri status has_diskum=false
		// jika ada $daftar_diskusi maka beri status has_diskum=true dan masukan ke $data
		if( empty($daftar_diskusi) ) {
			$data = array(
				'has_diskum'	=> false,
				'akun'			=> $cek
			);
		}
		else {
			$data = array(
				'has_diskum'		=> true,
				'akun'				=> $cek,
				'daftar_diskusi'	=> $daftar_diskusi
			);
		}
		// var_dump($data); // lihat isi array $data

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

			// Dapatkan detil pemesanan/request (gabungan tabel tb_pemesanan dan tb_umkm_data)
			$this->load->model('Model_diskusi');
			$detil_pemesanan	= $this->Model_diskusi->getPemesanan($id_pesan);

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
			// var_dump($data['daftar_diskusi']); // untuk liat isi array $data

			// Load helper untuk memformat tanggal di view "admin/diskum"
			$this->load->helper('my_helper');

			// Load view
			$this->load->view('admin/diskum', $data);

		} else {
			http_response_code('400');
		}
	}
}
