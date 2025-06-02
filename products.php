<?php
require_once("controllers/db.php");
$id = $_GET['id'];
$sql = "SELECT * FROM Menu WHERE Restoran=$id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Меню | ТочноВкусно</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="style.css" />
    <link
      rel="apple-touch-icon"
      sizes="180x180"
      href="img/apple-touch-icon.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="32x32"
      href="img/favicon-32x32.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="16x16"
      href="img/favicon-16x16.png"
    />
    <link rel="manifest" href="/site.webmanifest" />
    <style>
      :root {
        --primary-color: #d10f18;
        --secondary-color: #f8f9fa;
        --text-color: #333;
        --light-text: #6c757d;
        --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
      }
      
      body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: var(--text-color);
        background-color: #f9f9f9;
      }
      
      /* Улучшенные карточки блюд */
      .menu-item {
        transition: var(--transition);
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--shadow);
        margin-bottom: 24px;
        height: 100%;
        /* position: relative; */
        background: white;
      }
      
      .menu-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
      }
      
      .menu-item-img {
        height: 200px;
        width: 100%;
        object-fit: cover;
        transition: var(--transition);
      }
      
      .menu-item:hover .menu-item-img {
        transform: scale(1.03);
      }
      
      .menu-item-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        border-radius: 20px;
        padding: 5px 12px;
        font-size: 0.85rem;
        font-weight: 600;
        z-index: 1;
      }
      
      .menu-item-body {
        padding: 20px;
      }
      
      .menu-item-title {
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 8px;
        color: var(--text-color);
      }
      
      .menu-item-price {
        font-weight: 700;
        color: var(--primary-color);
        font-size: 1.2rem;
      }
      
      .menu-item-desc {
        height: 103px;
        color: var(--light-text);
        font-size: 0.9rem;
        margin-bottom: 15px;
        line-height: 1.5;
      }
      
      .btn-add-to-cart {
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 0;
        font-weight: 600;
        width: 100%;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0;
      }
      
      .btn-add-to-cart:hover {
        background-color: #b00d15;
      }
      
      .btn-add-to-cart svg {
        margin-right: 8px;
      }
      
      /* Анимации */
      @keyframes fadeInUp {
        from {
          opacity: 0;
          transform: translateY(20px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
      
      .menu-item {
        animation: fadeInUp 0.5s ease forwards;
        opacity: 0;
      }
      
      /* Задержки для анимации */
      .menu-item:nth-child(1) { animation-delay: 0.1s; }
      .menu-item:nth-child(2) { animation-delay: 0.2s; }
      .menu-item:nth-child(3) { animation-delay: 0.3s; }
      .menu-item:nth-child(4) { animation-delay: 0.4s; }
      .menu-item:nth-child(5) { animation-delay: 0.5s; }
      .menu-item:nth-child(6) { animation-delay: 0.6s; }
      
      /* Заголовок страницы */
      .page-header {
        position: relative;
        margin-bottom: 30px;
        padding-bottom: 15px;
      }
      
      .page-header:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 3px;
        background: var(--primary-color);
      }
      
      /* Кнопка "Назад" */
      .btn-back {
        border: 2px solid var(--primary-color);
        color: var(--primary-color);
        font-weight: 600;
        transition: var(--transition);
      }
      
      .btn-back:hover {
        background: var(--primary-color);
        color: white;
      }
      
      /* Уведомление */
      .alert-success {
        border-left: 4px solid #28a745;
        border-radius: 0;
      }
      .card{
      }
    </style>
  </head>
  <body>
    <!-- Навигация -->
    <header>
      <nav class="navbar navbar-expand-lg bg-white p-0">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.html"
            ><img
              src="img/logo.png"
              alt="ТочноВкусно - агрегатор заведений питания"
              style="width: 200px"
              class="border-end border-danger"
          /></a>
          <a class="redphone nav-link">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="20"
              height="20"
              fill="#d10f18"
              class="bi bi-telephone-fill"
              viewBox="0 0 16 16"
            >
              <path
                fill-rule="evenodd"
                d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"
              />
            </svg>
            <b>8-(923)-535-35-35</b>
          </a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="index.html">Главная</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="menu.php">Меню</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about-us.html">О нас</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="support.html">Обратная связь</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="login.php">Профиль</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cart.php">Корзина</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <main class="border-top border-danger border-3">
      <div class="container py-4">
        <section id="step-menu">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="page-header">Меню заведения</h2>
            <a class="btn btn-back me-2" href="menu.php">
              ← Назад к заведениям
            </a>
          </div>

          <div class="alert alert-success">
            <strong>Предзаказ доступен!</strong> Выберите блюда, укажите время
            получения и заберите заказ без очереди.
          </div>

          <div class="row g-4" id="menu-items-container">
            <?php
            while($product = $result->fetch_assoc()) {
              echo '
              <div class="col-md-6 col-lg-4">
                <form action="controllers/addcard.php" method="post">
                  <div class="card menu-item h-100">
                    <div class="position-relative overflow-hidden">
                      <img src="'.$product["img"].'" class="menu-item-img">
                      <span class="menu-item-badge">'.$product["Price"].' ₽</span>
                    </div>
                    <div class="menu-item-body">
                      <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="menu-item-title mb-0">'.$product["Name"].'</h5>
                      </div>
                      <p class="menu-item-desc">'.$product["Opisanie"].'</p>
                      <input name="product_id" value="'.$product["id"].'" type="hidden">
                      <button class="btn btn-add-to-cart" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                          <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
                          <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17z"/>
                        </svg>
                        В корзину
                      </button>
                    </div>
                  </div>
                </form>
              </div>';
            }
            ?>
          </div>
        </section>
      </div>
    </main>

    <!-- Подвал -->
    <footer
      class="d-flex flex-wrap justify-content-between align-items-center py-3 border-top border-danger border-3"
    >
      <p class="col-md-4 mb-0 text-muted">
        &copy; 2025 ТочноВкусно <a class="text-danger">|</a> все права защищены
      </p>

      <a
        href="/"
        class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none"
      >
        <img src="img/logo.png" alt="ТочноВкусно" style="width: 200px" />
      </a>

      <ul class="nav col-md-4 justify-content-end">
        <li class="nav-item">
          <a href="index.html" class="nav-link px-2 text-muted">Главная</a>
        </li>
        <li class="nav-item">
          <a href="menu.php" class="nav-link px-2 text-muted">Меню</a>
        </li>
        <li class="nav-item">
          <a href="about-us.html" class="nav-link px-2 text-muted">О нас</a>
        </li>
        <li class="nav-item">
          <a href="support.html" class="nav-link px-2 text-muted"
            >Обратная связь</a
          >
        </li>
      </ul>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      // Анимация при загрузке страницы
      document.addEventListener('DOMContentLoaded', function() {
        const menuItems = document.querySelectorAll('.menu-item');
        
        // Добавляем обработчик для кнопок добавления в корзину
        document.querySelectorAll('.btn-add-to-cart').forEach(button => {
          button.addEventListener('click', function(e) {
            // Можно добавить анимацию добавления в корзину
            this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Добавляем...';
            setTimeout(() => {
              this.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16"><path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/></svg> Добавлено!';
              setTimeout(() => {
                this.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16"><path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/><path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17z"/></svg> В корзину';
              }, 1000);
            }, 500);
          });
        });
      });
    </script>
  </body>
</html>