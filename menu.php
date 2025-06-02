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
      .cart-btn {
        position: relative;
      }
      .cart-count {
        position: absolute;
        top: -5px;
        right: -5px;
        background: #d10f18;
        color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .offcanvas-cart {
        width: 400px;
      }
      .minus-item,
      .plus-item {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
      }
      .cart-btn {
        position: relative;
      }
      .cart-count {
        position: absolute;
        top: -5px;
        right: -5px;
        background: #d10f18;
        color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .offcanvas-cart {
        width: 400px;
      }
      .category-icon {
        width: 40px;
        height: 40px;
        margin-right: 10px;
      }
      .establishment-card {
        transition: transform 0.2s;
      }
      .establishment-card:hover {
        transform: translateY(-5px);
      }
      .menu-item-badge {
        font-size: 0.75rem;
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
            </ul>
          </div>
        </div>
      </nav>
      <button
        class="btn btn-outline-danger position-fixed cart-btn"
        style="top: 20px; right: 20px; z-index: 1000"
        data-bs-toggle="offcanvas"
        data-bs-target="#cartOffcanvas"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          fill="currentColor"
          class="bi bi-cart"
          viewBox="0 0 16 16"
        >
          <path
            d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"
          />
        </svg>
        <span class="cart-count" id="cartCounter">0</span>
      </button>
    </header>

    <main class="border-top border-danger border-3">
      <div class="container-fluid py-4">
       

          <div class="alert alert-info">
            <strong>Доступные заведения:</strong> Выберите место, где хотите
            заказать.
          </div>

          <div class="row g-4" id="establishments-container">
            <?php
            while ($restoran = $result-> fetch_assoc()) {
              echo '<div
              class="card establishment-card h-100 border-0 shadow-sm"
              data-id="'.$restoran["id"].'"
            >
              <div class="row g-0">
                <div class="col-md-4">
                  <img
                    src="'.$restoran["img"].'"
                    class="img-fluid rounded-start h-100"
                    style="object-fit: cover"
                  />
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">'.$restoran["name"].'</h5>
                    <p class="card-text text-muted small">'.$restoran["adress"].'</p>
                    <div
                      class="d-flex justify-content-between align-items-center"
                    >
                      <span class="badge bg-light text-dark">
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
                      <span class="text-muted small">'.$restoran["workTime"].'</span>
                    </div>
                    <a href="products.php?id='.$restoran["id"].'"
                  
                      class="btn btn-danger w-100 mt-3 choose-establishment"
                    >
                      Выбрать
                    </a>
                  </div>
                </div>
              </div>
            </div>';
            }
            ?>
            
          </div>
        </section>

        <!-- Шаг 3: Меню заведения (изначально скрыт) -->
        <section id="step-menu" style="display: none">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
              <h2 class="text-danger mb-0" id="establishment-name">Маруша</h2>
              <p class="text-muted mb-0" id="establishment-address">
                ул. Панфиловцев, 18а
              </p>
              <p class="text-muted mb-0" id="establishment-category">Пицца</p>
            </div>
            <div>
              <button
                class="btn btn-outline-secondary me-2"
                id="back-to-establishments"
              >
                ← Назад к заведениям
              </button>
              <button
                class="btn btn-outline-danger"
                id="back-to-categories-from-menu"
              >
                ← К категориям
              </button>
            </div>
          </div>

          <div class="alert alert-success">
            <strong>Предзаказ доступен!</strong> Выберите блюда, укажите время
            получения и заберите заказ без очереди.
          </div>

          <div class="row g-4" id="menu-items-container">
            <!-- Блюда будут загружаться здесь -->
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
    <div
      class="offcanvas offcanvas-end offcanvas-cart"
      tabindex="-1"
      id="cartOffcanvas"
    >
      <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title">Ваша корзина</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="offcanvas"
          aria-label="Close"
        ></button>
      </div>
      <div class="offcanvas-body" id="cartItems">
        <!-- Тут будут товары -->
        <div class="text-center text-muted py-4">Корзина пуста</div>
      </div>
      <div class="offcanvas-footer border-top p-3">
        <div class="d-flex justify-content-between mb-3">
          <span>Итого:</span>
          <span class="fw-bold" id="cartTotal">0 ₽</span>
        </div>
        <button class="btn btn-danger w-100">Оформить заказ</button>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      // Данные заведений (в реальном проекте можно загружать с сервера)
      const establishmentsData = {
        pizza: [
          {
            id: "marusha",
            name: "Маруша",
            address: "ул. Панфиловцев, 18а",
            rating: 4.8,
            deliveryTime: "30-45 мин",
            image:
              "https://images.unsplash.com/photo-1513104890138-7c749659a591?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
          },
          {
            id: "foodmix",
            name: "Food mix",
            address: "ул. Георгиева, 51Б",
            rating: 4.5,
            deliveryTime: "25-40 мин",
            image:
              "https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
          },
          {
            id: "brusnika",
            name: "Брусника",
            address: "ул. Георгиева, 57",
            rating: 4.7,
            deliveryTime: "35-50 мин",
            image:
              "https://images.unsplash.com/photo-1559847844-5315695dadae?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
          },
        ],
        burgers: [
          {
            id: "foodmix",
            name: "Food mix",
            address: "ул. Георгиева, 51Б",
            rating: 4.5,
            deliveryTime: "20-35 мин",
            image:
              "https://images.unsplash.com/photo-1568901346375-23c9450c58cd?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
          },
        ],
        shawarma: [
          {
            id: "marusha",
            name: "Маруша",
            address: "ул. Панфиловцев, 18а",
            rating: 4.8,
            deliveryTime: "30-45 мин",
            image:
              "https://images.unsplash.com/photo-1513104890138-7c749659a591?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
          },
          {
            id: "foodmix",
            name: "Food mix",
            address: "ул. Георгиева, 51Б",
            rating: 4.5,
            deliveryTime: "25-40 мин",
            image:
              "https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
          },
          {
            id: "shaverma22",
            name: "Шаурма22",
            address: "Павловский тракт, 142г",
            rating: 4.9,
            deliveryTime: "15-25 мин",
            image:
              "https://images.unsplash.com/photo-1615870216519-2f9fa575fa5c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
          },
          {
            id: "flagvkusa",
            name: "Под флагом вкуса",
            address: "Молодёжная ул., 25Б",
            rating: 4.6,
            deliveryTime: "30-45 мин",
            image:
              "https://images.unsplash.com/photo-1571091718767-18b5b1457add?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
          },
        ],
        bakery: [
          {
            id: "sdelano",
            name: "Сделано с любовью",
            address: "Взлётная, 16",
            rating: 4.7,
            deliveryTime: "20-30 мин",
            image:
              "https://images.unsplash.com/photo-1601050690597-df0568f70950?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
          },
        ],
        desserts: [
          {
            id: "sdelano",
            name: "Сделано с любовью",
            address: "Взлётная, 16",
            rating: 4.7,
            deliveryTime: "20-30 мин",
            image:
              "https://images.unsplash.com/photo-1601050690597-df0568f70950?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
          },
        ],
      };

      // Данные меню (в реальном проекте можно загружать с сервера)
      const menuData = {
        marusha: [
          {
            name: "Чилл Грилл",
            price: 450,
            description:
              "Цыпленок, маринованные огурчики, соус гриль, красный лук, моцарелла, чеснок, фирменный соус альфредо",
            image:
              "https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
            badge: "Хит",
          },
          {
            name: "Баварская",
            price: 490,
            description:
              "Баварские колбаски, маринованные огурчики, красный лук, томаты, горчичный соус, моцарелла, фирменный томатный соус",
            image:
              "https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
            badge: "Новинка",
          },
        ],
        foodmix: [
          {
            name: "Классический бургер",
            price: 320,
            description:
              "Говяжья котлета, сыр чеддер, салат, помидор, лук, соус",
            image:
              "https://images.unsplash.com/photo-1568901346375-23c9450c58cd?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
            badge: "Хит",
          },
        ],
        shaverma22: [
          {
            name: "Шаурма классическая",
            price: 250,
            description: "Курица, свежие овощи, соус чесночный, лаваш",
            image:
              "https://images.unsplash.com/photo-1615870216519-2f9fa575fa5c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
            badge: null,
          },
        ],
        sdelano: [
          {
            name: "Круассан с шоколадом",
            price: 180,
            description: "Свежий круассан с начинкой из черного шоколада",
            image:
              "https://images.unsplash.com/photo-1563729785-e97ed0b6a827?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
            badge: "Хит",
          },
          {
            name: "Тирамису",
            price: 350,
            description: "Классический итальянский десерт с кофе и маскарпоне",
            image:
              "https://images.unsplash.com/photo-1535920527002-b35e96722eb9?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
            badge: "Новинка",
          },
        ],
      };

      
      
       
      
     
        menuItems.forEach((item) => {
          const card = document.createElement("div");
          card.className = "col-xl-4 col-lg-6";
          card.innerHTML = `
            <div class="card menu-item h-100 border-0 shadow-sm">
              <div class="position-relative">
                <img src="${item.image}" class="card-img-top" alt="${
            item.name
          }">
                
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                  <h5 class="card-title mb-0">${item.name}</h5>
                  <span class="text-danger fw-bold">${item.price} ₽</span>
                </div>
                <p class="card-text text-muted small">${item.description}</p>
              </div>
              <div class="card-footer bg-white border-0 pt-0">
                <button class="btn btn-danger w-100">В корзину</button>
              </div>
            </div>
          `;
          container.appendChild(card);
        });
      

    </script>
  </body>
</html>
