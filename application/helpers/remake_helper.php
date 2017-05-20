<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('debug'))
{

	function debug($var)
	{
		var_dump($var);
		exit();
	}
}

if ( ! function_exists('date_converter'))
{

	function date_converter($var)
	{
		$date = '';
		if ($dt = \DateTime::createFromFormat('d/m/Y', $var)) {
			$date = $dt->format('Y-m-d');
		}
		else if ($dt = \DateTime::createFromFormat('Y-m-d', $var)) {
			$date = $dt->format('d/m/Y');
		}

		
		return $date;
	}
}


if ( ! function_exists('currentUser'))
{

	function currentUser($variable)
	{
		$CI =& get_instance();
		$CI->load->library('ion_auth');
		return $CI->ion_auth->user()->row_array()[$variable];
	}
}


if ( ! function_exists('recursive'))
{

	
	function recursive(array $array, $list_open = false)
	{
		$html = '';
		foreach ($array as $item) {
			if (is_array($item)) {
				$html .= "<ul>\n";
				$html .= recursive($item, true);
				$html .= "</ul>\n";
				$list_open = false;
			} else {
				if (!$list_open) {
					$html .= "<ul cicak>\n";
					$list_open = true;
				}
				$html .= "\t<li>$item</li>\n";
			}
		}
		if ($list_open) $html .= "</ul>\n";
		return $html;
	}

}


if ( ! function_exists('showNotificationToastr'))
{

	function showNotificationToastr($typeOfMessage,$message)
	{
		$toastr = '<script>';
		$toastr .= 'toastr.options = {';
		$toastr .= '	"closeButton": false,';
		$toastr .= '	"debug": false,';
		$toastr .= '	"newestOnTop": false,';
		$toastr .= '	"progressBar": false,';
		$toastr .= '	"positionClass": "toast-top-center",';
		$toastr .= '	"preventDuplicates": true,';
		$toastr .= '	"onclick": null,';
		$toastr .= '	"showDuration": "0",';
		$toastr .= '	"hideDuration": "0",';
		$toastr .= '	"timeOut": "1000",';
		$toastr .= '	"extendedTimeOut": "0",';
		$toastr .= '	"showEasing": "swing",';
		$toastr .= '	"hideEasing": "linear",';
		$toastr .= '	"showMethod": "fadeIn",';
		$toastr .= '	"hideMethod": "fadeOut" },';
		$toastr .= '	toastr["'.$typeOfMessage.'"]("'.$message.'")';
		$toastr .= '</script>';

		return $toastr;
	}

}

if ( ! function_exists('showNotificationInspinia'))
{

	function showNotificationInspinia($typeOfMessage,$message)
	{
		$inspinia = '  
		<div class="alert alert-'.$typeOfMessage.' alert-dismissable">
			<button aria-hidden="true" 
			data-dismiss="alert" 
			class="close" 
			type="button">×</button>
			'.$message.'
			
		</div>
		';

		return $inspinia;
	}

}