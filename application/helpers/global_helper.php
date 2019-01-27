<?php defined('BASEPATH') OR exit('No direct script access allowed');

function dateTime($date){
	$int = preg_match("/(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})/",$date,$match);
	if (!$int) return false;
	$data['year']	= $match[1];
	$data['month']	= $match[2];
	$data['day']	= $match[3];
	$data['hour']	= $match[4];
	$data['minute']	= $match[5];
	$data['second']	= $match[6];
	return $data;
}

function dateformatindo($vardate,$type='')
{
	$hari = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
	$bulan = array(1=>'Januari', 2=>'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
	$dywk = date('w',strtotime($vardate));
	$dywk = $hari[$dywk];
	$dy = date('j',strtotime($vardate));
	$d = date('d',strtotime($vardate));
	$mth = date('n',strtotime($vardate));
	$m = date('M',strtotime($vardate));
	$y = date('y',strtotime($vardate));
	$mth = $bulan[$mth];
	$yr = date('Y',strtotime($vardate));
	$hr = date('H',strtotime($vardate));
	$mi = date('i',strtotime($vardate));

	if ($type=='') {
		return $dywk.', '.$dy.' '.$mth.' '.$yr.'';
	} elseif ($type=='1') {
		return $dywk.', '.$dy.' '.$mth.' '.$yr.' - '.$hr.':'.$mi.' WIB';
		//return $d.' '.$mth.' '.$yr.' | '.$hr.':'.$mi.' WIB';
	}elseif($type=='2') {
		return $dy.' '.$mth.' '.$yr.'';
	}elseif($type=='3'){
		return $dywk.', '.$d.' '.$mth.' '.$yr.' '.$hr.':'.$mi;
	}elseif($type=='4'){
		return $dywk.', '.$dy.' '.$mth.' '.$yr ;
	}elseif($type=='5'){
		return $dy.'/'.$m.'/'.$yr.' | '.$hr.':'.$mi.' WIB';
	}elseif($type=='d'){
		return $d;
	}elseif($type=='my'){
		return $m .' '.$y;
	}
}

function facebook_opengraph_meta($opengraph)
{
	$return = '<meta property="og:site_name" content="'.get_setting('SITE_TITLE').'">';
	$return .= "\n";

	foreach ( $opengraph as $key => $value )
	{
		$return .= '<meta property="og:'.$key.'" content="'.$value.'">';
		$return .= "\n";
	}

	return $return;
}

function format_date_atom($date){
	return date('Y-m-d\TH:i:s', strtotime($date)) . substr(date('O',strtotime($date)),0,3) . ':' . substr(date('O',strtotime($date)),3,2);
}

function setting($name='') {

	$ci =& get_instance();

	if (!$ci->db->table_exists('settings')) {
		print "Error! Can't Load Setting Data..";
		return FALSE;
	}

	if (empty($name)) {
		return $name;
	} else {
		$ci->db->select($name)->from('settings');
		$query = $ci->db->get();
		if ($query && $query->num_rows() > 0) {
			$row = $query->row();
			return $row->$name;
		}
		return '';
	}
}
