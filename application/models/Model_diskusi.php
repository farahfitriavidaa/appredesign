<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_diskusi extends CI_Model {

	public function getPemesanan($id_pesan)
	{
        return $this->db->query("SELECT * FROM tb_pemesanan JOIN tb_umkm_data USING(IDDataUMKM) WHERE IDPesan='$id_pesan'")->row();
    }

    public function getNamaDesainer($id_desainer)
	{
		return $this->db->query("SELECT Nama_lengkap FROM tb_user JOIN tb_desainer USING(IDUser) WHERE IDDesigner='$id_desainer'")->row();
	}
}
	