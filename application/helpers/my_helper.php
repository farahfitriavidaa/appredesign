<?php defined('BASEPATH') OR exit('No direct script access allowed');

if( ! function_exists('trimId')){
	/**
	 * Function untuk memotong id, contoh: US0015 menjadi 15
	 *
	 * @param string Prefiks(awalan) id: US/PS/UM/PG/dll
	 * @param string Id yang mau dipotong
	 * @return string
	 */
	function trimId(String $prefix, String $id)
	{
		$return   = str_replace($prefix, '', $id);
		for ($i=0; $i < strlen($return); $i++) {
			if ($return[$i] === '0')
				$return = ltrim($return, '0');
			else
				break;
		}
		return $return;
	}
}

if ( ! function_exists('uploadFoto')) {
	/**
	 * Function untuk upload file gambar
	 *
	 * @param string Isi atribut <pre>name</pre> pada input file. <input name="...">
	 * @param string Nama folder yang dituju untuk menyimpan file
	 * @return string Pesan sukses atau error
	 */
	function uploadFoto(String $img, String $dir)
	{
		$jenis_foto		= str_replace('-', ' ', $img);
		$target_dir 	= './uploads/'.$dir.'/';

		$target_file	= $target_dir.basename($_FILES[$img]['name']);
		$imageFileType	= strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		$check 			= getimagesize($_FILES[$img]['tmp_name']);

		if($check == false) {
			return 'Jenis file '.$jenis_foto.' tidak didukung. Coba ulangi memasukan foto atau gambar.';
		}

		if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif' ) {
		 	return 'Hanya format JPG, JPEG, PNG, dan GIF yang diperbolehkan untuk file '.$jenis_foto.'.';
		}

		if ($_FILES[$img]['size'] > 65000000) {
			return 'Ukuran gambar '.$jenis_foto.' Anda terlalu besar(lebih dari 650MB).';
		}

		if (move_uploaded_file($_FILES[$img]['tmp_name'], $target_file)) {
			return 'sukses';
		} else {
			return 'Maaf, terdapat kesalahan dalam meng-upload file. Coba ulangi lagi';
		}
	}
}

if ( ! function_exists('flattenArray')) {
	/**
	 * Function untuk menyederhanakan array
	 *
	 * Membuat array associative atau object result() dari database menjadi array numeric
	 *
	 * @param array Array yang ingin disederhanakan
	 * @return array
	 */
	function flattenArray(array $old_array)
	{
		$new_array = array();
		array_walk_recursive($old_array, function($a) use (&$new_array) { $new_array[] = $a; });
		return $new_array;
	}
}

if ( ! function_exists('cetakWaktu')) {
	/**
	 * Function untuk mencetak timestamp/waktu yang sudah diformat. Contoh: 07.30, Kemarin, 31 Oct
	 *
	 * @param string waktu yang mau dicetak
	 * @return string waktu yang sudah terformat
	 */
	function cetakWaktu(String $timestamp)
	{
		$timestamp 		= strtotime($timestamp);

		$tgl_waktu  	= date_create(date('Y-m-d', $timestamp));
		$hari_ini   	= date_create('today');
		$jarak_waktu	= date_diff($hari_ini, $tgl_waktu);
		$waktu			= '';

		switch ($jarak_waktu->format('%R%a')) {
			case 0:
				$waktu = date('H.i', $timestamp);
				break;
			case -1:
				$waktu = "Kemarin";
				break;
			default:
				$waktu = date('d M', $timestamp);
				break;
		}
		return $waktu;
	}
}