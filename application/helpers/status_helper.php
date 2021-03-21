<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Halaman-halaman yang memanggil function cetakStatus():
 * - dashboard 2x
 * - lihatrequest 
 * - detilrequest
 * - lihat diskusi
 * - diskusi
 * 
 */

if ( ! function_exists('cetakStatus')) {
	/**
	 * Function untuk mencetak badge status request
	 * 
	 * @param    String    $idStatus   id status dari request
	 * @param    String    $level      level
	 * @param    Boolean   $float      status mau float ke kanan atau tidak?
	 * 
	 */
	function cetakStatus(String $idStatus, String $level, bool $float = true)
	{	
		$status = array(
			'admin'    => array('Pending', 'Permintaan Design Fix', 'On Going', 'Design Fix', 'Review Hasil', 'Pemesanan Fix', 'Belum Dibayar', 'Lunas', 'Cancel'),
			'umkm'     => array('Pending', 'Telah didikusikan', 'Mulai dikerjakan dessainer', 'Selesai didesain', 'Review Hasil', 'Desain disetujui', 'Belum Dibayar', 'Lunas', 'Cancel'),
			'designer' => array('Unknown', 'Request baru', 'Mulai dikerjakan', 'Selesai didesain', 'Review Hasil', 'Desin disetuji', 'Cancel')
		);

		switch($idStatus){
			case 0:
				$status_ = $status[$level][$idStatus];
				$badge   = 'light';
				break;
			case 1:
				$status_ = $status[$level][$idStatus];
				$badge   = 'light';
				break;
			case 2:
				$status_ = $status[$level][$idStatus];
				$badge   = 'light';
				break;
			case 3:
				$status_ = $status[$level][$idStatus];
				$badge   = 'info';
				break;
			case 4:
				$status_ = $status[$level][$idStatus];
				$badge   = 'info';
				break;
			case 5:
				if ($level === 'designer')
					$status_ = $status[$level][5];
				else
					$status_ = $status[$level][$idStatus];
				$badge   = 'info';
				break;
			case 6:
				if ($level === 'designer')
					$status_ = $status[$level][5];
				else
					$status_ = $status[$level][$idStatus];
				$badge  = 'warning';
				break;
			case 7:
				if ($level === 'designer')
					$status_ = $status[$level][5];
				else
					$status_ = $status[$level][$idStatus];
				$badge  = 'success';
				break;
			case 8:
				if ($level === 'designer')
					$status_ = $status[$level][6];
				else
					$status_ = $status[$level][$idStatus];
				$badge  = 'danger';
				break;
			default:
				$status_ = 'Unknown';
				$badge   = 'light';
				break;
		}

		// <span class='$float? $badge'> $status_ </span>
		$floatClass = $float ? 'float-right' : ' ';

		return '<span class="'.$floatClass.' badge badge-'.$badge.'" style="font-size:unset;">'.$status_.'</span>';
	}
}

