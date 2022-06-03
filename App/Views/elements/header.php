<p><a href='/'>Главная</a></p>
<p><a href='/news'>Новости</a></p>
<p><a href='/about'>О нас</a></p>

<?php if (!$_POST['isAuthorized']){ ?>

    <p><a href='/login'>Вход</a></p>
    <p><a href='/signup'>Регистрация</a></p>

<?php }else{?>

    <p><a href='/info/secret'>Секретная страница</a></p>
    <p><a href='/exit'>Выход</a></p>

<?php } ?>

<hr>