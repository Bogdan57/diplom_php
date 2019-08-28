<header class="header header_login">
    <h1><?=Config::TITLE ?></h1>
</header>
<div class="login-content">
    <div class="login-form-wrap">
        <h2 class="login-form-title">Вход</h2>
        <form class="login-form" action="auth.php" method="POST">
            <input type="text" name="login" placeholder="Email" required>
            <br/>
            <input type="password" name="password" placeholder="Пароль" required>
            <br/>
            <input type="submit" value="Войти">
        </form>
    </div>
</div>