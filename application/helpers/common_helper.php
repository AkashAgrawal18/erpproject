<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

/**

 * CodeIgniter

 *

 * An open source application development framework for PHP 5.1.6 or newer

 *

 * @package		CodeIgniter

 * @author		ExpressionEngine Dev Team

 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.

 * @license		http://codeigniter.com/user_guide/license.html

 * @link		http://codeigniter.com

 * @since		Version 1.0

 * @filesource

 */



if (! function_exists('get_settings')) {

  function get_settings($key = '')
  {
    $CI  = &get_instance();



    $CI->db->select($key);

    $sql = $CI->db->get('application_settings');



    if ($sql->num_rows() == 1) {
      return $sql->result()[0]->$key;
    } else {
      return '';
    }
  }
}

if (! function_exists('get_rate_band')) {

  function get_rate_band($code = '', $type = '')
  {
    $CI  = &get_instance();
    if (!empty($type)) {
      $CI->db->where('tbs_type', $type);
    }
    $CI->db->select('tbs_value')->where('tbs_code', $code);
    $sql = $CI->db->get('ticket_band_setting');
    if ($sql->num_rows() == 1) {
      return $sql->result()[0]->tbs_value;
    } else {
      return '';
    }
  }
}


if (! function_exists('has_perm')) {

  function has_perm($userid, $module = '', $submodule = '', $field = '')
  {
    $CI = &get_instance();

    if (!empty($module)) {
      $CI->db->where('m_userperm_module', $module);
    }

    if (!empty($submodule)) {
      $CI->db->where('m_userperm_submodule', $submodule);
    }

    $validFields = [
      'List' => 'm_userperm_list',
      'Edit' => 'm_userperm_edit',
      'Delete' => 'm_userperm_delete',
      'Add' => 'm_userperm_add',
      'Filter' => 'm_userperm_filter',
      'Export' => 'm_userperm_export',
    ];

    if (isset($validFields[$field])) {
      $CI->db->where($validFields[$field], 1);
    }

    $query = $CI->db->select('m_userperm_id')
      ->where('m_userperm_userId', $userid)
      ->get('master_user_permission_tbl');

    return $query->row(); // Returns row object if found, otherwise null
  }
}



if (! function_exists('currency')) {

  function currency($price = "")
  {

    $CI  = &get_instance();

    $CI->load->database();

    if ($price != "") {

      $CI->db->where('key', 'system_currency');

      $currency_code = $CI->db->get('settings')->row()->value;



      $CI->db->where('code', $currency_code);

      $symbol = $CI->db->get('currency')->row()->symbol;



      $CI->db->where('key', 'currency_position');

      $position = $CI->db->get('settings')->row()->value;



      if ($position == 'right') {

        return $price . ' ' . $symbol;
      } elseif ($position == 'right-space') {

        return $price . ' ' . $symbol;
      } elseif ($position == 'left') {

        return $symbol . ' ' . $price;
      } elseif ($position == 'left-space') {

        return $symbol . ' ' . $price;
      }
    }
  }
}



if (! function_exists('currency_code_and_symbol')) {

  function currency_code_and_symbol($type = "")
  {

    $CI  = &get_instance();

    $CI->load->database();

    $CI->db->where('key', 'system_currency');

    $currency_code = $CI->db->get('settings')->row()->value;



    $CI->db->where('code', $currency_code);

    $symbol = $CI->db->get('currency')->row()->symbol;

    if ($type == "") {

      return $symbol;
    } else {

      return $currency_code;
    }
  }
}



if (! function_exists('get_frontend_settings')) {

  function get_frontend_settings($key = '')
  {

    $CI  = &get_instance();

    $CI->load->database();



    $CI->db->where('key', $key);

    $result = $CI->db->get('frontend_settings')->row()->value;

    return $result;
  }
}



if (! function_exists('slugify')) {

  function slugify($text)
  {

    $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

    $text = trim($text, '-');

    $text = strtolower($text);

    $text = preg_replace('~[^-\w]+~', '', $text);

    if (empty($text))

      return 'n-a';

    return $text;
  }
}



if (! function_exists('get_video_extension')) {

  // Checks if a video is youtube, vimeo or any other

  function get_video_extension($url)
  {

    if (strpos($url, '.mp4') > 0) {

      return 'mp4';
    } elseif (strpos($url, '.webm') > 0) {

      return 'webm';
    } else {

      return 'unknown';
    }
  }
}



if (! function_exists('ellipsis')) {

  // Checks if a video is youtube, vimeo or any other

  function ellipsis($long_string, $max_character = 30)
  {

    $short_string = strlen($long_string) > $max_character ? substr($long_string, 0, $max_character) . "..." : $long_string;

    return $short_string;
  }
}

if (!function_exists('convert_number_to_words')) {
  function convert_number_to_words($number) {
      $words = array(
          '0'=> '', '1'=> 'One', '2'=> 'Two', '3'=> 'Three', '4'=> 'Four', '5'=> 'Five',
          '6'=> 'Six', '7'=> 'Seven', '8'=> 'Eight', '9'=> 'Nine', '10'=> 'Ten',
          '11'=> 'Eleven', '12'=> 'Twelve', '13'=> 'Thirteen', '14'=> 'Fourteen',
          '15'=> 'Fifteen', '16'=> 'Sixteen', '17'=> 'Seventeen', '18'=> 'Eighteen', '19'=> 'Nineteen',
          '20'=> 'Twenty', '30'=> 'Thirty', '40'=> 'Forty', '50'=> 'Fifty',
          '60'=> 'Sixty', '70'=> 'Seventy', '80'=> 'Eighty', '90'=> 'Ninety'
      );

      $digits = ['', 'Hundred', 'Thousand', 'Lakh', 'Crore'];
      $number = round($number, 2);
      $numArr = explode('.', number_format($number, 2, '.', ''));
      $no = (int) $numArr[0];
      $point = (int) $numArr[1];

      $str = [];
      $i = 0;

      while ($no > 0) {
          $divider = ($i == 2) ? 10 : 100;
          $rem = $no % $divider;
          $no = floor($no / $divider);
          if ($rem) {
              $part = '';
              if ($rem < 21) {
                  $part = $words[$rem];
              } else {
                  $part = $words[floor($rem / 10) * 10] . ' ' . $words[$rem % 10];
              }
              $str[] = trim($part . ' ' . $digits[$i]);
          }
          $i++;
      }

      $result = implode(' ', array_reverse($str));
      $result = trim($result) . ' Rupees';

      if ($point > 0) {
          $paise = ($point < 21) ? $words[$point] :
              $words[floor($point / 10) * 10] . ' ' . $words[$point % 10];
          $result .= ' and ' . trim($paise) . ' Paise';
      }

      return $result;
  }
}

// ------------------------------------------------------------------------

/* End of file user_helper.php */

/* Location: ./system/helpers/common.php */
