# Simple Anti Cross-Site Request Forgery (CSRF) PHP Class
Простой класс для защиты от межсайтовой подмены запроса.

Инициализация
```php
$csrf = new ag_csrf;
```

Вывод meta-тега (при необходимости)
```php
echo $csrf->meta();

//Также, можно задать альтернативное имя
echo $csrf->meta('another-name');
//<meta name="another-name" content="token" />
```

Вывести токен
```php
$csrf->get_token();
```

Проверка формы (bool)
```php
$csrf->check_token($_POST['hash'])
```

При необходимости, можно сгенерировать новый токен, выполнив
```php
$csrf->gen_token();
```

#### Простой пример:

```html
<?php
require_once(dirname(__FILE__).'/src/ag-scrf.php');
$csrf = new ag_csrf;

/* Simple example */
if(isset($_POST['go']))
{
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
```
