<?php

spl_autoload_register(function ($classname) {



  $class = '../app/controllers/' . $classname . '.php';

  if (file_exists($class)) {
    require $class;
  } else {
    $class = '../app/models/' . $classname . '.php';
    require $class;

  }
});


require 'config.php';
require 'functions.php';
require 'Database.php';
require 'Model.php';
require 'Controller.php';
require 'Router.php';

