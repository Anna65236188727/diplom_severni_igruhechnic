<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <title>Мастерская Северный игрушечник</title>
</head>

<body>
    <header class="header_main">
        <div class="container head">
            <a href="index.php"><img class="logo" src="img/logo.png" alt="logo"></a>
            <div class="nav">
                <nav>
                    <a href="index.php" class="menu um20_white">Главная</a>
                    <a href="catalog.php" class="menu um20_white">Каталог</a>
                    <a href="about_workshop.php" class="menu um20_white">О мастерской</a>
                </nav>
                <div class="search">
                    <form action="search.php" method="POST">
                        <input class="ul15_white" type="search" maxlength="30" placeholder="Поиск">
                    </form>
                </div>
                <div class="btns">
                    <a href="basket.php"><img src="img/cart.png" alt="Корзина"></a>
                </div>
            </div>
            <!-- Иконка бургерменю -->
            <div class="burger">
                <span></span>
            </div>
        </div>

    </header>
    <div class="body_str">
        <div class="main_banner">
            <div class="container">
                <div class="offer">
                    <h1 class="ub100_white">СЕМЕЙНАЯ <span class="ub100_bej drop-shadow">МАСТЕРСКАЯ</span> </h1>
                    <div class="advantages">
                        <div class="main_advantages">
                            <div class="ub25_brown">НАТУРАЛЬНОЕ ДЕРЕВО</div>
                            <svg width="13" height="13" viewBox="0 0 13 13" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="6.5" cy="6.5" r="6.5" fill="#3D2005" />
                            </svg>
                            <div class="ub25_brown">БЕЗОПАСНОЕ ПОКРЫТИЕ</div>
                        </div>
                    </div>
                    <div class="ub30_bej drop-shadow">С ТЕПЛОТОЙ И ЗАБОТОЙ О ВАШЕМ РЕБЕНКЕ</div>
                </div>
            </div>
        </div>
        <div class="categories">
            <div class="container">
                <h2 class="ub55_black offering">МЫ ПРЕДЛАГАЕМ</h2>
                <p class="ur26_black mini_offering">У нас вы найдете детские игрушки для прекрасного времяпровождения
                </p>
                <div class="block_categories">
                    <a href="?filter=new_year_collection" class="new_year_collection">
                        <img src="img/new_year_collection.png" alt="Новогодняя коллекция">
                    </a>
                    <a href="?filter=Техника" class="techno">
                        <img src="img/techno.png" alt="Техника">
                    </a>
                    <a href="?filter=smart_play" class="smart_play">
                        <img src="img/smart_play.png" alt="Развивающие игрушка">
                    </a>
                </div>
            </div>
        </div>
        <div class="about">
            <div class="container">
                <div class="about_block">
                    <div class="left_about">
                        <div class="ur26_white">Смотреть о компании</div>
                        <div class="ub55_white">О МАСТЕРСКОЙ СЕВЕРНЫЙ ИГРУШЕЧНИК</div>
                        <a href="about_workshop.php"><button class="button ur26_white">Подробнее</button></a>
                    </div>
                    <a class="right_about" target="_blank" data-fancybox="img/video.mp4" href="img/video.mp4">
                        <svg class="round_big" width="473" height="473" viewBox="0 0 473 473" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="236.5" cy="236.5" r="235" stroke="#CB8F50" stroke-width="3" />
                        </svg>
                        <svg class="round_mini" width="309" height="294" viewBox="0 0 309 294" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M307.5 147C307.5 227.288 239.071 292.5 154.5 292.5C69.9292 292.5 1.5 227.288 1.5 147C1.5 66.712 69.9292 1.5 154.5 1.5C239.071 1.5 307.5 66.712 307.5 147Z"
                                stroke="#CB8F50" stroke-width="3" />
                        </svg>
                        <svg class="triangle" width="71" height="95" viewBox="0 0 71 95" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M67.9592 42.5814C71.3777 44.9695 71.3777 50.0305 67.9592 52.4186L9.43613 93.3025C5.45895 96.0809 0 93.2354 0 88.3839V6.61613C0 1.76457 5.45895 -1.08094 9.43613 1.69749L67.9592 42.5814Z"
                                fill="#CB8F50" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="popular">
            <h2 class="ub55_black offering">ПОПУЛЯРНЫЕ ТОВАРЫ</h2>
            <p class="ur26_black mini_offering">Игрушки, которые полюбились вами особенно сильно</p>
            <div class="slaider">
                <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <?php
                        // Подключение к базе данных
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

                        // Массив ID товаров, которые нужно отобразить
                        $productIds = [5, 7, 4, 2];
                        ?>
                        <?php foreach ($productIds as $productId): ?>
                            <!-- SQL-запрос для получения данных о товаре -->
                            <?php
                            $sql = "SELECT * FROM products WHERE id =?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $productId);
                            $stmt->execute();

                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();

                                ?>
                                <div class="swiper-slide">
                                    <div class="container sl">
                                        <div class="slaider_block">
                                            <div class="left_site">
                                                <img class="height100"
                                                    src="uploads/<?php echo htmlspecialchars($row['image_1']); ?>" alt="">
                                            </div>
                                            <div class="right_site">
                                                <div class="ub36_black"><?php echo htmlspecialchars($row['name_product']); ?>
                                                </div>
                                                <div class="ub36_oranj"><?php echo htmlspecialchars($row['price']) . ' ₽'; ?>
                                                </div>
                                                <div class="ur26_black line-height">Материалы:
                                                    <?php echo htmlspecialchars($row['materials']); ?>. <br> Размеры:
                                                    <?php echo htmlspecialchars($row['size']); ?>. <br> Вес:
                                                    <?php echo htmlspecialchars($row['weight']); ?>
                                                </div>
                                                <div class="ub26_black longtext">О товаре</div>
                                                <div id="longText" class="ur20_black line-height longtext">
                                                    <?php echo htmlspecialchars($row['description']); ?>
                                                </div>
                                                <a href="product.php?id=<?php echo $productId; ?>"><button
                                                        class="button ur26_white">Подробнее о товаре</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            } else {
                                echo "0 results";
                            }
                            ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-button-next">
                        <img class="str_img" src="img/str_right.png" alt="">
                    </div>
                    <div class="swiper-button-prev">
                        <img class="str_img" src="img/str_left.png" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="about_write">
            <div class="container">
                <div class="about_offer">
                    <h2 class="ub55_black offering">О НАС ПИШУТ</h2>
                    <a class="articles ur26_black" href="about_write.php">Показать все статьи</a>
                </div>
                <div class="news">
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
                        $counter = 0; // Инициализируем счетчик для отслеживания количества отображенных новостей
                        // Заполняем массив данными новостей
                        while ($row = $result->fetch_assoc()) {
                            $rows[] = $row; // Добавляем каждую строку в массив $rows
                            $counter++; // Увеличиваем счетчик на единицу
                            // Выводим данные в HTML-формате, но только первые три новости
                            if ($counter <= 3) {
                                echo "
                        <a class='news_ssilki' target='_blank' href='" . htmlspecialchars($row['link']) . "'>
                            <img src='uploads_news/" . htmlspecialchars($row['image']) . "' alt='о нас пишут'>
                            <div class='about_text'>
                                <div class='name_date'>
                                    
                                        <img class='img_logo_news' src='uploads_news/" . htmlspecialchars($row['logo_path']) . "' alt=''>
                                    
                                    <div class='um16_gray'>" . htmlspecialchars($row['date']) . "</div>
                                </div>
                                <div class='um26_black'>" . htmlspecialchars($row['title']) . "</div>
                                <div class='ur22_black'>" . substr(htmlspecialchars($row['description']), 0, 150) . "</div>
                            </div>
                        </a>";
                            }
                        }
                    } else {
                        echo "<div class='news'>No news found.</div>";
                    }
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
        <div class="question_response" id="question_response">
            <div class="container">
                <h2 class="ub55_black offering">ВОПРОСЫ И ОТВЕТЫ</h2>
                <div class="block_accordion">
                    <img class="img_question" src="img/question.png" alt="деревянные игрушки">
                    <div class="accordion">
                        <details>
                            <summary class="um26_black">Как сделать заказ?</summary>
                            <p class="ur20_black">Какправильновыбратьдеревянную игрушку? Ведь ассортимент игрушек
                                сегодня
                                очень разнообразен.<br>

                                При выбореигрушкиобратите внимание на следующие моменты:<br>
                                -гладкая поверхность<br>
                                -отсутствие зазубрин, шероховатостей<br>
                                -отсутствие острых углов и выступов<br>
                                -краска, сертифицированная для окрашивания детских игрушек<br>
                                -натуральное масло<br>
                            </p>
                        </details>
                        <details open>
                            <summary class="um26_black">Как ухаживать за деревянными игрушками?</summary>
                            <p class="ur20_black">При оформлении заказа в корзине напишите комментарий, что игрушки
                                необходимо выслать в
                                другую страну — мы свяжемся с вами и уточним детали доставки</p>
                        </details>
                        <details>
                            <summary class="um26_black">Как заказать игрушки из другой страны?</summary>
                            <p class="ur20_black">При оформлении заказа в корзине напишите комментарий, что игрушки
                                необходимо выслать в
                                другую страну — мы свяжемся с вами и уточним детали доставки</p>
                        </details>
                        <details>
                            <summary class="um26_black">Как сделать заказ?</summary>
                            <p class="ur20_black">При оформлении заказа в корзине напишите комментарий, что игрушки
                                необходимо выслать в
                                другую страну — мы свяжемся с вами и уточним детали доставки</p>
                        </details>
                        <details>
                            <summary class="um26_black">Как ухаживать за деревянными игрушками?</summary>
                            <p class="ur20_black">При оформлении заказа в корзине напишите комментарий, что игрушки
                                необходимо выслать в
                                другую страну — мы свяжемся с вами и уточним детали доставки</p>
                        </details>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include 'footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            lazy: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            }, 
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
    <script>
        document.querySelector('.burger').addEventListener('click', function () {
            this.classList.toggle('active');
            document.querySelector('.nav').classList.toggle('open');
        })
    </script>

    <!-- // ВОСПРОИЗВЕДЕНИЕ ВИДЕО -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
</body>
<script>
    // АККОРДИОН
    var details = document.querySelectorAll("details");
    for (i = 0; i < details.length; i++) {
        details[i].addEventListener("toggle", accordion);
    }
    function accordion(event) {
        if (!event.target.open) return;
        var details = event.target.parentNode.children;
        for (i = 0; i < details.length; i++) {
            if (details[i].tagName != "DETAILS" ||
                !details[i].hasAttribute('open') ||
                event.target == details[i]) {
                continue;
            }
            details[i].removeAttribute("open");
        }
    }
</script>

</html>