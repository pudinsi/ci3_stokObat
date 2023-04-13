<?php if ( ! defined('__NAJZMI_PUDINTEA__')) exit('No direct script access allowed');

if ( ! function_exists('tgl_indo'))
{
	function tgl_indo($tgl)
	{
		$ubah = gmdate($tgl, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tanggal = $pecah[2];
		$bulan = bulan($pecah[1]);
		$tahun = $pecah[0];
		return $tanggal.' '.$bulan.' '.$tahun;
	}
}

if ( ! function_exists('bulan'))
{
	function bulan($bln)
	{
		switch ($bln)
		{
			case 1:
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
	}
}

if ( ! function_exists('nama_hari'))
{
	function nama_hari($tanggal)
	{
		$ubah = gmdate($tanggal, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tgl = $pecah[2];
		$bln = $pecah[1];
		$thn = $pecah[0];

		$nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
		$nama_hari = "";
		if($nama=="Sunday") {$nama_hari="Ahad";}
		else if($nama=="Monday") {$nama_hari="Senin";}
		else if($nama=="Tuesday") {$nama_hari="Selasa";}
		else if($nama=="Wednesday") {$nama_hari="Rabu";}
		else if($nama=="Thursday") {$nama_hari="Kamis";}
		else if($nama=="Friday") {$nama_hari="Jumat";}
		else if($nama=="Saturday") {$nama_hari="Sabtu";}
		return $nama_hari;
	}
}

if ( ! function_exists('kode_hari'))
{
	function kode_hari($tanggal)
	{
		$nama = date("l", strtotime($tanggal));
		$kode_hari = "";
		if($nama=="Sunday") 		{$kode_hari="7";}
		else if($nama=="Monday") 	{$kode_hari="1";}
		else if($nama=="Tuesday") 	{$kode_hari="2";}
		else if($nama=="Wednesday") {$kode_hari="3";}
		else if($nama=="Thursday") 	{$kode_hari="4";}
		else if($nama=="Friday") 	{$kode_hari="5";}
		else if($nama=="Saturday") 	{$kode_hari="6";}
		return $kode_hari;
	}
}

if ( ! function_exists('hari_kode'))
{
	function hari_kode($no_kode)
	{
		$hari = "";
		if($no_kode=="7") 		{$hari="Ahad";}
		else if($no_kode=="1") 	{$hari="Senin";}
		else if($no_kode=="2") 	{$hari="Selasa";}
		else if($no_kode=="3") {$hari="Rabu";}
		else if($no_kode=="4") 	{$hari="Kamis";}
		else if($no_kode=="5") 	{$hari="Jumat";}
		else if($no_kode=="6") 	{$hari="Sabtu";}
		return $hari;
	}
}

if ( ! function_exists('hitung_mundur'))
{
	function hitung_mundur($wkt)
	{
		$waktu=array(	365*24*60*60	=> "tahun",
						30*24*60*60		=> "bulan",
						7*24*60*60		=> "minggu",
						24*60*60		=> "hari",
						60*60			=> "jam",
						60				=> "menit",
						1				=> "detik");

		$hitung = strtotime(gmdate ("Y-m-d H:i:s", time () +60 * 60 * 8))-$wkt;
		$hasil = array();
		if($hitung<5)
		{
			$hasil = 'kurang dari 5 detik yang lalu';
		}
		else
		{
			$stop = 0;
			foreach($waktu as $periode => $satuan)
			{
				if($stop>=6 || ($stop>0 && $periode<60)) break;
				$bagi = floor($hitung/$periode);
				if($bagi > 0)
				{
					$hasil[] = $bagi.' '.$satuan;
					$hitung -= $bagi*$periode;
					$stop++;
				}
				else if($stop>0) $stop++;
			}
			$hasil=implode(' ',$hasil).' yang lalu';
		}
		return $hasil;
	}
}

/*
======================= CARA MENGGUNAKAN ============================
$this->load->helper('Pdn_tgl_indo');
function index()
	{
		echo nama_hari('2010-11-23').' '. tgl_indo('2010-11-23');
		echo "<br>";
		echo hitung_mundur(strtotime('2010-11-23'));
	}
hasilnya
========
Selasa 23 November 2010
1 tahun 7 bulan 1 hari 23 jam 26 menit yang lalu

*/
