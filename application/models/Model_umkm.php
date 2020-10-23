<?php

class Model_umkm extends CI_Model {

	public function getUserData($user)
	{
		return $this->db->query("SELECT * FROM tb_user WHERE username='$user'")->row();
	}

	public function getIdUmkm($user)
	{
		return $this->db->query("SELECT IDUMKM FROM tb_user WHERE username='$user'")->row();
	}

	public function getDaftarRequest($id)
	{
		return $this->db->query("SELECT * FROM tb_pemesanan WHERE IDUMKM='$id'")->result();
	}
}