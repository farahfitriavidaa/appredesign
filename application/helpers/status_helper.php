<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Helper untuk mencetak badge status
 * 
 * Halaman-halaman yang memanggil function cetakStatus() (Designer):
 * - dashboard 2x
 * - lihatrequest 
 * - request
 * - lihat diskusi
 * - diskusi
 * 
 */

if ( ! function_exists('cetakStatus')) {
	/**
	 * Function untuk mencetak badge status request
	 * 
	 * @param String id status dari request
	 * @param boolean badge status mau float ke kanan atau tidak?
	 * 
	 */
	function cetakStatus(int $idStatus, bool $float=true)
	{
		switch($idStatus){
			case 1:
				$status = 'Request baru';
				$badge  = 'info';
				break;
			case 2:
				$status = 'Mulai dikerjakan';
				$badge  = 'warning';
				break;
			case 3:
				$status = 'Selesai didesain';
				$badge  = 'light';
				break;
			case 4:
				$status = 'Review hasil';
				$badge  = 'light';
				break;
			case 5:
			case 6:
			case 7:
				$status = 'Desain disetujui';
				$badge  = 'success';
				break;
			case 8:
				$status = 'Cancel';
				$badge  = 'danger';
				break;
			default:
				$status = 'Unknown';
				$badge  = 'light';
				break;
		}

		// <span class="$float? $badge"> $status </span>
		$floatClass = $float ? 'float-right' : ' ';

		echo "<span class=\"$floatClass badge badge-$badge\" style=\"font-size:unset\"> $status </span>";
	}
}

/**
 * 
 * Halaman-halaman yang memanggil function cetakStatusLengkap():
 * - dashboard 2x
 * - lihatrequest 
 * - detilrequest
 * - lihat diskusi
 * - diskusi
 * 
 */

if ( ! function_exists('cetakStatusLengkap')) {
	/**
	 * Function untuk mencetak badge status request
	 * 
	 * @param String id status dari request
	 * @param boolean badge status mau float ke kanan atau tidak?
	 * 
	 */
	function cetakStatusLengkap(int $idStatus, bool $float=true)
	{
		switch($idStatus){
			case 0:
				$status = "Pending";
				$badge  = "light";
				break;
			case 1:
				$status = "Telah didiskusikan";
				$badge  = "light";
				break;
			case 2:
				$status = "Mulai dikerjakan desainer";
				$badge  = "light";
				break;
			case 3:
				$status = "Selesai didesain";
				$badge  = "info";
				break;
			case 4:
				$status = "Review hasil";
				$badge  = "info";
				break;
			case 5:
				$status = "Desain disetujui";
				$badge  = "info";
				break;
			case 6:
				$status = "Belum dibayar";
				$badge  = "warning";
				break;
			case 7:
				$status = "Lunas";
				$badge  = "success";
				break;
			case 8:
				$status = "Cancel";
				$badge  = "danger";
				break;
			default:
				$status = "Pending";
				$badge  = "light";
				break;
		}

		// <span class="$float? $badge"> $status </span>
		$floatClass = $float ? 'float-right' : ' ';

		echo "<span class=\"$floatClass badge badge-$badge\" style=\"font-size:unset\"> $status </span>";
	}
}

