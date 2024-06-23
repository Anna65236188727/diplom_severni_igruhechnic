<?php
// Подключение к базе данных
if (isset($_GET['id'])) {
  $productId = $_GET['id'];
} else {
  echo "ID товара не указан.";
  exit;
}
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
$sql = "SELECT * FROM products WHERE id =?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $productId);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  // Здесь начинается ваш текущий код для отображения информации о товаре
  //...
} else {
  echo "Товар не найден.";
}
session_start();

// Если корзина пуста или товар уже есть в ней, обновляем ее содержимое
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
}

$productId = isset($_GET['id']) ? intval($_GET['id']) : null;

$id = $_GET['id']; // Получаем id из URL
$sql = "SELECT id, name_product, price, image_1, image_2, image_3, image_4, image_5, materials, size, weight, description FROM products WHERE id=$id";

// SQL-запрос для выбора всех товаров
// $sql = "SELECT id, name_product, price, image_1, image_2, image_3, image_4, image_5, materials, size, weight, description FROM products";
// $result = $conn->query($sql);

$result = $conn->query($sql);
$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <title>Игрушка из дерева Молоковоз</title>
</head>

<body>
  <?php
  include 'header.php';
  ?>
  <div class="body_str">
    <div class="product">
      <div class="container">
        <?php if ($result->num_rows > 0): ?>
          <?php $row = $result->fetch_assoc(); ?>
          <?php $detailUrl = "product_detail.php?id=" . urlencode($row['id']); ?>

          <ul class="breadcrumb_black">
            <li><a class="ul18_gray" href="index.php">Главная</a></li>
            <li><a class="ul18_gray" href="catalog.php">Каталог</a></li>
            <li class="ul18_gray"><?php echo htmlspecialchars($row['name_product']); ?></li>
          </ul>

          <div class="product_block">
            <div class="product_img">
              <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                  <?php if (!empty($row['image_1'])): ?>
                    <div class="swiper-slide">
                      <img src="uploads/<?php echo htmlspecialchars($row['image_1']); ?>" alt="">
                    </div>
                  <?php endif; ?>

                  <?php if (!empty($row['image_2'])): ?>
                    <div class="swiper-slide">
                      <img src="uploads/<?php echo htmlspecialchars($row['image_2']); ?>" alt="">
                    </div>
                  <?php endif; ?>

                  <?php if (!empty($row['image_3'])): ?>
                    <div class="swiper-slide">
                      <img src="uploads/<?php echo htmlspecialchars($row['image_3']); ?>" alt="">
                    </div>
                  <?php endif; ?>

                  <?php if (!empty($row['image_4'])): ?>
                    <div class="swiper-slide">
                      <img src="uploads/<?php echo htmlspecialchars($row['image_4']); ?>" alt="">
                    </div>
                  <?php endif; ?>

                  <?php if (!empty($row['image_5'])): ?>
                    <div class="swiper-slide">
                      <img src="uploads/<?php echo htmlspecialchars($row['image_5']); ?>" alt="">
                    </div>
                  <?php endif; ?>
                </div>
                <div class="swiper-button-next str_right">
                  <img src="img/str_right.png" alt="">
                </div>
                <div class="swiper-button-prev str_left">
                  <img src="img/str_left.png" alt="">
                </div>
                <div class="swiper-pagination"></div>
              </div>
            </div>
            <div class="product_text">
              <div class="product_block_text">
                <div class="ub36_black"><?php echo htmlspecialchars($row['name_product']); ?></div>
                <div class="ub36_oranj"><?php echo htmlspecialchars($row['price']) . ' ₽'; ?></div>
                <form action="functions.php" method="post">
                  <input type="hidden" name="productId" value="<?php echo htmlspecialchars($productId); ?>">
                  <input class="button ur26_white" type="submit" name="addToCart" value="Добавить в корзину">
                </form>
                <?php
                if (isset($_GET['added']) && $_GET['added'] == 'true') {
                  echo '<div id="successMessage" class="ur26_black" style="display:block; background-color: #cb90506c; padding: 15px;
    margin: 0 auto 0 0;">Товар успешно добавлен в корзину!</div>';
                }
                ?>
              </div>
              <div class="product_block_text">
                <div class="ur26_black">Материалы: <?php echo htmlspecialchars($row['materials']); ?>. <br> Размеры:
                  <?php echo htmlspecialchars($row['size']); ?>. <br> Вес: <?php echo htmlspecialchars($row['weight']); ?>
                </div>
              </div>
              <div class="product_block_text">
                <div class="ub26_black">О товаре</div>
                <div class="ur20_black"><?php echo htmlspecialchars($row['description']); ?></div>
              </div>
            </div>
          </div>
        <?php else: ?>
          <p>Товар не найден.</p>
        <?php endif; ?>
        <div class="info_po_product">
          <div class="info_product">
            <div class="ub26_black">Рекомендации по уходу</div>
            <div class="ur20_black">Соблюдая несколько правил, вы можете сделать жизнь изделия долговечной:<br>
              -хранить в сухих помещениях не менее одного метра от нагревательных приборов, огня.<br>
              -при необходимости для обновления игрушки можно использовать пищевое льняное масло.<br>
              -можно мыть, но не замачивать.</div>
          </div>
          <div class="info_product">
            <div class="ub26_black">Доставка и оплата</div>
            <div class="ur20_black">Доставка при оплате онлайн</div>
            <div class="delivery">
              <div class="delivery_block">
                <img class="boxberry" src="img/boxberry.png" alt="boxberry">
                <svg class="svg_delivery" width="221" height="1" viewBox="0 0 221 1" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <line y1="0.5" x2="221" y2="0.5" stroke="#9C9C9C" />
                </svg>

                <div class="ur20_black">от 180 ₽</div>
              </div>
              <div class="delivery_block">
                <img class="russian_post" src="img/russian_post.png" alt="Russian_post">
                <svg class="svg_delivery" width="201" height="1" viewBox="0 0 201 1" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <line y1="0.5" x2="201" y2="0.5" stroke="#9C9C9C" />
                </svg>
                <div class="ur20_black">от 180 ₽</div>
              </div>
              <div class="delivery_block">
                <img class="cdek" src="img/cdek.png" alt="cdek">
                <svg class="svg_delivery" width="249" height="1" viewBox="0 0 249 1" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <line y1="0.5" x2="249" y2="0.5" stroke="#9C9C9C" />
                </svg>
                <div class="ur20_black">от 180 ₽</div>
              </div>
            </div>
            <div class="payment">
              <div class="ur20_black">Онлайн-оплата на сайте</div>
              <div class="icon_payments">
                <img src="img/mastercard.png" alt="mastercard">
                <img src="img/visa.png" alt="visa">
                <img src="img/mir.png" alt="mir">
              </div>
            </div>
          </div>
          <div class="info_product">
            <div class="ub26_black">Условия возврата и обмена</div>
            <div class="ur20_black">Если вы обнаружили брак, то возврат товара и повторная доставка за наш счет.
              Напишите
              и мы с Вами обязательно найдем решение! </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  include 'footer.php';
  ?>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var addToCartButtons = document.querySelectorAll('.add-to-cart');
      addToCartButtons.forEach(function (button) {
        button.addEventListener('click', function (e) {
          e.preventDefault();
          var productId = this.dataset.productId;
          fetch('/functions.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({ productId: productId })
          })
            .then(response => response.json())
            .then(data => {
              console.log('Success:', data);
              alert('Товар успешно добавлен в корзину!');
            })
            .catch((error) => {
              console.error('Error:', error);
              alert('Ошибка при добавлении товара в корзину.');
            });
        });
      }); 
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    var swiper = new Swiper(".mySwiper", {
      cssMode: true,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      pagination: {
        el: ".swiper-pagination",
      },
      mousewheel: true,
      keyboard: true,
    });
  </script>
</body>