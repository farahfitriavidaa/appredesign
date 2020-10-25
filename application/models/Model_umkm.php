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

	public function getIdDataUmkm($id_umkm)
	{
		return $this->db->query("SELECT IDDataUMKM FROM tb_umkm_data WHERE IDUMKM='$id_umkm'")->result_array();
	}

	public function getDaftarRequest($data)
	{
		$this->db->where_in('IDDataUMKM', $data);
		$result = $this->db->get('tb_pemesanan');
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

	// public function getDesainer($id_designer)
	// {
	// 	return $this->db->query("SELECT * FROM tb_desainer WHERE IDDesigner='$id_designer'")->row();
	// }

	public function getNamaDesainer($id_desainer)
	{
		return $this->db->query("SELECT Nama_lengkap FROM tb_user JOIN tb_desainer USING(IDUser) WHERE IDDesigner='$id_desainer'")->row();
	}
	
	public function createUmkmData($data){
		$this->db->insert('tb_umkm_data', $data);
	}

	public function createPemesanan($data)
	{
		$this->db->insert('tb_pemesanan', $data);
	}
}