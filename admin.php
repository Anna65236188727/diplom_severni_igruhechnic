<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Админ</title>
</head>

<body>
    <div class="admin_head">
        <a href="index.php"><img class="admin_logo" src="img/logo.png" alt="logo"></a>
    </div>

</body>

</html>
<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = ""; // Убедитесь, что пароль пуст, если вы не используете хеширование
$dbname = "my_shop";

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Проверяем, была ли форма отправлена
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из POST-запроса
    $username = $_POST['username'];
    $password = $_POST['password']; // Пароль в открытом виде

    // Поиск пользователя в базе данных
    $sql = "SELECT * FROM users WHERE username =? AND password =?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password); // Используем два символа 's' для двух строковых параметров
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_object();

    // Проверка пользователя
    if ($user) {
        // Успешный вход
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: admin_panel.php"); // Переход к админ-панели
    } else {
        echo "Неверное имя пользователя или пароль.";
    }
 
    $stmt->close();
} else {
    // Отображение формы входа, если форма не была отправлена
    ?>
    <br>
    <br>
    <div class="ub36_black offering">Вход</div>
    <form class="making_order_block" method="post">
        <div class="making_order_product10">
            <input class="input_making_order ur18_gray" type="text" name="username" placeholder="Введите логин" required>
            <input class="input_making_order ur18_gray" type="password" name="password" placeholder="Введите пароль"
                required>
            <input class="button ur26_white" type="submit" value="Войти">
        </div>
    </form>




    <?php
}
$conn->close();
?>