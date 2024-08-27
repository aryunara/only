<form action="/profile" method="POST">
    <div class="container">
        <h1>Профиль пользователя</h1>
        <hr>
        <p>Имя: <?php echo $user->getName(); ?></p>
        <p>Телефон: <?php echo $user->getPhone(); ?></p>
        <p>Электронная почта: <?php echo $user->getEmail(); ?></p>
        <hr>

        <p>Заполните поля для изменения данных профиля.</p>

        <input type="hidden" placeholder="Айди пользователя" name="user_id" id="user_id" value="<?php echo $user->getId(); ?>" required>
        <?php if (isset($errors['user_id'])): ?>
            <label style="color: red"><?php echo $errors['user_id']; ?></label>
        <?php endif; ?>

        <label for="name">Новое имя</label>
        <input type="text" placeholder="Введите имя пользователя" name="name" id="name" required>
        <?php if (isset($errors['name'])): ?>
            <label style="color: red"><?php echo $errors['name']; ?></label>
        <?php endif; ?>
        <br>

        <label for="phone">Новый телефон</label>
        <input type="tel" placeholder="Формат: 81234567890" name="phone" id="phone" pattern="[1-9]{1}[0-9]{10}" required>
        <?php if (isset($errors['phone'])): ?>
            <label style="color: red"><?php echo $errors['phone']; ?></label>
        <?php endif; ?>
        <br>

        <label for="email">Новая электронная почта</label>
        <input type="email" placeholder="Введите электронную почту" name="email" id="email" required>
        <?php if (isset($errors['email'])): ?>
            <label style="color: red"><?php echo $errors['email']; ?></label>
        <?php endif; ?>
        <br>

        <label for="password">Новый пароль</label>
        <input type="password" placeholder="Введите пароль" name="password" id="password" required>
        <?php if (isset($errors['password'])): ?>
            <label style="color: red"><?php echo $errors['password']; ?></label>
        <?php endif; ?>
        <br>

        <label for="password-repeat">Повторите новый пароль</label>
        <input type="password" placeholder="Повторите пароль" name="password-repeat" id="password-repeat" required>
        <?php if (isset($errors['password-repeat'])): ?>
            <label style="color: red"><?php echo $errors['password-repeat']; ?></label>
        <?php endif; ?>
        <br><br>

        <button type="submit" class="btn">Изменить данные</button>
        <hr>
        <a href="/logout">Выйти</a>
    </div>
</form>


