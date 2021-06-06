<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Salt_key {
  public function get_key() {
        $key = '$1$Nic7x1Ni$MTN7YT.nEDSeYRlKtkjAx.';//'dive_apa_salt_enc';
        return $key;
  }
}