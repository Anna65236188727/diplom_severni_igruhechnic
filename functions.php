<!-- ДОБАВЛЕНИЕ ТОВАРОВ В КОРЗИНУ -->

<?php
header('Content-Type: application/json');

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_shop";
 
// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// $servername = "127.0.0.1";
// $username = "cativologd_Anya";
// $password = "Ansdfg12345";
// $dbname = "cativologd_Anya";
// $port = 3308;

// // Создание соединения
// $conn = new mysqli($servername, $username, $password, $dbname, $port);


if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

function addProductToCart($productId, $quantity = 1) {
    session_start(); 

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    if (array_key_exists($productId, $_SESSION['cart'])) {
        $_SESSION['cart'][$productId] += $quantity;
    } else {
        $_SESSION['cart'][$productId] = $quantity;
    }
}

if (isset($_POST['addToCart'])) {
    $productId = isset($_POST['productId'])? intval($_POST['productId']) : null;
    if ($productId!== null) {
        $quantity = isset($_POST['quantity'])? $_POST['quantity'] : 1;
        addProductToCart($productId, $quantity); 
        header("Location: product.php?id=$productId&added=true");
exit;
    }
}
// header("Location: product.php?id=$productId");
$conn->close();
?>


<!-- УДАЛЕНИЕ ТОВАРОВ ИЗ КОРЗИНЫ -->
<?php
// header('Content-Type: application/json');

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_shop";

$conn = new mysqli($servername, $username, $password, $dbname);

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_POST['productId'];
    
    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
        
        // Здесь можно добавить логику для обновления общей стоимости корзины и т.д.
        
        header("Location: basket.php"); // Перенаправление обратно на страницу корзины
        exit;
    } else {
        echo "Товар не найден в корзине.";
    }
}
?>


<?php

// СОХРАНЕНИЕ КОЛИЧЕСТВА ТОВАРА В СЕССИИ

session_start();

if (isset($_POST['productId'], $_POST['quantity'])) {
    $productId = intval($_POST['productId']);
    $quantity = intval($_POST['quantity']);

    // Проверяем, существует ли уже такой продукт в сессии
    if (!isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] = $quantity;
    } else {
        $_SESSION['cart'][$productId] = $quantity;
    }

    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}
?>