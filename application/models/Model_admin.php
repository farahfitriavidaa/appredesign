<?php

class Model_admin extends CI_Model {

  public function cekAkun($user)
  {
    return $this->db->query("SELECT * FROM tb_user WHERE username='$user'")->row();
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
}
