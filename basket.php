<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <title>Корзина</title>
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <div class="basket">
        <div class="container">
            <ul class="breadcrumb_black">
                <li><a class="ul18_gray" href="index.php">Главная</a></li>
                <li><a class="ul18_gray" href="catalog.php">Каталог</a></li>
                <li class="ul18_gray">Корзина</li>
            </ul>
            <div class="ur30_black name_basket">Корзина</div>
            <?php
            session_start();

            if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                echo "Корзина пуста.";
                exit;
            }

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "my_shop";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            ?>
            <div class="block_baskets">
                <div class="basket_block">
                    <div class="ur20_black">Ваш заказ:</div>
                    <hr>
                    <div class="list_basket">
                        <?php
                        foreach ($_SESSION['cart'] as $productId => $quantity) {
                            $sql = "SELECT id, name_product, price, image_1, image_2, image_3, image_4, image_5, materials, size, weight, description, quantity FROM products WHERE id=?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param('i', $productId);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $displayQuantity = htmlspecialchars($row['quantity']);

                                ?>
                                <div class="block_list_basket">
                                    <div class="img_name">
                                        <img class="width140" src="uploads/<?php echo $row['image_1']; ?>" alt="">
                                    </div>
                                    <div class="product_basket" data-product-id="<?php echo $row['id']; ?>">
                                        <div class="name_composition">
                                            <div class="ur20_black"><?php echo htmlspecialchars($row['name_product']); ?>
                                            </div>
                                            <div class="ur18_gray"><?php echo htmlspecialchars($row['materials']); ?></div>
                                        </div>
                                        <div class="quantity_price_delete">
                                            <div class="quantity">
                                                <div class="quantity_block">
                                                    <svg class="svg_quantiti"
                                                        onclick="decreaseQuantity('<?php echo $row['id']; ?>')" width="29"
                                                        height="29" viewBox="0 0 29 29" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                                        <rect width="29" height="29" fill="url(#pattern0_814_88)" />
                                                        <defs>
                                                            <pattern id="pattern0_814_88"
                                                                patternContentUnits="objectBoundingBox" width="1" height="1">
                                                                <use xlink:href="#image0_814_88" transform="scale(0.01)" />
                                                            </pattern>
                                                            <image id="image0_814_88" width="100" height="100"
                                                                xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAAAXNSR0IArs4c6QAAAeRJREFUeAHt2E9qE1EcwPGim3oJz6HtCdQ68xLovkfJShHJe/EMdZVLdFfIvPQEpYvWA3Rfwcqvf2ixEIYwsxA+gSGBhJfw+eY3/3Z2PAgQIECAAAECBAgQIECAAAECBAgQIECAAAECBAgQIECAAAECBAgQIECAAAECBAgQIECAAAECBAgQIECAAAECBAgQIECAAAECBAgQeBRYLg9frxaTg27Rfl2X9mctaWlLy7C4N5l+CqNHr1Gfa5nu19Jc1JJubZsMmovuR7s3boxF09SSfguxKcTTe11ub7rcfh4lynpx8LbL6VqMJ/A+FmEWdoNHqSXN+/wAn3kZbF0m34cPkttfsF9i9zS5GjTIaT580+X0p+eXO9j/c8ITdmE4WBRBtp6Muz9nBDmZHe0OFiQWqnZZW09+l9PloDFisTgw2WVtPSnfhg/itHerCRnttDcKx0VOXOyYlH6TElZxi2nw6Xi+4KpM3q9KOhdlc5QwOptP3z23G+317Wz2qs7bj+uSvtTcHLux+HBzNTfHdyYlfQij0QJYmAABAgQIECBAgAABAgQIECBAgAABAgQIECBAgAABAgQIECBAgAABAgQIECBAgAABAgQIECBAgAABAgQIECBAgAABAgQIECBAgMD/J/AXxu8o7t5Og6cAAAAASUVORK5CYII=" />
                                                        </defs>
                                                    </svg>
                                                    <div class="quantity_value ur26_black"
                                                        id="quantity-<?php echo $row['id']; ?>"
                                                        data-product-id="<?php echo htmlspecialchars($row['id']); ?>"
                                                        data-display-quantity="<?php echo htmlspecialchars($displayQuantity); ?>">
                                                        1
                                                    </div>
                                                    <svg class="svg_quantiti"
                                                        onclick="increaseQuantity('<?php echo $row['id']; ?>')" width="29"
                                                        height="29" viewBox="0 0 29 29" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                                        <rect width="29" height="29" fill="url(#pattern0_814_86)" />
                                                        <defs>
                                                            <pattern id="pattern0_814_86"
                                                                patternContentUnits="objectBoundingBox" width="1" height="1">
                                                                <use xlink:href="#image0_814_86" transform="scale(0.01)" />
                                                            </pattern>
                                                            <image id="image0_814_86" width="100" height="100"
                                                                xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAAAXNSR0IArs4c6QAAA5VJREFUeAHtnM1u00AUhSMQCHgHeA3+NizYlLaeSVD2rHiObAAB8owRYtF1gUVegh2SZ8ySFSqiINiyQCygEkW3cdXIrUtsjcmZ+FSymp/GOff7cuPE9fVgwB8SIAESIAESIAESIAESIAESIAESiJ1AsbV5SZbY64g6v0vV5SLTL5xV37zV+7I4q7/mRj+X+6IuLrbwPtN3ndE/D0VUf+dG/Sis1rHVFWVeb9Vtb/VeVUL1ujPqt7f6VpRFxhK62Lp/zttkpwq/9rrRH99PxudjqS+6nLlRw1r45Xbk2P1ZkkRXaCyBC6uzY8DrRBzdnsZSX3Q58zR53VSIy/Sr6AqNJbC3etpUiDwmlvqiy0khYMoohELACIDFYYdQCBgBsDjsEAoBIwAWhx1CIWAEwOKwQygEjABYHHYIhYARAIvDDqEQMAJgcdghFAJGACwOO4RCwAiAxWGHUAgYAbA47BAKASMAFocdQiFgBGriTKfjs3k23HCZelRY9bJ85cpRhd0uRn1pfOTi7DHd5irrFhYzJqN1YVSDL+zN3o5uNhoJODro+WDKqTHQaB+f7Lhn6kZY+pW1+SxJFhmW6Q/02ShdXb0yNOSM2qxgDHO1yDauOKO/1z05bz9ZjjATdmEszK3FW50S+snQ/8WlsMOncyjDXPRtNqjRvv+3A3+KmM9hLJRreWvGF53Rf055wp5tsJsJE3bCMJgUCmkmoPrCFSFvJvcuBBMiK+JbVnspzujdoDJkZbJhqprn9YUlPQ4vhB97W20nO/vYK4blS055hoRW4frWUcJKdjEF7475FeZ2eD23+kPf4DatVxi9S0fX5tl1dnl/MjnjU3WnsPqhN8l25zsVD3datvku9B93LgqLAyZWrwmjzgSgrJj/D0ExUeagEAoBIwAWhx1CIWAEwOKwQygEjABYHHYIhYARAIvDDqEQMAJgcdghFAJGACwOO4RCwAiAxWGHUAgYAbA47BAKASMAFocdQiFgBMDisEMoBIwAWBx2CIWAEQCLww4BE1LOxDc70Nsk22BlrE4cGcpvetCzz4YPVocAWCWFHa03FmL1GlgZqxNHTlfR5CwSMhLQi6PQl6m4yNRVZ9WvBTplT04DssysvXnu2SRX/VklZIys88ml3tBesFA5XYUMosqEq4wdy5Jb9ckb9aSTU1ksmIt/NhgMZAY8+Bw4yZIACZAACZAACZAACZAACZAACZDAMgj8BX8dWqgKKxW3AAAAAElFTkSuQmCC" />
                                                        </defs>
                                                    </svg>
                                                </div>
                                                <div class="ur16_black">В наличии:
                                                    <?php echo htmlspecialchars($displayQuantity); ?>
                                                    шт.
                                                </div>
                                            </div>
                                            <div class="price_delete">
                                                <div class="ub26_oranj item__price"
                                                    data-price=" <?php echo htmlspecialchars($row['price']) ?>"
                                                    id="price-<?php echo $row['id']; ?>">
                                                    <?php echo htmlspecialchars($row['price']) . ' ₽'; ?>
                                                </div>
                                                <form action="functions.php" method="post">
                                                    <input type="hidden" name="productId" value="<?php echo $productId; ?>">
                                                    <button class="svg_delete" type="submit" class="delete-button"
                                                        title="Удалить товар из корзины">
                                                        <svg class="svg_quantiti" id="delete-icon" width="29" height="29"
                                                            viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <rect width="29" height="29" fill="url(#pattern0_814_90)" />
                                                            <defs>
                                                                <pattern id="pattern0_814_90"
                                                                    patternContentUnits="objectBoundingBox" width="1"
                                                                    height="1">
                                                                    <use xlink:href="#image0_814_90" transform="scale(0.01)" />
                                                                </pattern>
                                                                <image id="image0_814_90" width="100" height="100"
                                                                    xlink:href="data:image/png;base64,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" />
                                                            </defs>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }

                        $conn->close();
                        ?>
                    </div>
                </div>
                <div class="basket_block2">
                    <div class="product_basket_block">
                        <div class="ur18_gray">Товары, <span class="total__count">1</span> шт.</div>
                        <!-- <div class="ur18_gray"><?php echo $row['price']; ?> ₽</div> -->
                    </div>
                    <div class="product_basket_block">
                        <div class="ub36_black">Итого</div>
                        <div class="ub36_black total__price"></div>
                    </div>
                    <a href="making_order.php"><button class="button ur26_white btn">Перейти к
                            оформлению</button></a>
                </div>

            </div>
        </div>
    </div>
    <?php
    include 'footer.php';
    ?>
    <script>

        window.onload = function () {
            reloadBasket();
        }

        // УВЕЛИЧЕНИЕ И УМЕНЬШЕНИЕ КОЛИЧЕСТВА ТОВАРОВ (+ И -)
        function increaseQuantity(productId) {
            var quantityValueElement = document.getElementById('quantity-' + productId);
            var currentQuantity = parseInt(quantityValueElement.textContent);
            var maxQuantity = parseInt(quantityValueElement.getAttribute('data-display-quantity'));

            // Увеличиваем количество на 1, но не больше максимального значения
            var newQuantity = Math.min(currentQuantity + 1, maxQuantity);
            quantityValueElement.textContent = newQuantity;

            // Получаем цену из базы данных
            var priceElement = document.getElementById('price-' + productId);
            // var priceText = priceElement.textContent.replace(' ₽', '');
            // var price = parseFloat(priceText);
            var price = parseInt(priceElement.dataset.price)

            // Рассчитываем новую общую стоимость, увеличивая ее на цену товара
            var totalPrice = ((newQuantity) * price); // Исправлено: теперь корректно рассчитывается новая общая стоимость
            var newTotalPriceText = totalPrice.toFixed(2) + ' ₽';
            priceElement.textContent = newTotalPriceText;

            reloadBasket()
        }

        function decreaseQuantity(productId) {
            var quantityValueElement = document.getElementById('quantity-' + productId);
            var currentQuantity = parseInt(quantityValueElement.textContent);

            if (currentQuantity <= 1) {
                return;
            }

            var newQuantity = currentQuantity - 1;
            quantityValueElement.textContent = newQuantity;

            // Получаем цену из базы данных
            var priceElement = document.getElementById('price-' + productId);
            // var priceText = priceElement.textContent.replace(' ₽', '');
            // var price = parseFloat(priceText);
            var price = parseInt(priceElement.dataset.price)

            // Рассчитываем новую общую стоимость, увеличивая ее на цену товара
            var totalPrice = ((newQuantity) * price); // Исправлено: теперь корректно рассчитывается новая общая стоимость
            var newTotalPriceText = totalPrice.toFixed(2) + ' ₽';
            priceElement.textContent = newTotalPriceText;

            reloadBasket()
        }
 
        function reloadBasket() {
            var priceElement = document.querySelectorAll('.product_basket');
            var total_price = 0;
            var total_count = 0;

            for (let i = 0; i < priceElement.length; i++) {
                let thisel = priceElement[i].querySelector('.item__price');
                let price = thisel.getAttribute('data-price');
                let quantity = parseInt(priceElement[i].querySelector('.quantity_value').textContent);
                total_price += (price * quantity);
                total_count += quantity;
            }

            document.querySelector('.total__price').textContent = total_price + ' ₽';
            document.querySelector('.total__count').textContent = total_count;
        }

        // СОХРАНЕНИЕ КОЛИЧЕСТВА ТОВАРА В СЕССИИ
        function saveToSession(productId, quantity) {
            // Сохраняем количество товара в сессию
            var url = 'functions.php'; 
            var data = { productId: productId, quantity: quantity };
            console.log(quantity);
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            }).then(response => response.json())
                .then(data => console.log(data))
                .catch((error) => console.error('Error:', error));
        }
    </script>
</body>

</html>