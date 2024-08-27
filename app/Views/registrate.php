<form action="/registrate" method="POST">

    <div class="container">
        <h1>Регистрация</h1>
        <p>Пожалуйста, заполните поля для создания аккаунта.</p>
        <hr>

        <label for="name">Имя</label>
        <input type="text" placeholder="Введите имя пользователя" name="name" id="name" required>
        <?php if (isset($errors['name'])): ?>
            <label style="color: red"><?php echo $errors['name']; ?></label>
        <?php endif; ?>
        <br>

        <label for="phone">Телефон</label>
        <input type="tel" placeholder="Формат: 81234567890" name="phone" id="phone" pattern="[1-9]{1}[0-9]{10}" required>
        <?php if (isset($errors['phone'])): ?>
            <label style="color: red"><?php echo $errors['phone']; ?></label>
        <?php endif; ?>
        <br>

        <label for="email">Электронная почта</label>
        <input type="email" placeholder="Введите электронную почту" name="email" id="email" required>
        <?php if (isset($errors['email'])): ?>
            <label style="color: red"><?php echo $errors['email']; ?></label>
        <?php endif; ?>
        <br>

        <label for="password">Пароль</label>
        <input type="password" placeholder="Введите пароль" name="password" id="password" required>
        <?php if (isset($errors['password'])): ?>
            <label style="color: red"><?php echo $errors['password']; ?></label>
        <?php endif; ?>
        <br>

        <label for="password-repeat">Повторите пароль</label>
        <input type="password" placeholder="Повторите пароль" name="password-repeat" id="password-repeat" required>
        <?php if (isset($errors['password-repeat'])): ?>
            <label style="color: red"><?php echo $errors['password-repeat']; ?></label>
        <?php endif; ?>
        <br><br>

        <button type="submit" class="registerbtn">Зарегистрироваться</button>
        <hr>
        <p>Уже есть аккаунт? <a href="/login">Войти</a></p>
        <p>Вернуться на <a href="/main">главную страницу</a></p>
    </div>

</form>

