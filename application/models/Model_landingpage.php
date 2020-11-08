<?php

class Model_landingpage extends CI_Model {

  public function getDesigner()
	{
		return $this->db->query("SELECT * FROM tb_desainer JOIN tb_user USING(IDUser)")->result();
	}

	public function getDesignerId($id)
	{
		return $this->db->query("SELECT * FROM tb_desainer JOIN tb_user USING(IDUser) WHERE IDDesigner = '$id'")->row();
	}

	public function getPortofolio($id)
	{
		return $this->db->query("SELECT * FROM tb_desainer JOIN tb_portofolio USING(IDDesigner) WHERE IDDesigner ='$id'")->result();
	}

  public function jumlahUser()
  {
    return $this->db->query("SELECT COUNT(IDUser) as hasil FROM tb_user")->row();
  }

	public function jumlahUMKM()
  {
    return $this->db->query("SELECT COUNT(IDUMKM) as hasil FROM tb_umkm")->row();
  }

  public function jumlahDesigner()
  {
    return $this->db->query("SELECT COUNT(IDUser) as hasil FROM tb_user JOIN tb_desainer USING(IDUser) WHERE Status = 'Aktif'")->row();
  }

  public function jumlahOrder()
  {
    return $this->db->query("SELECT COUNT(IDPesan) as hasil FROM tb_pemesanan")->row();
  }


}
