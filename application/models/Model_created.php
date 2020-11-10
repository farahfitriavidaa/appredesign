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

	public function idPesan()
	{
		$user	= "PS";
		$nomer	= "SELECT MAX(TRIM(REPLACE(IDPesan,'PS',''))) as a FROM tb_pemesanan WHERE IDPesan
		LIKE '$user%'";
		$baris	= $this->db->query($nomer);
		$akhir	= $baris->row()->a;
		$akhir++;
		$id		= str_pad($akhir, 4, "0", STR_PAD_LEFT);
		$id		= "PS".$id;
		return $id;
	}

	public function idDiskum()
	{
		$user = "DD";
		$nomer = "SELECT MAX(TRIM(REPLACE(IDDiskum,'DD',''))) as a FROM tb_diskusiumkm WHERE IDDiskum
		LIKE '$user%'";
		$baris = $this->db->query($nomer);
		$akhir =  $baris->row()->a;
		$akhir++;
		$id =str_pad($akhir, 4, "0", STR_PAD_LEFT);
		$id = "DD".$id;
		return $id;
	}

	public function idDispro()
	{
		$user = "DR";
		$nomer = "SELECT MAX(TRIM(REPLACE(IDDispro,'DR',''))) as a FROM tb_diskusiproduksi WHERE IDDispro
		LIKE '$user%'";
		$baris = $this->db->query($nomer);
		$akhir =  $baris->row()->a;
		$akhir++;
		$id =str_pad($akhir, 4, "0", STR_PAD_LEFT);
		$id = "DR".$id;
		return $id;
	}

	public function idDataUMKM()
	{
		$user	= "DU";
		$nomer	= "SELECT MAX(TRIM(REPLACE(IDDataUMKM,'$user',''))) as a FROM tb_umkm_data WHERE IDDataUMKM
		LIKE '$user%'";
		$baris	= $this->db->query($nomer);
		$akhir	= $baris->row()->a;
		$akhir++;
		$id		= str_pad($akhir, 4, "0", STR_PAD_LEFT);
		$id		= $user.$id;
		return $id;
	}

	public function idPortofolio()
	{
		$user	= "PRT";
		$nomer	= "SELECT MAX(TRIM(REPLACE(IDPortofolio,'$user',''))) as a FROM tb_portofolio WHERE IDPortofolio
		LIKE '$user%'";
		$baris	= $this->db->query($nomer);
		$akhir	= $baris->row()->a;
		$akhir++;
		$id		= str_pad($akhir, 4, "0", STR_PAD_LEFT);
		$id		= $user.$id;
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

	public function update_pengelola($id,$data)
	{
		$this->db->where('IDUser',$id);
		$o = $this->db->update('tb_pengelola',$data);
		return $o;
	}

	public function update_user($id,$data)
	{
		$this->db->where('IDUser',$id);
		$o = $this->db->update('tb_user',$data);
		return $o;
	}

	public function update_umkm($id,$data)
	{
		$this->db->where('IDUser',$id);
		$o = $this->db->update('tb_umkm',$data);
		return $o;
	}

	public function update_telkom($id,$data)
	{
		$this->db->where('IDUser',$id);
		$o = $this->db->update('tb_telkom',$data);
		return $o;
	}

	public function login($username,$password)
	{
		return $this->db->query("SELECT * FROM tb_user WHERE username='$username' AND password='$password'")->row();
	}

}
