<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Model untuk mengolah data diskusi
 * 
 * 
 */

class Model_diskusi extends CI_Model {

	public function getPemesanan($id_pesan)
	{
        return $this->db->query("SELECT * FROM tb_pemesanan JOIN tb_umkm_data USING(IDDataUMKM) WHERE IDPesan='$id_pesan'")->row();
    }

    public function getNamaDesainer($id_desainer)
	{
		return $this->db->query("SELECT Nama_lengkap FROM tb_user JOIN tb_desainer USING(IDUser) WHERE IDDesigner='$id_desainer'")->row();
	}

	public function getDaftarDiskum($id_pesan)
	{
		$result = $this->db->query(
			"SELECT d1.*, ud.Nama_produk
			FROM tb_diskusiumkm d1
			JOIN tb_pemesanan USING (IDPesan)
			JOIN tb_umkm_data ud USING (IDDataUmkm)
			JOIN (
				SELECT IDPesan, MAX(Tanggal_waktu) AS Tanggal_terupdate
				FROM tb_diskusiumkm
				GROUP BY IDPesan) AS d2
			ON d1.IDPesan = d2.IDPesan AND d1.Tanggal_waktu = d2.Tanggal_terupdate
			ORDER BY Tanggal_waktu DESC");

		return $result->result();
	}

	public function getDiskum($id_pesan)
	{
		// return $this->db->query("SELECT * FROM tb_diskusiumkm WHERE IDPesan='$id_pesan'")->result();

		$this->db->select("diskum.*, user.Nama_lengkap, user.Level, user.Foto, umkm.Nama_umkm");
		$this->db->from("tb_diskusiumkm AS diskum");
		$this->db->join("tb_umkm AS umkm", "IDUMKM", "left");
		$this->db->join("tb_pengelola AS pengelola", "IDPengelola", "left");
		$this->db->join("tb_user AS user", "user.IDUser = umkm.IDUser OR user.IDUser = pengelola.IDUser");
		$this->db->where("IDPesan", $id_pesan);
		$result = $this->db->get();

		return $result->result();
	}
}