<?php
session_start();
require_once("controllers/db.php");

// Проверка прав администратора
if (isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель | ТочноВкусно</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .sidebar .nav-link {
            color: #333;
        }
        .sidebar .nav-link.active {
            color: #d10f18;
            font-weight: bold;
        }
        .content {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Сайдбар -->
            <div class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <h4 class="text-center mb-4">Админ-панель</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#" id="dashboard-tab">
                                Панель управления
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="restaurants-tab">
                                Рестораны
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="menu-tab">
                                Меню
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="users-tab">
                                Пользователи
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
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2" id="page-title">Панель управления</h1>
                </div>

                <!-- Контентные секции -->
                <div id="dashboard-content">
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Рестораны</h5>
                                    <?php
                                    $sql = "SELECT COUNT(*) as count FROM restourants";
                                    $result = $conn->query($sql);
                                    $count = $result->fetch_assoc()['count'];
                                    ?>
                                    <p class="display-4"><?php echo $count; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Позиции меню</h5>
                                    <?php
                                    $sql = "SELECT COUNT(*) as count FROM Menu";
                                    $result = $conn->query($sql);
                                    $count = $result->fetch_assoc()['count'];
                                    ?>
                                    <p class="display-4"><?php echo $count; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Пользователи</h5>
                                    <?php
                                    $sql = "SELECT COUNT(*) as count FROM Users";
                                    $result = $conn->query($sql);
                                    $count = $result->fetch_assoc()['count'];
                                    ?>
                                    <p class="display-4"><?php echo $count; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Секция управления ресторанами -->
                <div id="restaurants-content" style="display: none;">
                    <div class="d-flex justify-content-between mb-3">
                        <h3>Управление ресторанами</h3>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addRestaurantModal">
                            Добавить ресторан
                        </button>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Название</th>
                                    <th>Рейтинг</th>
                                    <th>Адрес</th>
                                    <th>Часы работы</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM restourants";
                                $result = $conn->query($sql);
                                
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                            <td>{$row['id']}</td>
                                            <td>{$row['name']}</td>
                                            <td>{$row['rating']}</td>
                                            <td>{$row['adress']}</td>
                                            <td>{$row['workTime']}</td>
                                            <td>
                                                <button class='btn btn-sm btn-primary edit-restaurant' data-id='{$row['id']}'>Редактировать</button>
                                                <button class='btn btn-sm btn-danger delete-restaurant' data-id='{$row['id']}'>Удалить</button>
                                            </td>
                                        </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6' class='text-center'>Нет данных о ресторанах</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Секция управления меню -->
                <div id="menu-content" style="display: none;">
                    <div class="d-flex justify-content-between mb-3">
                        <h3>Управление меню</h3>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addMenuItemModal">
                            Добавить позицию
                        </button>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Название</th>
                                    <th>Описание</th>
                                    <th>Цена</th>
                                    <th>Ресторан</th>
                                    <th>Категория</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT m.*, r.name as rest_name FROM Menu m LEFT JOIN restourants r ON m.Restoran = r.id";
                                $result = $conn->query($sql);
                                
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                            <td>{$row['id']}</td>
                                            <td>{$row['Name']}</td>
                                            <td>{$row['Opisanie']}</td>
                                            <td>{$row['Price']} ₽</td>
                                            <td>{$row['rest_name']}</td>
                                            <td>{$row['Category']}</td>
                                            <td>
                                                <button class='btn btn-sm btn-primary edit-menu-item' data-id='{$row['id']}'>Редактировать</button>
                                                <button class='btn btn-sm btn-danger delete-menu-item' data-id='{$row['id']}'>Удалить</button>
                                            </td>
                                        </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='7' class='text-center'>Нет данных о меню</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Секция управления пользователями -->
                <div id="users-content" style="display: none;">
                    <div class="d-flex justify-content-between mb-3">
                        <h3>Управление пользователями</h3>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addUserModal">
                            Добавить пользователя
                        </button>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Имя</th>
                                    <th>Фамилия</th>
                                    <th>Логин</th>
                                    <th>Телефон</th>
                                    <th>Роль</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM Users";
                                $result = $conn->query($sql);
                                
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                            <td>{$row['id']}</td>
                                            <td>{$row['fname']}</td>
                                            <td>{$row['lname']}</td>
                                            <td>{$row['login']}</td>
                                            <td>{$row['phonenumber']}</td>
                                            <td>{$row['role']}</td>
                                            <td>
                                                <button class='btn btn-sm btn-primary edit-user' data-id='{$row['id']}'>Редактировать</button>
                                                <button class='btn btn-sm btn-danger delete-user' data-id='{$row['id']}'>Удалить</button>
                                            </td>
                                        </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='7' class='text-center'>Нет данных о пользователях</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Модальное окно добавления ресторана -->
    <div class="modal fade" id="addRestaurantModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Добавить ресторан</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addRestaurantForm">
                        <div class="mb-3">
                            <label for="restaurantName" class="form-label">Название</label>
                            <input type="text" class="form-control" id="restaurantName" required>
                        </div>
                        <div class="mb-3">
                            <label for="restaurantRating" class="form-label">Рейтинг</label>
                            <input type="number" step="0.1" class="form-control" id="restaurantRating" required>
                        </div>
                        <div class="mb-3">
                            <label for="restaurantImage" class="form-label">URL изображения</label>
                            <input type="text" class="form-control" id="restaurantImage" required>
                        </div>
                        <div class="mb-3">
                            <label for="restaurantWorkTime" class="form-label">Часы работы</label>
                            <input type="text" class="form-control" id="restaurantWorkTime" required>
                        </div>
                        <div class="mb-3">
                            <label for="restaurantAddress" class="form-label">Адрес</label>
                            <input type="text" class="form-control" id="restaurantAddress" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-danger" id="saveRestaurantBtn">Сохранить</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Модальное окно добавления позиции меню -->
    <div class="modal fade" id="addMenuItemModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Добавить позицию меню</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addMenuItemForm">
                        <div class="mb-3">
                            <label for="menuItemName" class="form-label">Название</label>
                            <input type="text" class="form-control" id="menuItemName" required>
                        </div>
                        <div class="mb-3">
                            <label for="menuItemDescription" class="form-label">Описание</label>
                            <input type="text" class="form-control" id="menuItemDescription" required>
                        </div>
                        <div class="mb-3">
                            <label for="menuItemPrice" class="form-label">Цена</label>
                            <input type="number" class="form-control" id="menuItemPrice" required>
                        </div>
                        <div class="mb-3">
                            <label for="menuItemImage" class="form-label">URL изображения</label>
                            <input type="text" class="form-control" id="menuItemImage" required>
                        </div>
                        <div class="mb-3">
                            <label for="menuItemRestaurant" class="form-label">Ресторан</label>
                            <select class="form-select" id="menuItemRestaurant" required>
                                <?php
                                $sql = "SELECT * FROM restourants";
                                $result = $conn->query($sql);
                                
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="menuItemCategory" class="form-label">Категория</label>
                            <input type="text" class="form-control" id="menuItemCategory" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-danger" id="saveMenuItemBtn">Сохранить</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Модальное окно добавления пользователя -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Добавить пользователя</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addUserForm">
                        <div class="mb-3">
                            <label for="userFname" class="form-label">Имя</label>
                            <input type="text" class="form-control" id="userFname" required>
                        </div>
                        <div class="mb-3">
                            <label for="userLname" class="form-label">Фамилия</label>
                            <input type="text" class="form-control" id="userLname" required>
                        </div>
                        <div class="mb-3">
                            <label for="userLogin" class="form-label">Логин</label>
                            <input type="text" class="form-control" id="userLogin" required>
                        </div>
                        <div class="mb-3">
                            <label for="userPassword" class="form-label">Пароль</label>
                            <input type="password" class="form-control" id="userPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="userPhone" class="form-label">Телефон</label>
                            <input type="text" class="form-control" id="userPhone" required>
                        </div>
                        <div class="mb-3">
                            <label for="userRole" class="form-label">Роль</label>
                            <select class="form-select" id="userRole" required>
                                <option value="user">Пользователь</option>
                                <option value="admin">Администратор</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-danger" id="saveUserBtn">Сохранить</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
  $(document).ready(function () {
    // Переключение вкладок
    $(".nav-link").click(function (e) {
      e.preventDefault();
      $(".nav-link").removeClass("active");
      $(this).addClass("active");

      const tabId = $(this).attr("id").replace("-tab", "");
      $(".content > div").hide();
      $("#" + tabId + "-content").show();

      const titles = {
        dashboard: "Панель управления",
        restaurants: "Управление ресторанами",
        menu: "Управление меню",
        users: "Управление пользователями",
      };

      $("#page-title").text(titles[tabId]);
    });

    // Универсальная функция сохранения (добавление / редактирование)
    function saveEntity(btnSelector, getData, actionMap) {
      $(btnSelector).off("click").on("click", function () {
        const $btn = $(this);
        const actionKey = $btn.data("action") === "edit" ? actionMap.edit : actionMap.add;
        const data = getData();
        data.action = actionKey;
        if (actionKey.includes("edit")) data.id = $btn.data("id");

        $.post("admin_actions.php", data, function (response) {
          if (response.success) {
            location.reload();
          } else {
            alert("Ошибка: " + response.message);
          }
        }, "json");
      });
    }

    // Настройка кнопок сохранения
    saveEntity("#saveRestaurantBtn", () => ({
      name: $("#restaurantName").val(),
      rating: $("#restaurantRating").val(),
      image: $("#restaurantImage").val(),
      workTime: $("#restaurantWorkTime").val(),
      address: $("#restaurantAddress").val(),
    }), { add: "add_restaurant", edit: "edit_restaurant" });

    saveEntity("#saveMenuItemBtn", () => ({
      name: $("#menuItemName").val(),
      description: $("#menuItemDescription").val(),
      price: $("#menuItemPrice").val(),
      image: $("#menuItemImage").val(),
      restaurant: $("#menuItemRestaurant").val(),
      category: $("#menuItemCategory").val(),
    }), { add: "add_menu_item", edit: "edit_menu_item" });

    saveEntity("#saveUserBtn", () => ({
      fname: $("#userFname").val(),
      lname: $("#userLname").val(),
      login: $("#userLogin").val(),
      password: $("#userPassword").val(),
      phone: $("#userPhone").val(),
      role: $("#userRole").val(),
    }), { add: "add_user", edit: "edit_user" });

    // Удаление сущностей
    function setupDelete(buttonClass, actionName) {
      $(document).on("click", buttonClass, function () {
        if (confirm("Вы уверены, что хотите удалить?")) {
          const id = $(this).data("id");
          $.post("admin_actions.php", { action: actionName, id }, function (response) {
            if (response.success) {
              location.reload();
            } else {
              alert("Ошибка: " + response.message);
            }
          }, "json");
        }
      });
    }

    setupDelete(".delete-restaurant", "delete_restaurant");
    setupDelete(".delete-menu-item", "delete_menu_item");
    setupDelete(".delete-user", "delete_user");

    // Редактирование
    function setupEdit(buttonClass, actionName, modalId, fillFormFn, saveBtnId, modalTitle) {
      $(document).on("click", buttonClass, function () {
        const id = $(this).data("id");
        $.post("admin_actions.php", { action: actionName, id }, function (response) {
          if (response.success) {
            fillFormFn(response.data);
            $(modalId + " .modal-title").text(modalTitle);
            $(saveBtnId)
              .text("Обновить")
              .data("action", "edit")
              .data("id", id);
            $(modalId).modal("show");
          } else {
            alert("Ошибка: " + response.message);
          }
        }, "json");
      });
    }
    setupEdit(".edit-restaurant", "get_restaurant", "#addRestaurantModal", (data) => {
      $("#restaurantName").val(data.name);
      $("#restaurantRating").val(data.rating);
      $("#restaurantImage").val(data.img);
      $("#restaurantWorkTime").val(data.workTime);
      $("#restaurantAddress").val(data.adress);
    }, "#saveRestaurantBtn", "Редактировать ресторан");

    setupEdit(".edit-menu-item", "get_menu_item", "#addMenuItemModal", (data) => {
      $("#menuItemName").val(data.Name);
      $("#menuItemDescription").val(data.Opisanie);
      $("#menuItemPrice").val(data.Price);
      $("#menuItemImage").val(data.img);
      $("#menuItemRestaurant").val(data.Restoran);
      $("#menuItemCategory").val(data.Category);
    }, "#saveMenuItemBtn", "Редактировать позицию меню");

    setupEdit(".edit-user", "get_user", "#addUserModal", (data) => {
      $("#userFname").val(data.fname);
      $("#userLname").val(data.lname);
      $("#userLogin").val(data.login);
      $("#userPassword").val(data.password);
      $("#userPhone").val(data.phonenumber);
      $("#userRole").val(data.role);
    }, "#saveUserBtn", "Редактировать пользователя");

    // Сброс форм при закрытии модального окна
    $("#addRestaurantModal, #addMenuItemModal, #addUserModal").on("hidden.bs.modal", function () {
      $(this).find("form")[0].reset();
      $(this).find(".modal-title").each(function () {
        $(this).text($(this).text().replace("Редактировать", "Добавить"));
      });
      $(this).find(".btn-danger")
        .text("Сохранить")
        .removeData("action")
        .removeData("id");
    });
  });
    </script>
</body>
</html>