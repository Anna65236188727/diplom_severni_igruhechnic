<header class="header">
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
<script>
    document.querySelector('.burger').addEventListener('click', function () {
        this.classList.toggle('active');
        document.querySelector('.nav').classList.toggle('open');
    })
</script>