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
}