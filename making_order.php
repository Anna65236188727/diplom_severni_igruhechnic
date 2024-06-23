<?php
session_start();

// Предполагается, что $_POST содержит данные формы
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$city = isset($_POST['city']) ? $_POST['city'] : '';
$fio_name = isset($_POST['fio_name']) ? $_POST['fio_name'] : '';
$street = isset($_POST['street']) ? $_POST['street'] : '';
$house_number = isset($_POST['house_number']) ? $_POST['house_number'] : '';
$apartment = isset($_POST['apartment']) ? $_POST['apartment'] : '';
$comment = isset($_POST['comment']) ? $_POST['comment'] : '';

$isAgreedToPrivacyPolicy = isset($_POST['policy'])? true : false;

// Подключение к базе данных
$conn = new mysqli("localhost", "root", "", "my_shop");
$conn -> query("SET NAMES 'utf8'");

if ($conn->connect_error) {
    die("Ошибка подключения: ". $conn->connect_error);
}

// Вставляем данные о заказе
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <title>Оформление заказа</title>
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <div class="making_order">
        <div class="container">
            <ul class="breadcrumb_black">
                <li><a class="ul18_gray" href="index.php">Главная</a></li>
                <li><a class="ul18_gray" href="catalog.php">Каталог</a></li>
                <li><a class="ul18_gray" href="basket.php">Корзина</a></li>
                <li class="ul18_gray">Оформление заказа</li>
            </ul>
            <div class="ur30_black name_basket">Оформление заказа</div>
            <form class="making_order_block" method="post" >
                <div class="making_order_product20">
                    <div class="ur20_black">Введите свои данные</div>
                </div>
                <div class="making_order_product10">
                    <input class="input_making_order ur18_gray" name="name" type="text" placeholder="Ваше имя">
                    <input class="input_making_order ur18_gray" name="email" type="email" placeholder="Ваш e-mail">
                    <input class="input_making_order ur18_gray" name="phone" type="tel" placeholder="+7 (900) 505-55-55">
                </div>
                <div class="making_order_product20">
                    <div class="ur20_black">Доставка</div>
                    <input class="input_making_order ur18_gray" name="city" type="search" placeholder="Город">
                </div>
                <div class="making_order_product10">
                    <input class="input_making_order ur18_gray" name="fio_name" type="text" placeholder="ФИО получателя">
                    <input class="input_making_order ur18_gray" name="street" type="text" placeholder="Улица">
                    <div class="mini_input">
                        <input class="input_making_order ur18_gray" name="house_number" type="text" placeholder="Дом">
                        <input class="input_making_order ur18_gray" name="apartment" type="text" placeholder="Квартира / офис">
                    </div>
                    <input class="input_making_order ur18_gray comment" name="comment" type="text" maxlength="1000px"
                        placeholder="Комментарий к заказу">
                </div>
                
                <div class="mini_input2">
                    <input id="radio-1" name="policy" type="checkbox" class="checkbox">
                    <div class="ur20_black">Я согласен с <a class="ur20_black articles" href="#"> политикой
                            конфиденциальности</a></div>
                </div>
                <?php
                

                if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                    echo "Корзина пуста.";
                    exit;
                }

                $conn = new mysqli("localhost", "root", "", "my_shop");

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $totalCount = 0;
                $totalPrice = 0;

                foreach ($_SESSION['cart'] as $productId => $quantity) {
                    $sql = "SELECT id, name_product, price FROM products WHERE id=?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('i', $productId);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $totalPrice += $row['price'] * $quantity;
                        $totalCount += $quantity;
                    }
                }
                if(isset($_POST['addToCart'])){
                    if((isset($_POST['policy'])) === true){
                         $price = $totalPrice;
                         $name = $_POST['name'];
                         $email = $_POST['email'];
                         $phone = $_POST['phone'];
                         $city = $_POST['city'];
                         $fio_name = $_POST['fio_name'];
                         $street = $_POST['street'];
                         $house_number = $_POST['house_number'];
                         $apartment = $_POST['apartment'];
                         $comment = $_POST['comment'];
                         $sql = "INSERT INTO `orders`(`name`,`email`,`phone`,`city`,`fio_name`,`street`,`house_number`,`apartment`,`comment`,`price`) VALUES ('$name','$email','$phone','$city','$fio_name','$street','$house_number','$apartment','$comment','$price')";
                         $stmt = $conn->query($sql);
                         if(!empty($name) && !empty($email) && !empty($phone) && !empty($city) && !empty($fio_name) && !empty($street) && !empty($house_number) && !empty($apartment) && !empty($comment)){
                            if($stmt) {
                               ?><script>alert("Ваш заказ оформлен! Наш менеджер с вами свяжется в течении часа!")</script><?php
                                exit();
                            }
                         } else ?><script>alert("Заполните все поля")</script><?php
                    }else ?><script>alert("Подтвердите согласие с политикой конфиденциальности")</script><?php
                 }
                $conn->close();
                ?><div class='basket_block3'>
                <div class='product_basket_block'>
                <div class='ur18_gray'>Товары, <span class='total__count'><?php echo $totalCount?></span> шт.</div>
                </div>
                <div class='product_basket_block'>
                <div class='ub36_black'>Итого</div>
                <div class='ub36_black total__price'><?php  echo number_format($totalPrice, 2, ',', ' ')?> ₽</div>
                </div> 
                </div>
                <input class="button ur26_white" type="submit" name="addToCart" value="Купить">
            </form>
        </div>
    </div>
    <?php
    include 'footer.php';
    ?>
</body>