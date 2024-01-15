<?php

if ($_SERVER['SERVER_NAME'] === 'localhost') {

  /** database config **/
  define('DB_NAME', 'papa_noel');
  define('DB_HOST', 'localhost');
  define('DB_USER', 'admin');
  define('DB_PASSWORD', 'Unexposed6-Urology-Uniformly');

  define("ROOT", "http://localhost/public"); // For Local
} else {

  /** database config **/
  define('DB_NAME', '');
  define('DB_HOST', '');
  define('DB_USER', '');
  define('DB_PASSWORD', '');

  define("ROOT", "https://www.yoursite.com"); // For deploy

}


define("APP_NAME", "Le site du Papa Noel");
define("APP_DESC", "Description of website");

define('ORDER_ASC', "asc");
define("ORDER_DESC", "desc");

/** true means show errors  */
define('DEBUG', true);


define('HTTP_OK', 200);
define('HTTP_BAD_REQUEST', 400);
define('HTTP_METHOD_NOT_ALLOWED', 405);


define('DESTINATION_IMAGE_FOLDER', 'uploads/');
define('MAX_FILE_SIZE', 1e+7);
define('ALLOWED_EXTENSIONS_FILE', ['png', 'jpeg', 'jpg']);