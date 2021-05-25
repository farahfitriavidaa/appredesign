<?php

class Model_designer extends CI_Model {

	public function getIdUser($user)
	{
		return $this->db->query("SELECT IDUser FROM tb_user WHERE username='$user'")->row();
	}

	public function getIdDesigner($id_user)
	{
		return $this->db->query("SELECT IDDesigner FROM tb_desainer WHERE IDUser='$id_user'")->row();
	}

	public function getUserData($user)
	{
		return $this->db->query("SELECT * FROM tb_user WHERE username='$user'")->row();
	}

	public function getDesigner($id_designer)
	{
		return $this->db->query("SELECT * FROM tb_user JOIN tb_desainer USING(IDUser) WHERE IDDesigner='$id_designer'")->row();
	}

	public function getSimpleDesigner($id_designer)
	{
		return $this->db->query("SELECT Nama_lengkap, Keterangan FROM tb_desainer JOIN tb_user USING(IDUser) WHERE IDDesigner='$id_designer'")->row();
	}

	public function getDaftarPortofolio($id_designer)
	{
		return $this->db->query("SELECT * FROM tb_portofolio WHERE IDDesigner='$id_designer'")->result();
	}

	public function getPortofolio($id_designer, $id_portofolio)
	{
		return $this->db->query("SELECT * FROM tb_portofolio WHERE IDPortofolio='$id_portofolio' AND IDDesigner='$id_designer'")->row();
	}

	public function getHasilDesain($id_designer)
	{
		return $this->db->query("SELECT Hasil_design, Revisi_design FROM tb_pemesanan WHERE IDDesigner='$id_designer'")->result();
	}

	public function getAllRequest($id_designer)
	{
		return $this->db->query("SELECT IDPesan, IDDataUMKM, IDDesigner, Status, Tgl_akhir, Keterangan_design, Nama_produk
			FROM tb_pemesanan
			JOIN tb_umkm_data USING (IDDataUMKM)
			WHERE IDDesigner='$id_designer' AND Status>1
			ORDER BY Tgl_order DESC")->result();
	}

	public function getRequest($id_pesan, $id_designer)
	{
		return $this->db->query("SELECT * FROM tb_pemesanan JOIN tb_umkm_data USING(IDDataUMKM) WHERE IDPesan='$id_pesan' AND IDDesigner='$id_designer' AND Status>1")->row();
	}

	public function getStatusRequest($id_pesan, $id_designer)
	{
		$query = $this->db->query("SELECT Status FROM tb_pemesanan WHERE IDPesan='$id_pesan' AND IDDesigner='$id_designer'")->row();
		return $query->Status;
	}

	public function getSumRequest($id_designer)
	{
		$q1 = $this->db->query("SELECT COUNT(IDPesan) AS total FROM tb_pemesanan WHERE IDDesigner='$id_designer' AND Status>1")->row();
		$q2 = $this->db->query("SELECT COUNT(IDPesan) AS selesai FROM tb_pemesanan WHERE IDDesigner='$id_designer' AND Status IN ('3', '4')")->row();
		$q3 = $this->db->query("SELECT COUNT(IDPesan) AS belum FROM tb_pemesanan WHERE IDDesigner='$id_designer' AND Status IN('1', '2')")->row();

		$data = array(
			'total'     => $q1->total,
			'selesai'   => $q2->selesai,
			'belum'     => $q3->belum
		);

		return $data;
	}

	public function getKomenTerakhir($id_designer)
	{
		return $this->db->query("SELECT dispro.*, pemesanan.Status, dataumkm.Nama_produk
			FROM tb_diskusiproduksi AS dispro
			JOIN tb_pemesanan AS pemesanan USING(IDPesan)
			JOIN tb_umkm_data AS dataumkm USING(IDDataUMKM)
			WHERE dispro.IDDesigner='$id_designer'
			ORDER BY Tanggal_waktu DESC
			LIMIT 3")->result();
	}

	public function getRequestTerbaru($id_designer)
	{
		return $this->db->query("SELECT pemesanan.IDPesan, pemesanan.Status, dataumkm.Nama_produk
			FROM tb_pemesanan AS pemesanan
			JOIN tb_umkm_data AS dataumkm USING(IDDataUMKM)
			WHERE IDdesigner='$id_designer'
			AND Status IN('1','2')
			ORDER BY Tgl_order DESC
			LIMIT 3")->result();
	}

	public function createPortofolio($data)
	{
		$this->db->insert('tb_portofolio', $data);
	}

	public function updateUser($id_user, $data)
	{
		$this->db->where('IDUser',$id_user);
		$this->db->update('tb_user',$data);
	}

	public function updateDesigner($id_designer, $data)
	{
		$this->db->where('IDDesigner',$id_designer);
		$this->db->update('tb_desainer',$data);
	}

	public function updatePortofolio($id_portofolio, $data)
	{
		$this->db->where('IDPortofolio', $id_portofolio);
		$this->db->update('tb_portofolio', $data);
	}

	public function updatePassword($id_user, $password)
	{
		$this->db->set('Password', $password);
		$this->db->where('IDUser',$id_user);
		$this->db->update('tb_user');
	}

	public function uploadDesain($data, $id_pesan)
	{
		$this->db->set('Hasil_design', $data);
		$this->db->where('IDPesan', $id_pesan);
		$this->db->update('tb_pemesanan');
	}

	public function uploadRevisi($data, $id_pesan)
	{
		$this->db->set('Revisi_design', $data);
		$this->db->where('IDPesan', $id_pesan);
		$this->db->update('tb_pemesanan');
	}

	public function updateStatus($status, $id_pesan)
	{
		$this->db->set('Status', $status);
		$this->db->where('IDPesan', $id_pesan);
		$this->db->update('tb_pemesanan');
	}

	public function deletePortofolio($id_portofolio)
	{
		$this->db->where('IDPortofolio', $id_portofolio);
		return $this->db->delete('tb_portofolio');
	}

	public function deleteDesain($id_pesan, $id_designer)
	{
		$this->db->set('Hasil_design', null);
		$this->db->where('IDPesan', $id_pesan);
		$this->db->where('IDDesigner', $id_designer);
		return $this->db->update('tb_pemesanan');
	}

	public function deleteRevisi($id_pesan, $id_designer)
	{
		$this->db->set('Revisi_design', null);
		$this->db->where('IDPesan', $id_pesan);
		$this->db->where('IDDesigner', $id_designer);
		return $this->db->update('tb_pemesanan');
	}
}