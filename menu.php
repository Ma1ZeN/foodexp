<?php
require_once("controllers/db.php");
$sql = "SELECT * FROM restourants";
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
      }
      
      /* Улучшенные карточки заведений */
      .establishment-card {
        transition: var(--transition);
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--shadow);
        margin-bottom: 24px;
        height: 100%;
      }
      
      .establishment-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
      }
      
      .card-img-container {
        height: 200px;
        overflow: hidden;
        position: relative;
      }
      
      .card-img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition);
      }
      
      .establishment-card:hover .card-img-container img {
        transform: scale(1.05);
      }
      
      .card-body {
        padding: 20px;
      }
      
      .card-title {
        font-weight: 700;
        font-size: 1.25rem;
        margin-bottom: 8px;
        color: var(--text-color);
      }
      
      .card-text {
        color: var(--light-text);
        font-size: 0.9rem;
        margin-bottom: 12px;
      }
      
      .badge-rating {
        background-color: rgba(255, 215, 0, 0.2);
        color: #ffc107;
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
      }
      
      .badge-rating svg {
        margin-right: 5px;
      }
      
      .work-time {
        color: var(--light-text);
        font-size: 0.85rem;
      }
      
      .btn-choose {
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 0;
        font-weight: 600;
        width: 100%;
        transition: var(--transition);
        margin-top: 15px;
      }
      
      .btn-choose:hover {
        background-color: #b00d15;
        transform: translateY(-2px);
      }
      
      .card-footer {
        background: white;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }
      
      .delivery-info {
        font-size: 0.8rem;
        color: var(--light-text);
      }
      
      .delivery-info span {
        color: var(--primary-color);
        font-weight: 600;
      }
      
      /* Дополнительные стили */
      .section-title {
        position: relative;
        margin-bottom: 30px;
        font-weight: 700;
      }
      
      .section-title:after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 60px;
        height: 3px;
        background: var(--primary-color);
      }
      
      .alert-info {
        border-left: 4px solid var(--primary-color);
        border-radius: 0;
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
        <h2 class="section-title">Рестораны и кафе</h2>
        
        <div class="alert alert-info">
          <strong>Доступные заведения:</strong> Выберите место, где хотите заказать.
        </div>

        <div class="row" id="establishments-container">
          <?php
          while ($restoran = $result->fetch_assoc()) {
            echo '
            <div class="col-md-6 col-lg-4">
              <div class="card establishment-card h-100">
                <div class="card-img-container">
                  <img src="'.$restoran["img"].'" alt="'.$restoran["name"].'" />
                </div>
                <div class="card-body">
                  <h5 class="card-title">'.$restoran["name"].'</h5>
                  <p class="card-text">'.$restoran["adress"].'</p>
                  <button class="btn btn-choose choose-establishment" data-id="'.$restoran["id"].'">
                    Выбрать
                  </button>
                </div>
                <div class="card-footer">
                  <span class="badge-rating">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="16"
                      height="16"
                      fill="#FFD700"
                      class="bi bi-star-fill"
                      viewBox="0 0 16 16"
                    >
                      <path
                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                      />
                    </svg>
                    '.$restoran["rating"].'
                  </span>
                  <span class="work-time">'.$restoran["workTime"].'</span>
                </div>
              </div>
            </div>';
          }
          ?>
        </div>
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
      // Добавляем обработчик для кнопок выбора
      document.querySelectorAll('.choose-establishment').forEach(button => {
        button.addEventListener('click', function() {
          const establishmentId = this.getAttribute('data-id');
          window.location.href = `products.php?id=${establishmentId}`;
        });
      });
    </script>
  </body>
</html>