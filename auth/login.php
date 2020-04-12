<?php
include __DIR__.'/config.php';

if(!AUTH) {
  //мы еще не авторизованы
  if(!empty($_POST['login']) && !empty($_POST['password']) && isset($users[$_POST['login']])) {
      //передали данные для входа и логин существует
      if($users[$_POST['login']]['password'] == getPassword($_POST['password'])) {
          //пароль совпадает
          $_SESSION['user'] = $_POST['login'];

          if(isset($_POST['remember'])) {
            //стоит галка "запомнить меня"
            setcookie('login', $_POST['login'], time() + 3600 * 24 * 365, '/');
            setcookie('password', getPassword($users[$_POST['login']]['password']), time() + 3600 * 24 * 365, '/');
          }

      }
  }
  if(!isset($_SESSION['user']) || $_SESSION['user'] != $_POST['login']) {
    //авторизация не прошла, сохраним ошибку
    $_SESSION['message'] = 'Неверный логин или пароль';
  }
} else {
    if(isset($_GET['logout'])) { //выход из системы
        unset($_SESSION['user']);
        setcookie('login', '', time() - 3600 * 24 * 365, '/');
        setcookie('password', '', time() - 3600 * 24 * 365, '/');
    }
}

header('Location: index.php'); //переходим на главную страницу