<?php
if(!function_exists('hash_equals')){
  function hash_equals($str1, $str2){
    if(strlen($str1) != strlen($str2)){
      return false;
    }else{
      $res = $str1 ^ $str2;
      $ret = 0;
      for($i = strlen($res) - 1; $i >= 0; $i--){
        $ret |= ord($res[$i]);
      }
      return !$ret;
    }
  }
}

class ag_csrf{
  private $last_token;
  public $tkn;

  function __construct()
  {
    if (!isset($_SESSION)) session_start();
    if(isset($_SESSION['csrf_token'])) $this->last_token = $_SESSION['csrf_token'];
    $this->tkn = $this->gen_token();
  }

  public function gen_token(){
    $tkn = sha1('csrf-defender'.openssl_random_pseudo_bytes(30).session_id());
    $_SESSION['csrf_token'] = $tkn;
    return $tkn;
  }

  public function get_token(){
    return $this->tkn;
  }

  public function check_token($token=''){
    $c = hash_equals($this->last_token, $token) ? true : false;
    return $c;
  }

  public function meta($name = 'csrf-token'){
    return '<meta name="'.$name.'" content="'.$this->tkn.'" />';
  }
}
?>
