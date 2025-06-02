<?php
session_start();
require_once("controllers/db.php");
$user_id=$_SESSION["id"];
<<<<<<< HEAD
$sql="SELECT * FROM cart WHERE user_id = $user_id";
$sql1="SELECT * FROM Menu"
$result = $conn->query($sql);++
=======
$sql="SELECT product_id FROM cart WHERE user_id = $user_id";
$result = $conn->query($sql);


>>>>>>> 77c1b1bcf9b9a625351dad83f6ed6f6e45311d33
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ТочноВкусно - Корзина</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
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
      .cart-item {
        transition: all 0.3s ease;
      }
      .cart-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      }
      .quantity-btn {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .empty-cart {
        min-height: 300px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
      }
      .summary-card {
        position: sticky;
        top: 20px;
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
                <a class="nav-link" href="index.html">Главная</a>
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
                <a class="nav-link active" href="cart.php">Корзина</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <main class="border-top border-danger border-3 py-4">
      <div class="container">
        <h1 class="mb-4">Ваша корзина</h1>
        
        <div class="row">
          <!-- Список товаров -->
          <div class="col-lg-8">
            <!-- Место для выгрузки товаров из корзины -->
            <div id="cart-items-container">
              <!-- Пример товара (будет заменен серверным рендерингом) -->
               <?php
<<<<<<< HEAD
               while($cart = $result->fetch_assoc()){
                echo
               }
               ?>
              <div class="card mb-3 cart-item">
                <div class="row g-0">
                  <div class="col-md-3">
                    <img src="https://images.unsplash.com/photo-1615870216519-2f9fa575fa5c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                         class="img-fluid rounded-start h-100" 
                         alt="Шаурма классическая"
                         style="object-fit: cover;">
                  </div>
                  <div class="col-md-6">
                    <div class="card-body">
                      <h5 class="card-title">Шаурма классическая</h5>
                      <p class="card-text text-muted">Курица, свежие овощи, соус чесночный, лаваш</p>
                      <div class="d-flex align-items-center">
                        <button class="btn btn-outline-secondary quantity-btn minus-btn">-</button>
                        <span class="mx-2 quantity">1</span>
                        <button class="btn btn-outline-secondary quantity-btn plus-btn">+</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 d-flex flex-column justify-content-between align-items-end p-3">
                    <button class="btn btn-link text-danger p-0 remove-btn">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                      </svg>
                    </button>
                    <div class="fw-bold price">250 ₽</div>
                  </div>
                </div>
              </div>
=======
               $total = 0;
               while ($row = $result ->fetch_assoc()){
                $product_id =$row["product_id"];
                $sql1 = "SELECT * FROM Menu where id = $product_id";
                $result1 = $conn->query($sql1);
                while ($row1 = $result1->fetch_assoc()){
                  $total += $row1["Price"];
                  echo '<div class="card mb-3 cart-item">
                          <div class="row g-0">
                            <div class="col-md-3">
                              <img src="'.$row1["img"].'" 
                                  class="img-fluid rounded-start h-100" 
                                  style="object-fit: cover;">
                            </div>
                            <div class="col-md-6">
                              <div class="card-body">
                                <h5 class="card-title">'.$row1["Name"].'</h5>
                                <p class="card-text text-muted">'.$row1["Opisanie"].'</p>
                                
                              </div>
                            </div>
                            <div class="col-md-3 d-flex flex-column justify-content-between align-items-end p-3">
                              <button class="btn btn-link text-danger p-0 remove-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                </svg>
                              </button>
                              <div class="fw-bold price">250 ₽</div>
                            </div>
                          </div>
                        </div>';
                }
                
              }
               ?>
              
>>>>>>> 77c1b1bcf9b9a625351dad83f6ed6f6e45311d33
              
              <!-- Пустая корзина (скрыто по умолчанию) -->
              <div id="empty-cart-message" class="empty-cart text-center d-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#d10f18" class="bi bi-cart-x mb-3" viewBox="0 0 16 16">
                  <path d="M7.354 5.646a.5.5 0 1 0-.708.708L7.793 7.5 6.646 8.646a.5.5 0 1 0 .708.708L8.5 8.207l1.146 1.147a.5.5 0 0 0 .708-.708L9.207 7.5l1.147-1.146a.5.5 0 0 0-.708-.708L8.5 6.793z"/>
                  <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.5-2H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                </svg>
                <h3 class="mb-3">Ваша корзина пуста</h3>
                <p class="text-muted mb-4">Добавьте что-нибудь из меню, чтобы сделать заказ</p>
                <a href="menu.php" class="btn btn-danger">Перейти в меню</a>
              </div>
            </div>
          </div>
          
          <!-- Итоговая информация -->
          <div class="col-lg-4">
            <div class="card summary-card">
              <div class="card-body">
                <h5 class="card-title mb-3">Итого</h5>
                <hr>
                
                <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
                  <span>К оплате:</span>
                  <span id="total-price"><?php echo $total ?></span>
                </div>
                <button id="checkout-btn" class="btn btn-danger w-100 py-2">Оформить заказ</button>
              </div>
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
          <a href="index.html" class="nav-link px-2 text-muted">Главная</a>
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
      
      // Клиентская логика корзины
      document.addEventListener('DOMContentLoaded', function() {
        // Здесь будет выгрузка данных корзины с сервера
        // fetchCartData();
        
        // Обработчики для демонстрации (будут заменены серверной логикой)
        const minusBtns = document.querySelectorAll('.minus-btn');
        const plusBtns = document.querySelectorAll('.plus-btn');
        const removeBtns = document.querySelectorAll('.remove-btn');
        
        minusBtns.forEach(btn => {
          btn.addEventListener('click', function() {
            const quantityElement = this.nextElementSibling;
            let quantity = parseInt(quantityElement.textContent);
            if (quantity > 1) {
              quantity--;
              quantityElement.textContent = quantity;
              updateCartSummary();
            }
          });
        });
        
        plusBtns.forEach(btn => {
          btn.addEventListener('click', function() {
            const quantityElement = this.previousElementSibling;
            let quantity = parseInt(quantityElement.textContent);
            quantity++;
            quantityElement.textContent = quantity;
            updateCartSummary();
          });
        });
        
        removeBtns.forEach(btn => {
          btn.addEventListener('click', function() {
            const cartItem = this.closest('.cart-item');
            cartItem.remove();
            checkEmptyCart();
            updateCartSummary();
          });
        });
        
        function checkEmptyCart() {
          const cartItems = document.querySelectorAll('.cart-item');
          const emptyCartMessage = document.getElementById('empty-cart-message');
          
          if (cartItems.length === 0) {
            emptyCartMessage.classList.remove('d-none');
          } else {
            emptyCartMessage.classList.add('d-none');
          }
        }
        
        function updateCartSummary() {
          // Здесь будет расчет итоговой суммы на основе данных с сервера
          // Пока просто демонстрационная логика
          const quantities = document.querySelectorAll('.quantity');
          const prices = document.querySelectorAll('.price');
          let subtotal = 0;
          let totalItems = 0;
          
          quantities.forEach((qty, index) => {
            const quantity = parseInt(qty.textContent);
            const price = parseInt(prices[index].textContent);
            subtotal += quantity * price;
            totalItems += quantity;
          });
          
          document.getElementById('subtotal').textContent = subtotal + ' ₽';
          document.getElementById('total-price').textContent = subtotal + ' ₽';
          document.querySelector('.d-flex.justify-content-between.mb-2 span:first-child').textContent = 
            `Товары (${totalItems}):`;
        }
        
        document.getElementById('checkout-btn').addEventListener('click', function() {
          // Показываем индикатор загрузки
          this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Оформление...';
          this.disabled = true;
          
          fetch('create_order.php', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json',
              }
          })
          .then(response => response.json())
          .then(data => {
              if (data.success) {
                  alert(data.message);
                  // Обновляем страницу после успешного оформления
                  location.reload();
              } else {
                  alert('Ошибка: ' + data.message);
              }
          })
          .catch(error => {
              console.error('Error:', error);
              alert('Произошла ошибка при оформлении заказа');
          })
          .finally(() => {
              // Восстанавливаем кнопку в исходное состояние
              this.innerHTML = 'Оформить заказ';
              this.disabled = false;
          });
      });
      });
    </script>
  </body>
</html>