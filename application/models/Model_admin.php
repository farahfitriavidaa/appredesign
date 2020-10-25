<?php

class Model_admin extends CI_Model {

  public function cekAkun($user)
  {
    return $this->db->query("SELECT * FROM tb_user WHERE username='$user'")->row();
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
    return $this->db->query("SELECT * FROM tb_user JOIN tb_umkm USING(IDUser) JOIN tb_pemesanan USING(IDUMKM) JOIN tb_pengelola USING(IDPengelola) JOIN tb_desainer USING(IDDesigner)")->result();
  }

  public function getDataaUMKM()
  {
    return $this->db->query("SELECT * FROM tb_umkm_data JOIN tb_umkm USING(IDUMKM)")->result();
  }

  public function getDataUMKM($idumkm)
  {
    return $this->db->query("SELECT * FROM tb_umkm_data WHERE IDUMKM = '$idumkm'")->result();
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

  public function delete_dataumkm($id)
  {
    $this->db->where('IDDataUMKM',$id);
    return $this->db->delete('tb_umkm_data');
  }
}
