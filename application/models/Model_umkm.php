<?php

class Model_umkm extends CI_Model {

  public function cekAkun($user)
  {
    return $this->db->query("SELECT * FROM tb_user WHERE username='$user'")->row();
  }
}