<?php

use App\Models\Metadata;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route as FacadesRoute;
use Illuminate\Support\Str;

/**
 * theme asset url
 *
 * @param mixed $theme_name
 * @param mixed $path_file
 * @author Almazari <almazary@jogjacamp.co.id>
 */
function theme_asset($theme_name, $path_file = null) {
    /**
     * kalo pakai namespace backend, contoh: backend::default berarti arahkan ke folder backend
     */
    $backend_folder = '';
    if (Str::startsWith($theme_name, 'backend::')) {
        $backend_folder = "backend/";
        $theme_name = str_replace("backend::", "", $theme_name);
    }

    return url(Str::finish("themes/{$backend_folder}" . ltrim($theme_name, '/'), '/') . ltrim($path_file, '/'));
}


/**
 * theme_field_value untuk mendapatkan value field theme config
 *
 * @param mixed $theme_name
 * @param mixed $field_key
 * @author Almazari <almazary@jogjacamp.co.id>
 */
function theme_field_value($field_key) {
  /**
   * cari di database
   */
  $m = new Metadata();
  $k = "theme::{$field_key}";
  $v = $m->getValueByKey($k);

  $config = config('view');
  /**
   * jika null, coba cek di file config.php
   */
  if (is_null($v) OR $v == '') {
      return Arr::get($config, "fields.{$field_key}.default");
  }

  return $v;
}


/**
 * generalSetting untuk mendapatkan data general setting
 *
 * @param mixed $key
 * @author Almazari <almazary@jogjacamp.co.id>
 */
function general_setting($key = null) {
  $cache_key = Metadata::GENERAL;

  $data = Cache::rememberForever($cache_key, function () {
      return Metadata::getValueByKey(Metadata::GENERAL);
  });

  return ($key) ? optional($data)->$key : $data;
}

function theme_asset_public($theme_name, $path_file = null) {
  /**
   * kalo pakai namespace backend, contoh: backend::default berarti arahkan ke folder backend
   */
  $backend_folder = '';
  if (Str::startsWith($theme_name, 'frontend::')) {
      $backend_folder = "frontend/";
      $theme_name = str_replace("frontend::", "", $theme_name);
  }

  return url(Str::finish("themes/{$backend_folder}" . ltrim($theme_name, '/'), '/') . ltrim($path_file, '/'));
}

function showDateTime($carbon, $format = "d M Y @ H:i") {
    $parse = $carbon->tz('Asia/Jakarta');
    return $parse->translatedFormat($format);
}

/**
 * simpleParser untuk memparsing template email
 *
 * @author Almazari <almazary@jogjacamp.co.id>
 */
function simple_parser($string, $data) {
  $arr_old = [];
  $arr_new = [];
  foreach ($data as $key => $value) {
      $arr_old[] = '{' . $key . '}';
      $arr_new[] = $value;
  }
  return str_replace($arr_old, $arr_new, $string);
}

/**
 * definisi default lang
 * @author Almazari <almazary@jogjacamp.co.id>
 */
function default_lang() {
    return 'id';
}

/**
 * sessionLang untuk mengambil/mengatur session language yang aktif
 *
 * @param mixed $update_to
 * @author Almazari <almazary@jogjacamp.co.id>
 */
function session_lang($update_to = null) {
    if (! is_null($update_to)) {
        $allow = ['en', 'id'];

        /**
         * jika tidak ada dalam daftar, defaultkan
         */
        if (! in_array($update_to, $allow)) {
            $update_to = default_lang();
        }

        session(['lang' => $update_to]);
    }

    return session('lang', default_lang());
}

function set_active($uri, $output = 'active')
{
 if( is_array($uri) ) {
   foreach ($uri as $u) {
     if (FacadesRoute::is($u)) {
       return $output;
     }
   }
 } else {
   if (FacadesRoute::is($uri)){
     return $output;
   }
 }
}

function set_active_open($uri, $output = 'menu-open')
{
 if( is_array($uri) ) {
   foreach ($uri as $u) {
     if (FacadesRoute::is($u)) {
       return $output;
     }
   }
 } else {
   if (FacadesRoute::is($uri)){
     return $output;
   }
 }
}