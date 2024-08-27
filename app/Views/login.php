<form action="/login" method="POST">

    <header>
        <script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>
    </header>
    <div class="container">
        <h1>Логин</h1>
        <p>Пожалуйста, заполните поля для входа в аккаунт.</p>
        <hr>

        <label for="identity_field">Электронная почта или телефон</label>
        <input type="text" placeholder="Введите почту или пароль" name="identity_field" required>
        <?php if (isset($errors['identity_field'])): ?>
            <label style="color: red"><?php echo $errors['identity_field']; ?></label>
        <?php endif; ?>
        <br>

        <label for="password">Пароль</label>
        <input type="password" placeholder="Введите пароль" name="password" required>
        <?php if (isset($errors['password'])): ?>
            <label style="color: red"><?php echo $errors['password']; ?></label>
        <?php endif; ?>
        <br><br>

        <div id="captcha-container"
             class="smart-captcha"
             data-sitekey="ysc1_VyTK7l8qUTFZJ3rpp2NHI7apTkvtN39T4GE3WKwW081a37da"
        ><input type="hidden" name="smart-token" value="<токен>">
        </div>
        <?php if (isset($errors['captcha'])): ?>
            <label style="color: red"><?php echo $errors['captcha']; ?></label>
        <?php endif; ?>
        <br>

        <button type="submit">Войти</button>
        <hr>
        <p>Нет аккаунта? <a href="/registrate">Создать</a></p>
        <p>Вернуться на <a href="/main">главную страницу</a></p>
    </div>

</form>
