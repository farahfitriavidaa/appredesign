<?php

class Model_umkm extends CI_Model {

	public function getUserData($user)
	{
		return $this->db->query("SELECT * FROM tb_user WHERE username='$user'")->row();
	}

	public function getIdUser($user)
	{
		return $this->db->query("SELECT IDUser FROM tb_user WHERE username='$user'")->row();
	}
	
	public function getIdUmkm($id_user)
	{
		return $this->db->query("SELECT IDUMKM FROM tb_umkm WHERE IDUser='$id_user'")->row();
	}

	public function getAllIdDataUmkm($id_umkm)
	{
		return $this->db->query("SELECT IDDataUMKM FROM tb_umkm_data WHERE IDUMKM='$id_umkm'")->result_array();
	}

	public function getAllIdPesan($id_umkm)
	{
		return $this->db->query("SELECT IDPesan FROM tb_pemesanan JOIN tb_umkm_data USING(IDDataUMKM) WHERE IDUMKM='$id_umkm'")->result_array();
	}

	public function getIdDataUmkmFromIdPesan($id_pesan)
	{
		return $this->db->query("SELECT IDDataUMKM FROM tb_pemesanan WHERE IDPesan='$id_pesan'")->row();
	}

	public function getNamaUmkm($id_umkm)
	{
		return $this->db->query("SELECT Nama_umkm FROM tb_umkm WHERE IDUMKM='$id_umkm'")->row();
	}

	public function getDaftarRequest($id_data_umkm)
	{
		$this->db->where_in('IDDataUMKM', $id_data_umkm);
		$result = $this->db->get('tb_pemesanan');
		return $result->result();
	}

	public function getDaftarProduk($id_data_umkm)
	{
		$this->db->where_in('IDDataUMKM', $id_data_umkm);
		$result = $this->db->get('tb_umkm_data');
		return $result->result();
	}

	public function getRequest($id_pesan)
	{
		return $this->db->query("SELECT * FROM tb_pemesanan WHERE IDPesan='$id_pesan'")->row();
	}

	public function getUmkmData($id_data_umkm)
	{
		return $this->db->query("SELECT * FROM tb_umkm_data WHERE IDDataUMKM='$id_data_umkm'")->row();
	}

	public function getUmkm($id_umkm)
	{
		return $this->db->query("SELECT * FROM tb_umkm WHERE IDUMKM='$id_umkm'")->row();
	}

	public function getDaftarDesainer()
	{
		return $this->db->query("SELECT IDDesigner, Nama_lengkap FROM tb_desainer JOIN tb_user USING(IDUser)")->result();
	}

	public function getDesainer($id_designer)
	{
		return $this->db->query("SELECT Nama_lengkap, Keterangan FROM tb_desainer JOIN tb_user USING(IDUser) WHERE IDDesigner='$id_designer'")->row();
	}

	public function getNamaDesainer($id_desainer)
	{
		return $this->db->query("SELECT Nama_lengkap FROM tb_user JOIN tb_desainer USING(IDUser) WHERE IDDesigner='$id_desainer'")->row();
	}

	public function getPassword($id_user)
	{
		return $this->db->query("SELECT Password FROM tb_user WHERE IDUser='$id_user'")->row();
	}
	
	public function createUmkmData($data){
		$this->db->insert('tb_umkm_data', $data);
	}

	public function createPemesanan($data)
	{
		$this->db->insert('tb_pemesanan', $data);
	}

	public function updatePemesanan($id_pesan, $data)
	{
		$this->db->where('IDPesan',$id_pesan);
		$this->db->update('tb_pemesanan',$data);
	}

	public function updateUmkmData($id_data_umkm, $data)
	{
		$this->db->where('IDDataUMKM',$id_data_umkm);
		$this->db->update('tb_umkm_data',$data);
	}

	public function updateUser($id_user, $data)
	{
		$this->db->where('IDUser',$id_user);
		$this->db->update('tb_user',$data);
	}

	public function updateUmkm($id_umkm, $data)
	{
		$this->db->where('IDUMKM',$id_umkm);
		$this->db->update('tb_umkm',$data);
	}

	public function updatePassword($id_user, $password)
	{
		$this->db->set('Password', $password);
		$this->db->where('IDUser',$id_user);
		$this->db->update('tb_user');
	}

	public function deleteRequest($id_pesan)
	{
		$this->db->where('IDPesan', $id_pesan);
		$this->db->delete('tb_pemesanan');
	}

	public function deleteUmkmData($id_data_umkm)
	{
		$this->db->where('IDDataUMKM', $id_data_umkm);
		$this->db->delete('tb_umkm_data');
	}
}