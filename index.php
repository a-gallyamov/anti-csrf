<?php

  ini_set('error_reporting', E_ALL);
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);

  require_once(dirname(__FILE__).'/src/ag-scrf.php');

  $csrf = new ag_csrf;

  /* Simple example */
  if(isset($_POST['go'])){

    if( $csrf->check_token($_POST['hash']) ){
      echo 'Ok';
    }else{
      echo 'Err. Try again';
    }

  }
 ?>

 <!DOCTYPE html>
 <html>
 <head>
   <meta charset="UTF-8" />
   <?=$csrf->meta();?>
   <title>PHP Class Anti Cross-Site Request Forgery (CSRF)</title>
 </head>
 <body>
   <form method="POST">
     <input type="text" name="log" />
     <input type="text" name="pass" />
     <input type="hidden" name="hash" value="<?=$csrf->get_token();?>" />

     <button type="submit" name="go">Go</button>
   </form>
 </body>
 </html>
