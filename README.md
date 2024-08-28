## Тестовое задание для компании Only

### I. Для того, чтобы подготовить проект к работе:

1) Сбилдите контейнеры:

docker compose build

2) Поднимите контейнеры:

docker compose up -d

3) Подключитесь к базе данных, используя данные из .env файла (host: localhost, port: 5434).

4) Войдите в Query Console и создайте таблицы:

CREATE TABLE users(
id serial primary key,
name varchar(255) not null UNIQUE,
phone varchar(11) not null UNIQUE,
email varchar(255) not null UNIQUE
);

CREATE TABLE user_identity(
id serial primary key,
user_id int references users,
identity_type varchar(255) not null,
identity_field varchar(255) not null UNIQUE,
password varchar(255) not null
);

5) Откройте файл app/Services/YandexCaptchaService.php и на 7 строке вставьте серверный ключ, высланный мной в личном сообщении.

### II. Теперь в браузере доступны следующие страницы:

1) http://0.0.0.0:8082/main - главная страница проекта.

2) http://0.0.0.0:8082/login - страница логина.

3) http://0.0.0.0:8082/registrate - страница регистрации.

4) http://0.0.0.0:8082/profile - страница профиля пользователя (доступна только для авторизованных пользователей).