<?php
session_start();
require_once("controllers/db.php");

// Проверка авторизации пользователя
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

// Получение информации о пользователе
$user_id = $_SESSION['id'];
$user_query = "SELECT * FROM Users WHERE id = $user_id";
$user_result = mysqli_query($conn, $user_query);
$user = mysqli_fetch_assoc($user_result);

// Получение заказов пользователя
$orders_query = "SELECT * FROM cart WHERE User_id = $user_id";
$orders_result = mysqli_query($conn, $orders_query);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ТочноВкусно - Личный кабинет</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png" />
    <link rel="manifest" href="/site.webmanifest" />
    <style>
        .sidebar {
            background-color: #f8f9fa;
            min-height: calc(100vh - 200px);
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .profile-card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .order-card {
            transition: transform 0.3s;
        }
        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .nav-link.active {
            font-weight: bold;
            border-left: 3px solid #d10f18;
        }
    </style>
</head>
<body>
    <!-- Навигация -->
    <header>
      <nav class="navbar navbar-expand-lg bg-white p-0">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php"
            ><img
              src="img/logo.png"
              alt="Логотип ТочноВкусно"
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
                <a class="nav-link" href="index.php">Главная</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="menu.php">Меню</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about-us.html">О нас</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="support.html">Обратная связь</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="profile.php">Профиль</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <main class="border-top border-danger border-3">
        <div class="container-fluid">
            <div class="row">
                <!-- Боковое меню -->
                <div class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                    <div class="position-sticky pt-3">
                        <h4 class="text-center mb-4">Личный кабинет</h4>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active text-danger" href="#" id="profile-tab">
                                    Ваш профиль
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-danger" href="#" id="orders-tab">
                                    Мои заказы
                                </a>
                            </li>
                            <li class="nav-item mt-4">
                                <a class="text-danger" href="controllers/destroy.php">
                                    Выйти
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Основное содержимое -->
                <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                    <!-- Профиль пользователя -->
                    <div id="profile-content" class="content-section">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2">Ваш профиль</h1>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card profile-card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Персональные данные</h5>
                                        <div class="mb-3">
                                            <label class="form-label">Имя</label>
                                            <p class="form-control-static"><?php echo htmlspecialchars($user['fname']); ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Фамилия</label>
                                            <p class="form-control-static"><?php echo htmlspecialchars($user['lname']); ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Телефон</label>
                                            <p class="form-control-static"><?php echo htmlspecialchars($user['phonenumber']); ?></p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card profile-card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Статистика заказов</h5>
                                        <div class="mb-3">
                                            <label class="form-label">Всего заказов</label>
                                            <p class="form-control-static"><?php echo mysqli_num_rows($orders_result); ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Последний заказ</label>
                                            <p class="form-control-static">
                                                <?php 
                                                if(mysqli_num_rows($orders_result) > 0) {
                                                    echo "Заказ #" . mysqli_num_rows($orders_result);
                                                } else {
                                                    echo "У вас пока нет заказов";
                                                }
                                                ?>
                                            </p>
                                        </div>
                                        <a href="menu.php" class="btn btn-outline-danger">Сделать новый заказ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Мои заказы -->
                    <div id="orders-content" class="content-section" style="display: none;">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2">Мои заказы</h1>
                        </div>

                        <?php if(mysqli_num_rows($orders_result) > 0): ?>
                            <div class="row">
                                <?php while($order = mysqli_fetch_assoc($orders_result)): 
                                    $product_query = "SELECT * FROM Menu WHERE id = " . $order['product_id'];
                                    $product_result = mysqli_query($conn, $product_query);
                                    $product = mysqli_fetch_assoc($product_result);
                                ?>
                                <div class="col-md-6 mb-4">
                                    <div class="card order-card h-100">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <img src="<?php echo htmlspecialchars($product['img']); ?>" class="img-fluid rounded-start h-100" alt="<?php echo htmlspecialchars($product['Name']); ?>" style="object-fit: cover;">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo htmlspecialchars($product['Name']); ?></h5>
                                                    <p class="card-text text-muted"><?php echo htmlspecialchars($product['Opisanie']); ?></p>
                                                    <p class="card-text"><strong>Цена: <?php echo htmlspecialchars($product['Price']); ?> руб.</strong></p>
                                                    <p class="card-text"><small class="text-muted">Заказ #<?php echo $order['id']; ?></small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endwhile; ?>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-info">
                                У вас пока нет заказов. <a href="menu.php" class="alert-link">Перейти в меню</a> чтобы сделать первый заказ!
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 border-top border-danger border-3">
      <p class="col-md-4 mb-0 text-muted">
        &copy; 2025 ТочноВкусно <a class="text-danger">|</a> все права защищены
      </p>

      <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <img src="img/logo.png" alt="Логотип ТочноВкусно" style="width: 200px" />
      </a>

      <ul class="nav col-md-4 justify-content-end">
        <li class="nav-item">
          <a href="index.php" class="nav-link px-2 text-muted">Главная</a>
        </li>
        <li class="nav-item">
          <a href="menu.php" class="nav-link px-2 text-muted">Меню</a>
        </li>
        <li class="nav-item">
          <a href="about-us.html" class="nav-link px-2 text-muted">О нас</a>
        </li>
        <li class="nav-item">
          <a href="support.html" class="nav-link px-2 text-muted">Обратная связь</a>
        </li>
      </ul>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script>
      new WOW().init();
      
      // Переключение вкладок
      document.addEventListener('DOMContentLoaded', function() {
          const profileTab = document.getElementById('profile-tab');
          const ordersTab = document.getElementById('orders-tab');
          const profileContent = document.getElementById('profile-content');
          const ordersContent = document.getElementById('orders-content');
          
          profileTab.addEventListener('click', function(e) {
              e.preventDefault();
              profileTab.classList.add('active');
              ordersTab.classList.remove('active');
              profileContent.style.display = 'block';
              ordersContent.style.display = 'none';
          });
          
          ordersTab.addEventListener('click', function(e) {
              e.preventDefault();
              ordersTab.classList.add('active');
              profileTab.classList.remove('active');
              ordersContent.style.display = 'block';
              profileContent.style.display = 'none';
          });
      });
    </script>
</body>
</html>