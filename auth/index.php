<?php include __DIR__.'/config.php'; ?>
<html>
<head>
    <title>Пример авторизации на сайте</title>
</head>
<body>

<?php if(AUTH) { //Если мы авторизированы ?>

    Привет, <?php echo $user['name']; ?>!
    <a href="login.php?logout">Выход</a>

<?php } else { //Если мы не авторизированы  ?>

<form action="login.php" method="post">
    <p>Имя пользователя: <input type="text" name="login" /></p>
    <p>Пароль: <input type="password" name="password" /></p>
    <p>Запомнить меня: <input type="checkbox" name="remember" /></p>
    <?php if(!empty($message)) { ?>
    <p><?php echo $message; ?></p>
    <?php } ?>
    <p><input type="submit" value="Вход" /></p>
</form>

<?php } ?>

</body>
</html>