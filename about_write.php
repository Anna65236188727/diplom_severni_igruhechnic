<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>О нас пишут</title>
</head>
 
<body>
    <?php
    include 'header.php';
    ?>
    <div class="body_str">
        <div class="main_about_write">
            <div class="container">
                <div class="main_about_write_text">
                    <ul class="breadcrumb">
                        <li><a class="ul18_white" href="index.php">Главная</a></li>
                        <li class="ul18_white">О нас пишут</li>
                    </ul>
                    <div class="write2">
                        <div class="ub55_white">О НАС ПИШУТ</div>
                        <div class="ur20_white line-height">
                            Мы сделали машинку из светлых пород дерева. Как будто её вареной
                            сгущёнкой облили. Молоковоз также представляет серию спецтехники
                            по мотивам эскизов Вологодской фабрики игрушек.
                        </div>
                    </div>
                </div>
                <div class="news" style="margin-bottom: 45px;">
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "my_shop";

                    // Создание соединения
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Проверка соединения
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // SQL-запрос для получения всех новостей
                    $sql = "SELECT id, title, link, image, logo_path, description, date FROM news WHERE 1";
                    $result = $conn->query($sql);

                    // Проверяем, были ли найдены результаты
                    if ($result->num_rows > 0) {
                        $rows = array(); // Инициализируем переменную $rows как пустой массив
                        // Заполняем массив данными новостей
                        while ($row = $result->fetch_assoc()) {
                            $rows[] = $row; // Добавляем каждую строку в массив $rows
                        }
                        // Выводим данные в HTML-формате
                        foreach ($rows as $row) {
                            echo "
                            <a class='news_ssilki' target='_blank' href='" . htmlspecialchars($row['link']) . "'>
                                <img src='uploads_news/" . htmlspecialchars($row['image']) . "' alt='о нас пишут'>
                                <div class='about_text'>
                                    <div class='name_date'>
                                        <img class='img_logo_news' src='uploads_news/" . htmlspecialchars($row['logo_path']) . "' alt=''>
                                        <div class='um16_gray'>" . htmlspecialchars($row['date']) . "</div>
                                    </div>
                                    <div class='um26_black'>" . htmlspecialchars($row['title']) . "</div>
                                    <div class='ur22_black'>" . substr(htmlspecialchars($row['description']), 0, 150) . "...</div>
                                </div>
                            </a>";
                        }
                    } else {
                        echo "<div class='news'>No news found.</div>";
                    }
                    $conn->close();
                    ?>
                </div>
            </div>
    <?php
    include 'footer.php';
    ?>
        </div>
    </div>
</body>

</html>
