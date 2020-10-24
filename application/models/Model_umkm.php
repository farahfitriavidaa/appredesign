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

	public function getDaftarRequest($id)
	{
		return $this->db->query("SELECT * FROM tb_pemesanan WHERE IDUMKM='$id'")->result();
	}
	
	public function createUmkmData($data){
		$this->db->insert('tb_umkm_data', $data);
	}

	public function createPemesanan($data)
	{
		$this->db->insert('tb_pemesanan', $data);
	}
}