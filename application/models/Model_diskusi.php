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

	public function getDaftarDiskum($id_pesan, $status, $baris, $limit)
	{
		$this->db->select("diskum1.*, umkmdata.Nama_produk, pemesanan.Status");
		$this->db->from("tb_diskusiumkm AS diskum1");
		$this->db->join("tb_pemesanan AS pemesanan", "IDPesan");
		$this->db->join("tb_umkm_data AS umkmdata", "IDDataUMKM");
		$this->db->join("(SELECT IDPesan, MAX(Tanggal_waktu) AS Tanggal_terupdate FROM tb_diskusiumkm GROUP BY IDPesan) AS diskum2",
			"diskum1.IDPesan = diskum2.IDPesan AND diskum1.Tanggal_waktu = diskum2.Tanggal_terupdate");
		$this->db->where_in("diskum1.IDPesan", $id_pesan);
		$this->db->where_in("pemesanan.Status", $status);
		$this->db->order_by("diskum1.Tanggal_waktu", "DESC");
		$this->db->limit($limit, $baris);
		$result	= $this->db->get();

		return $result->result();
	}

	public function getDaftarDispro($id_pesan, $status, $baris, $limit)
	{
		$this->db->select("dispro1.*, umkmdata.Nama_produk, pemesanan.Status");
		$this->db->from("tb_diskusiproduksi AS dispro1");
		$this->db->join("tb_pemesanan AS pemesanan", "IDPesan");
		$this->db->join("tb_umkm_data AS umkmdata", "IDDataUMKM");
		$this->db->join("(SELECT IDPesan, MAX(Tanggal_waktu) AS Tanggal_terupdate FROM tb_diskusiproduksi GROUP BY IDPesan) AS dispro2",
			"dispro1.IDPesan = dispro2.IDPesan AND dispro1.Tanggal_waktu = dispro2.Tanggal_terupdate");
		$this->db->where_in("dispro1.IDPesan", $id_pesan);
		$this->db->where_in("pemesanan.Status", $status);
		$this->db->order_by("dispro1.Tanggal_waktu", "DESC");
		$this->db->limit($limit, $baris);
		$result	= $this->db->get();

		return $result->result();
	}

	public function getJumlahDiskum($id_pesan, $status)
	{
		$this->db->select("count(diskum1.IDDiskum) AS jumlah");
		$this->db->from("tb_diskusiumkm AS diskum1");
		$this->db->join("tb_pemesanan AS pemesanan", "IDPesan");
		$this->db->join("(SELECT IDPesan, MAX(Tanggal_waktu) AS Tanggal_terupdate FROM tb_diskusiumkm GROUP BY IDPesan) AS diskum2",
			"diskum1.IDPesan = diskum2.IDPesan AND diskum1.Tanggal_waktu = diskum2.Tanggal_terupdate");
		$this->db->where_in("diskum1.IDPesan", $id_pesan);
		$this->db->where_in("pemesanan.Status", $status);
		$result	= $this->db->get();

		return $result->row();
	}

	public function getJumlahDispro($id_pesan, $status)
	{
		$this->db->select("count(diskum1.IDDispro) AS jumlah");
		$this->db->from("tb_diskusiproduksi AS diskum1");
		$this->db->join("tb_pemesanan AS pemesanan", "IDPesan");
		$this->db->join("(SELECT IDPesan, MAX(Tanggal_waktu) AS Tanggal_terupdate FROM tb_diskusiproduksi GROUP BY IDPesan) AS diskum2",
			"diskum1.IDPesan = diskum2.IDPesan AND diskum1.Tanggal_waktu = diskum2.Tanggal_terupdate");
		$this->db->where_in("diskum1.IDPesan", $id_pesan);
		$this->db->where_in("pemesanan.Status", $status);
		$result	= $this->db->get();

		return $result->row();
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
		$this->db->order_by("diskum.Tanggal_waktu", "DESC");
		$result = $this->db->get();

		return $result->result();
	}

	public function getDispro($id_pesan)
	{

		$this->db->select("dispro.*, user.Nama_lengkap, user.Level, user.Foto, desainer.IDDesigner");
		$this->db->from("tb_diskusiproduksi AS dispro");
		$this->db->join("tb_desainer AS desainer", "IDDesigner", "left");
		$this->db->join("tb_pengelola AS pengelola", "IDPengelola", "left");
		$this->db->join("tb_user AS user", "user.IDUser = desainer.IDUser OR user.IDUser = pengelola.IDUser");
		$this->db->where("IDPesan", $id_pesan);
		$this->db->order_by("dispro.Tanggal_waktu", "DESC");
		$result = $this->db->get();

		return $result->result();
	}

	public function createDiskum($data)
	{
		return $this->db->insert('tb_diskusiumkm', $data);
	}

	public function createDispro($data)
	{
		return $this->db->insert('tb_diskusiproduksi', $data);
	}
}
