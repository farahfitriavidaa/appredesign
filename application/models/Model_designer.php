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

    public function getDaftarPortofolio($id_designer)
    {
        return $this->db->query("SELECT * FROM tb_portofolio WHERE IDDesigner='$id_designer'")->result();
    }

    public function getPortofolio($id_portofolio)
    {
        return $this->db->query("SELECT * FROM tb_portofolio WHERE IDPOrtofolio='$id_portofolio'")->row();
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
}