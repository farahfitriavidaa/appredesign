<?php

class Model_admin extends CI_Model {

  public function cekAkun($user)
  {
    return $this->db->query("SELECT * FROM tb_user JOIN tb_pengelola USING(IDUser) WHERE username='$user'")->row();
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

  public function jumlahOrderan()
  {
    return $this->db->query("SELECT COUNT(IDPesan) as hasil FROM tb_pemesanan WHERE Status='5'")->row();
  }

  public function dataPemesananPending()
  {
    return $this->db->query("SELECT * FROM tb_pemesanan JOIN tb_umkm_data USING(IDDataUMKM) JOIN tb_umkm USING(IDUMKM) WHERE Status='0' ORDER BY IDPesan DESC limit 5")->result();
  }

  public function dataOrderOnGoing()
  {
    return $this->db->query("SELECT * FROM tb_user JOIN tb_umkm USING(IDUser)JOIN tb_umkm_data USING(IDUMKM) JOIN tb_pemesanan USING(IDDataUMKM) JOIN tb_pengelola USING(IDPengelola) JOIN tb_desainer USING(IDDesigner) WHERE tb_pemesanan.Status BETWEEN '2' AND '4' ORDER BY IDPesan limit 5")->result();
  }

  public function dataOrderSelesai()
  {
    return $this->db->query("SELECT * FROM tb_user JOIN tb_umkm USING(IDUser) JOIN tb_umkm_data USING(IDUMKM) JOIN tb_pemesanan USING(IDDataUMKM) JOIN tb_pengelola USING(IDPengelola) JOIN tb_desainer USING(IDDesigner) WHERE tb_pemesanan.Status = '5'")->result();
  }

  public function dataOrderTransaksi()
  {
    return $this->db->query("SELECT * FROM tb_user JOIN tb_umkm USING(IDUser) JOIN tb_umkm_data USING(IDUMKM) JOIN tb_pemesanan USING(IDDataUMKM) JOIN tb_pengelola USING(IDPengelola) JOIN tb_desainer USING(IDDesigner) WHERE tb_pemesanan.Status BETWEEN '6' AND '7'")->result();
  }

  public function dataUMKMNew()
  {
    return $this->db->query("SELECT * FROM tb_umkm JOIN tb_user USING(IDUser) ORDER BY IDUMKM DESC limit 5")->result();
  }

  public function getAkunPengelola($user)
  {
    return $this->db->query("SELECT * FROM tb_user JOIN tb_pengelola USING(IDUser) WHERE username='$user'")->row();
  }
  public function getPengelola()
  {
    return $this->db->query("SELECT * FROM tb_user JOIN tb_pengelola USING(IDUser)")->result();
  }

  public function getTelkom()
  {
    return $this->db->query("SELECT * FROM tb_user JOIN tb_telkom USING(IDUser)")->result();
  }

  public function getDesigner()
  {
    return $this->db->query("SELECT * FROM tb_user JOIN tb_desainer USING(IDUser)")->result();
  }

  public function getUMKM()
  {
    return $this->db->query("SELECT * FROM tb_user JOIN tb_umkm USING(IDUser)")->result();
  }

  public function getPemesanan()
  {
    return $this->db->query("SELECT * FROM tb_user JOIN tb_umkm USING(IDUser) JOIN tb_umkm_data USING(IDUMKM) JOIN tb_pemesanan USING(IDDataUMKM) JOIN tb_pengelola USING(IDPengelola)")->result();
  }

  public function getDataaUMKM()
  {
    return $this->db->query("SELECT * FROM tb_umkm_data JOIN tb_umkm USING(IDUMKM)")->result();
  }

  public function getDataUMKM($idumkm)
  {
    return $this->db->query("SELECT * FROM tb_umkm_data JOIN tb_umkm USING(IDUMKM) WHERE IDUMKM = '$idumkm'")->result();
  }

  public function getDesignerId($id)
  {
    return $this->db->query("SELECT * FROM tb_user JOIN tb_desainer USING(IDUser) WHERE IDUser='$id'")->row();
  }

  public function getPortofolio($id)
  {
    return $this->db->query("SELECT * FROM tb_user JOIN tb_desainer USING(IDUser) JOIN tb_portofolio USING(IDDesigner) WHERE IDUser='$id'")->result();
  }

  public function delete_user($id)
  {
    $this->db->where('IDUser',$id);
    return $this->db->delete('tb_user');
  }

  public function delete_pengelola($id)
  {
    $this->db->where('IDUser',$id);
    return $this->db->delete('tb_pengelola');
  }

  public function delete_cdc($id)
  {
    $this->db->where('IDUser',$id);
    return $this->db->delete('tb_telkom');
  }

  public function delete_umkm($id)
  {
    $this->db->where('IDUser',$id);
    return $this->db->delete('tb_umkm');
  }

  public function delete_designer($id)
  {
    $this->db->where('IDUser',$id);
    return $this->db->delete('tb_desainer');
  }

  public function delete_pemesanan($id)
  {
    $this->db->where('IDPesan',$id);
    return $this->db->delete('tb_pemesanan');
  }

  public function delete_diskum($id)
  {
    $this->db->where('IDPesan',$id);
    return $this->db->delete('tb_diskusiumkm');
  }

  public function create_pemesanan($data)
  {
    $this->db->insert('tb_pemesanan',$data);
  }

  public function create_diskum($data)
  {
    $this->db->insert('tb_diskusiumkm',$data);
  }

  public function create_dataumkm($data)
  {
    $this->db->insert('tb_umkm_data',$data);
  }

  public function create_dispro($data)
  {
    $this->db->insert('tb_diskusiproduksi',$data);
  }

  public function update_dataumkm($id,$data)
  {
    $this->db->where('IDDataUMKM',$id);
    $o = $this->db->update('tb_umkm_data',$data);
    return $o;
  }

  public function update_pemesanan($id,$data)
  {
    $this->db->where('IDPesan',$id);
    $o = $this->db->update('tb_pemesanan',$data);
    return $o;
  }

  public function update_profil($id,$data)
  {
    $this->db->where('IDUser',$id);
    $o = $this->db->update('tb_user',$data);
    return $o;
  }

  public function update_profil2($id,$data)
  {
    $this->db->where('IDUser',$id);
    $o = $this->db->update('tb_pengelola',$data);
    return $o;
  }

  public function delete_dataumkm($id)
  {
    $this->db->where('IDDataUMKM',$id);
    return $this->db->delete('tb_umkm_data');
  }

  public function getOrderPemesanan()
  {
    return $this->db->query("SELECT * FROM tb_user JOIN tb_umkm USING(IDUser) JOIN tb_umkm_data USING(IDUMKM) JOIN tb_pemesanan USING(IDDataUMKM) JOIN tb_pengelola USING(IDPengelola) JOIN tb_desainer USING(IDDesigner) WHERE tb_pemesanan.Status BETWEEN '1' AND '5'")->result();
  }

  public function getOrderPermintaan()
  {
    return $this->db->query("SELECT * FROM tb_user JOIN tb_umkm USING(IDUser)JOIN tb_umkm_data USING(IDUMKM) JOIN tb_pemesanan USING(IDDataUMKM) JOIN tb_pengelola USING(IDPengelola) JOIN tb_desainer USING(IDDesigner) WHERE tb_pemesanan.Status BETWEEN '0' AND '1'")->result();
  }

  public function getOrderOnGoing()
  {
    return $this->db->query("SELECT * FROM tb_user JOIN tb_umkm USING(IDUser)JOIN tb_umkm_data USING(IDUMKM) JOIN tb_pemesanan USING(IDDataUMKM) JOIN tb_pengelola USING(IDPengelola) JOIN tb_desainer USING(IDDesigner) WHERE tb_pemesanan.Status BETWEEN '2' AND '4'")->result();
  }

  public function getOrderSelesai()
  {
    return $this->db->query("SELECT * FROM tb_user JOIN tb_umkm USING(IDUser) JOIN tb_umkm_data USING(IDUMKM) JOIN tb_pemesanan USING(IDDataUMKM) JOIN tb_pengelola USING(IDPengelola) JOIN tb_desainer USING(IDDesigner) WHERE tb_pemesanan.Status = '5'")->result();
  }

  public function getOrderTransaksi()
  {
    return $this->db->query("SELECT * FROM tb_user JOIN tb_umkm USING(IDUser) JOIN tb_umkm_data USING(IDUMKM) JOIN tb_pemesanan USING(IDDataUMKM) JOIN tb_pengelola USING(IDPengelola) JOIN tb_desainer USING(IDDesigner) WHERE tb_pemesanan.Status BETWEEN '6' AND '7'")->result();
  }

  public function getDataUMKMId($id)
  {
    return $this->db->query("SELECT * FROM tb_umkm_data JOIN tb_pemesanan USING(IDDataUMKM) WHERE IDPesan ='$id'")->row();
  }

  /**
   * Function untuk mengambil **semua** IDPesan berdasarkan IDPengelola di tb_pemesanan
   */
  public function getAllIdPesan($id_pengelola)
	{
		return $this->db->query("SELECT IDPesan FROM tb_pemesanan JOIN tb_pengelola USING(IDPengelola) WHERE IDPengelola='$id_pengelola'")->result_array();
	}

  /**
   * Function untuk mengambil semua data diskum
   */
  public function getDaftarDiskum($id_pesan)
  {
    $this->db->select("diskum1.*, umkmdata.Nama_produk");
    $this->db->from("tb_diskusiumkm AS diskum1");
    $this->db->join("tb_pemesanan", "IDPesan");
    $this->db->join("tb_umkm_data AS umkmdata", "IDDataUMKM");
    $this->db->join("(SELECT IDPesan, MAX(Tanggal_waktu) AS Tanggal_terupdate FROM tb_diskusiumkm GROUP BY IDPesan) AS diskum2",
      "diskum1.IDPesan = diskum2.IDPesan AND diskum1.Tanggal_waktu = diskum2.Tanggal_terupdate");
    $this->db->where_in("diskum1.IDPesan", $id_pesan);
    $this->db->order_by("diskum1.Tanggal_waktu", "DESC");
    $result	= $this->db->get();

    //kurang return
    return $result->result();
  }
}
