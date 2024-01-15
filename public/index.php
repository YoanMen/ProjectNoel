<?php
session_start();

if (!isset($_SESSION['csrf_token']))
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));



require '../app/core/init.php';

DEBUG ? ini_set('display_errors', '1') : ini_set('display_errors', '0');



$router = new Router();

$router->addRoute('GET', ROOT . '/error', '_404', 'index');

$router->addRoute('GET', ROOT . '/', 'HomeController', 'index');
$router->addRoute('POST', ROOT . '/experience', 'HomeController', 'sendExperience');
$router->addRoute('POST', ROOT . '/login', 'ConnectionController', 'login');
$router->addRoute('POST', ROOT . '/letter/loadGifts', 'LetterController', 'loadGifts');
$router->addRoute('POST', ROOT . '/letter/addWantedGift', 'LetterController', 'addWantedGift');
$router->addRoute('POST', ROOT . '/removeWantedGiftfromLetter', 'LetterController', 'removeWantedGift');

$router->addRoute('POST', ROOT . '/giftsroom/detail/addGiftToLetter', 'GiftsroomController', 'addGiftToLetter');
$router->addRoute('POST', ROOT . '/giftsroom/detail/removeGiftfromLetter', 'GiftsroomController', 'removeGiftfromLetter');

$router->addRoute('POST', ROOT . '/addGiftToLetter', 'GiftsroomController', 'addGiftToLetter');
$router->addRoute('POST', ROOT . '/removeGiftfromLetter', 'GiftsroomController', 'removeGiftfromLetter');

$router->addRoute('GET', ROOT . '/letter', 'LetterController', 'index');

$router->addRoute('GET', ROOT . '/admin', 'AdminController', 'index');

$router->addRoute('GET', ROOT . '/admin/user', 'UserAdminController', 'user');
$router->addRoute('POST', ROOT . '/admin/user/add', 'UserAdminController', 'addUser');
$router->addRoute('POST', ROOT . '/admin/user/remove/{:id}', 'UserAdminController', 'deleteUser');

$router->addRoute('GET', ROOT . '/admin/gift', 'GiftAdminController', 'gift');
$router->addRoute('POST', ROOT . '/admin/gift/add', 'GiftAdminController', 'addGift');
$router->addRoute('POST', ROOT . '/admin/gift/remove/{:id}', 'GiftAdminController', 'removeGift');
$router->addRoute('POST', ROOT . '/admin/gift/edit/{:id}', 'GiftAdminController', 'updateGift');

$router->addRoute('POST', ROOT . '/admin/letter/{:id}', 'LetterAdminController', 'letter');
$router->addRoute('POST', ROOT . '/admin/letter/remove/{:id}', 'LetterAdminController', 'removeLetter');
$router->addRoute('POST', ROOT . '/admin/letter/validate/{:id}', 'LetterAdminController', 'validateLetter');


$router->addRoute('GET', ROOT . '/admin/experience', 'ExperienceAdminController', 'experience');
$router->addRoute('POST', ROOT . '/admin/experience/remove/{:id}', 'ExperienceAdminController', 'removeExperience');
$router->addRoute('POST', ROOT . '/admin/experience/validate/{:id}', 'ExperienceAdminController', 'validateExperience');


$router->addRoute('GET', ROOT . '/giftsroom', 'GiftsroomController', 'index');
$router->addRoute('GET', ROOT . '/giftsroom/detail/{:id}', 'GiftsroomController', 'detail');


$router->addRoute('GET', ROOT . '/login', 'ConnectionController', 'index');
$router->addRoute('GET', ROOT . '/logout', 'ConnectionController', 'logout');



$method = $_SERVER['REQUEST_METHOD'];
$uri = 'http://localhost' . $_SERVER['REQUEST_URI'];
$handler = $router->gethandler($method, $uri);



if ($handler == null) {


    redirect('error');

}

$controller = new $handler['controller']();
$action = $handler['action'];
$controller->$action($handler['params']);
