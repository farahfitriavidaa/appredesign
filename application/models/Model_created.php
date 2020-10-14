<?php

class Model_created extends CI_Model {

	public function idUser()
   {
     $user = "US";
     $nomer = "SELECT MAX(TRIM(REPLACE(IDUser,'US',''))) as a FROM tb_user WHERE IDUser
     LIKE '$user%'";
     $baris = $this->db->query($nomer);
     $akhir =  $baris->row()->a;
     $akhir++;
     $id =str_pad($akhir, 4, "0", STR_PAD_LEFT);
     $id = "US".$id;
     return $id;
   }

	 public function idPengelola()
    {
      $user = "PG";
      $nomer = "SELECT MAX(TRIM(REPLACE(IDPengelola,'PG',''))) as a FROM tb_pengelola WHERE IDPengelola
      LIKE '$user%'";
      $baris = $this->db->query($nomer);
      $akhir =  $baris->row()->a;
      $akhir++;
      $id =str_pad($akhir, 4, "0", STR_PAD_LEFT);
      $id = "PG".$id;
      return $id;
    }

		public function idDesigner()
     {
       $user = "DG";
       $nomer = "SELECT MAX(TRIM(REPLACE(IDDesigner,'DG',''))) as a FROM tb_desainer WHERE IDDesigner
       LIKE '$user%'";
       $baris = $this->db->query($nomer);
       $akhir =  $baris->row()->a;
       $akhir++;
       $id =str_pad($akhir, 4, "0", STR_PAD_LEFT);
       $id = "DG".$id;
       return $id;
     }

		 public function idUMKM()
      {
        $user = "UM";
        $nomer = "SELECT MAX(TRIM(REPLACE(IDUMKM,'UM',''))) as a FROM tb_umkm WHERE IDUMKM
        LIKE '$user%'";
        $baris = $this->db->query($nomer);
        $akhir =  $baris->row()->a;
        $akhir++;
        $id =str_pad($akhir, 4, "0", STR_PAD_LEFT);
        $id = "UM".$id;
        return $id;
      }

			public function idTelkom()
       {
         $user = "CDC";
         $nomer = "SELECT MAX(TRIM(REPLACE(IDTelkom,'CDC',''))) as a FROM tb_telkom WHERE IDTelkom
         LIKE '$user%'";
         $baris = $this->db->query($nomer);
         $akhir =  $baris->row()->a;
         $akhir++;
         $id =str_pad($akhir, 4, "0", STR_PAD_LEFT);
         $id = "CDC".$id;
         return $id;
       }

		public function create_user($data)
		{
			$this->db->insert('tb_user',$data);
		}

		public function create_pengelola($data)
		{
			$this->db->insert('tb_pengelola',$data);
		}

		public function create_design($data)
		{
			$this->db->insert('tb_desainer',$data);
		}

		public function create_umkm($data)
		{
			$this->db->insert('tb_umkm',$data);
		}

		public function create_telkom($data)
		{
			$this->db->insert('tb_telkom',$data);
		}

		public function update_design($id,$data)
 		{
	 		$this->db->where('IDUser',$id);
	 		$o = $this->db->update('tb_desainer',$data);
	 		return $o;
 		}

		public function update_umkm($id,$data)
 		{
	 		$this->db->where('IDUMKM',$id);
	 		$o = $this->db->update('tb_umkm',$data);
	 		return $o;
 		}

		public function update_telkom($id,$data)
		{
			$this->db->where('IDTelkom',$id);
			$o = $this->db->update('tb_telkom',$data);
			return $o;
		}

		public function login($username,$password)
 {
	 return $this->db->query("SELECT * FROM tb_user WHERE username='$username' AND password='$password'")->row();
 }

}