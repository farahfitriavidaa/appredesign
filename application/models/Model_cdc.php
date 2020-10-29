<?php

class Model_cdc extends CI_Model {

  public function cekAkun($user)
  {
    return $this->db->query("SELECT * FROM tb_user JOIN tb_telkom USING(IDUser) WHERE username='$user'")->row();
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
    $o = $this->db->update('tb_telkom',$data);
    return $o;
  }

  public function getDataVerifikasi()
  {
    return $this->db->query("SELECT * FROM tb_user JOIN tb_umkm USING(IDUser) WHERE Level='UMKM' AND Status='Pending'")->result();
  }

  public function getDataUMKM()
  {
    return $this->db->query("SELECT * FROM tb_user JOIN tb_umkm USING(IDUser) WHERE Level='UMKM' AND Status='Aktif'")->result();
  }

  public function update_verifikasi($id,$data)
  {
    $this->db->where('IDUser',$id);
    $o = $this->db->update('tb_user',$data);
    return $o;
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

  public function getJumlahUMKM()
  {
    return $this->db->query("SELECT COUNT(IDUMKM) as hasil FROM tb_umkm JOIN tb_user USING(IDUser) WHERE Status = 'Aktif'")->row();
  }

  public function getJumlahReq()
  {
    return $this->db->query("SELECT COUNT(IDPesan) as hasil FROM tb_pemesanan WHERE tb_pemesanan.Status BETWEEN '0' AND '1'")->row();
  }

  public function getJumlahOnGoing()
  {
    return $this->db->query("SELECT COUNT(IDPesan) as hasil FROM tb_pemesanan WHERE tb_pemesanan.Status BETWEEN '2' AND '4'")->row();
  }

  public function getJumlahSelesai()
  {
    return $this->db->query("SELECT COUNT(IDPesan) as hasil FROM tb_pemesanan WHERE tb_pemesanan.Status = '5'")->row();
  }

  public function dataPemesanan()
  {
    return $this->db->query("SELECT * FROM tb_pemesanan JOIN tb_umkm_data USING(IDDataUMKM) JOIN tb_umkm USING(IDUMKM) ORDER BY IDPesan DESC limit 5")->result();
  }

  public function dataUMKM()
  {
    return $this->db->query("SELECT * FROM tb_umkm ORDER BY IDUMKM DESC limit 5")->result();
  }

  public function update_status($id,$data)
  {
    $this->db->where('IDPesan',$id);
    $o = $this->db->update('tb_pemesanan',$data);
    return $o;
  }
}
