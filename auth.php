<?php
session_start();
if (isset($_SESSION["role"])){
  if ($_SESSION["role"] === "user"){
    header("Location: profile.php");
    exit;
} else if ($_SESSION["role"] === "admin"){
    header("Location: adminpanel.php");
    exit;
}
}
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ТочноВкусно - Главная</title>
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
                <a class="nav-link active" href="index.html">Главная</a>
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
                <a class="nav-link" href="login.php">Профиль</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <main
      class="d-flex justify-content-center border-top border-danger border-3"
    >
      <form
        class="mt-5 border border-danger border-1 rounded w-auto p-4 col-md-4"
        action="controllers/registration.php"
        method="post"
      >
        <div class="mb-3"><legend>Регистрация</legend></div>
        <div class="mb-3">
          <label class="form-label" for="">Логин</label>
          <input
            class="form-control"
            type="text"
            name="login"
            placeholder="Логин"
            required
          />
        </div>
        <div class="mb-3">
          <label class="form-label" for="">Пароль</label>
          <input
            class="form-control"
            type="password"
            name="password"
            pattern=".{6,}"
            placeholder="Пароль"
            required
          />
        </div>
        <div class="mb-3">
          <label class="form-label" for="">Имя</label>
          <input
            class="form-control"
            type="text"
            pattern="[А-Яа-я\s]+"
            name="fname"
            placeholder="Имя"
            required
          />
        </div>
        <div class="mb-3">
          <label class="form-label" for="">Фамилия</label>
          <input
            class="form-control"
            type="text"
            pattern="[А-Яа-я\s]+"
            name="lname"
            placeholder="Фамилия"
            required
          />
        </div>
        <div class="mb-3">
          <label class="form-label" for="">Телефон</label>
          <input
            class="form-control border-danger"
            type="text"
            name="number"
            placeholder="+7(XXX)-XXX-XX-XX"
            required
          />
        </div>

        <div class="mb-3">
          <button type="submit" class="btn btn-danger w-100">
            Зарегистрироваться
          </button>
        </div>
        <div class="mb-3">
          <p>У вас уже есть аккаунт? <a href="login.php">Войдите</a></p>
        </div>
      </form>
    </main>
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
        <img
          src="img/logo.png"
          alt="Логотип ТочноВкусно"
          style="width: 200px"
        />
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script>
      new WOW().init();
    </script>
  </body>
</html>
