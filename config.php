<?php
header('Content-type: text/html;charset=utf-8');
session_start();

define('SALT', 'As913yr-1u3 -ru1 mr=1r=1 m=0r813'); //рандомная строка

function getPassword($password)
{   //функция получения зашифрованного пароля
    return md5($password.SALT);
}

$users = array( //мы не используем БД, поэтому пользователей храним в массиве
    //пароль = getPassword('password1')
    'login1' => array('password' => '4b0e292e27ee63a490a5214e225999b0', 'name' => 'Имя пользователя'),
    //пароль = getPassword('password2')
    'login2' => array('password' => 'cf4578943c7db66051404d5c2b535c7f', 'name' => 'Имя пользователя 2'),
);

if(!isset($_SESSION['user']) && isset($_COOKIE['login']) && isset($_COOKIE['password'])
    && isset($users[$_COOKIE['login']]) && getPassword($users[$_COOKIE['login']]['password']) == $_COOKIE['password']) {
    //если нет сессии пользователя, но есть куки с пользовательским логином и паролем
    //проходим аторизацию
    $_SESSION['user'] = $_COOKIE['login'];
}

define('AUTH', isset($_SESSION['user']) && isset($users[$_SESSION['user']])); //флаг аторизованы мы или нет
$user = AUTH ? $users[$_SESSION['user']] : null;


$message = '';
if(!empty($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}