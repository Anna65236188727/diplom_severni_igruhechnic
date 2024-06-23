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
        <!-- <form action="" method="get"> -->
        <a href="admin_panel.php#add_product"><button class="button ur26_white">Добавить товар</button></a>
        <a href="admin_panel.php#delete_product"><button class="button ur26_white">Удалить товара</button></a>
        <a href="admin.php"><button class="button ur26_white" type="submit" name="logout">Выйти</button></a>
        <!-- </form> -->
    </div>

</body>

</html>

<?php
session_start();



if (!isset($_SESSION['loggedin'])) {
    header("Location: admin.php");
    exit;
}


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
$proverka = false;
if (isset($_POST['add'])) {
    if (!empty($_POST['name_product']) && !empty($_POST['materials']) && !empty($_POST['size']) && !empty($_POST['price']) && !empty($_POST['description']) && !empty($_POST['collection_name']) && !empty($_POST['quantity'])) {
        $name_product = $_POST['name_product'];
        $materials = $_POST['materials'];
        $size = $_POST['size'];
        $weight = $_POST['weight'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $collection_name = $_POST['collection_name'];
        $quantity = $_POST['quantity'];

        $product_insert_query = "INSERT INTO products (name_product, materials, size, weight, price, description, collection_name, quantity) VALUES (?,?,?,?,?,?,?,?)";
        $product_stmt = $conn->prepare($product_insert_query);
        $product_stmt->bind_param("ssssssss", $name_product, $materials, $size, $weight, $price, $description, $collection_name, $quantity);

        if ($product_stmt->execute()) {
            $last_id = $conn->insert_id; // Получаем ID последнего вставленного продукта

            // Загрузка изображений и сохранение имен файлов в полях продукта
            if (isset($_FILES['image_1'], $_FILES['image_2'], $_FILES['image_3'], $_FILES['image_4'], $_FILES['image_5'])) {
                $file_names = []; // Массив для хранения имен файлов
                foreach ($_FILES as $key => $file) {
                    if ($file['error'] == UPLOAD_ERR_OK && ($file['type'] == 'image/jpeg' || $file['type'] == 'image/png')) {
                        $file_name = basename($file['name']);
                        $destination_path = "uploads/" . $file_name;
                        if (move_uploaded_file($file['tmp_name'], $destination_path)) {
                            $file_names[] = $file_name; // Сохраняем только имя файла
                        }
                    }
                }

                // Обновление запроса для вставки путей к изображениям
                $update_image_query = "UPDATE products SET ";
                $params = [];
                for ($i = 0; $i < 5; $i++) {
                    $column_name = "image_" . ($i + 1); // Исправлено имя столбца
                    $params[] = isset($file_names[$i]) ? $file_names[$i] : ''; // Используем $file_names вместо $image_paths
                    $update_image_query .= "$column_name=?,";
                }
                // Удаляем последнюю запятую из запроса
                $update_image_query = rtrim($update_image_query, ',');
                $update_image_query .= " WHERE id=?";
                $params[] = $last_id;

                // Выполнение запроса на обновление изображений
                $update_stmt = $conn->prepare($update_image_query);
                if ($update_stmt === false) {
                    echo "Error preparing update statement: " . $conn->error;
                } else {
                    $types = str_repeat('s', count($params)); // Определяем типы параметров
                    $update_stmt->bind_param($types, ...$params); // Привязываем параметры
                    if ($update_stmt->execute() === false) {
                        echo "Error executing update statement: " . $update_stmt->error;
                    } else {
                        $update_stmt->close();
                    }
                }
            }
            $proverka = true;

            header("refresh:0");
            echo "<script>alert('Товар добавлен')</script>";
            exit();
        } else {
            echo "Error inserting product: " . $product_stmt->error;
        }
    }
}

// Выполнение запроса на вставку продукта

// удаление товара
if (isset($_POST['dell'])) {
    $id = $_POST['review_id'];
    $stmt = $conn->prepare("DELETE FROM products WHERE id =?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        header("refresh:0");
        echo "<script>alert('Товар удален')</script>";
        exit();
    } else {
        echo "Ошибка";
    }
}


?>
<br>
<br>
<div id="add_product" class="ub36_black offering">Добавить товар</div>
<form class="making_order_block" action="admin_panel.php" method="post" enctype="multipart/form-data">
    <div class="making_order_product10">
        <input class="input_making_order ur18_gray" type="text" id="name_product" name="name_product"
            placeholder="Название товара" required>
        <input class="input_making_order ur18_gray" type="text" id="materials" name="materials" placeholder="Материалы">
        <input class="input_making_order ur18_gray" type="text" id="size" name="size" placeholder="Размеры">
        <input class="input_making_order ur18_gray" type="number" id="weight" name="weight" step="any"
            placeholder="Вес">
        <input class="input_making_order ur18_gray" type="number" id="price" name="price" step="any" placeholder="Цена"
            required>
        <label for="image_1">Изображение 1:</label>
        <input type="file" id="image_1" name="image_1" accept="image/*">
        <label for="image_2">Изображение 2:</label>
        <input type="file" id="image_2" name="image_2" accept="image/*">
        <label for="image_3">Изображение 3:</label>
        <input type="file" id="image_3" name="image_3" accept="image/*">
        <label for="image_4">Изображение 4:</label>
        <input type="file" id="image_4" name="image_4" accept="image/*">
        <label for="image_5">Изображение 5:</label>
        <input type="file" id="image_5" name="image_5" accept="image/*">
        <input class="input_making_order ur18_gray" type="text" id="description" name="description"
            placeholder="Описание">
        <input class="input_making_order ur18_gray" type="text" id="collection_name" name="collection_name"
            placeholder="Название коллекции">
        <input class="input_making_order ur18_gray" type="number" id="quantity" name="quantity" min="0"
            placeholder="Количество на складе" required>

        <input class="button ur26_white" type="submit" name="add" value="Добавить товар">
    </div>
</form>
<!-- удаление товара -->
<br> 
<div class="container">
    <div id="delete_product" class="ub36_black offering">Удалить товар</div>
    <div class="cards">
        <?php
        $otzov = $conn->query("SELECT * FROM products ORDER BY id");
        while ($comm = mysqli_fetch_assoc($otzov)) {
            ?>
            <div class="card">
                <div class="ub26_black"> <?php echo ' ';
                echo htmlspecialchars($comm['name_product']) . ' '; ?></div>
                <div class="ur18_black">Коллекция:
                    <?php echo ' ';
                    echo htmlspecialchars($comm['collection_name']); ?>
                </div>
                <div class="ub26_black"><?php echo ' ';
                echo htmlspecialchars($comm['price']); ?></div>
                <form method="POST">
                    <input type="hidden" name="review_id" value="<?php echo htmlspecialchars($comm['id']); ?>">
                    <button class="button ur26_white" type="submit" name="dell">Удалить</button>
                </form>
            </div>
            <?php
        }
        ?>
    </div>
</div>
</div <?php if (isset($_POST['adminout'])) {
    session_destroy();
    // unset($_SESSION['login']);
    header("location:admin");
}
$conn->close();
?>