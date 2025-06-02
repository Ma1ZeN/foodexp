<?php
require_once("controllers/db.php");
session_start();

// Проверка прав администратора
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Доступ запрещен']);
    exit();
}

$action = $_POST['action'] ?? '';

switch ($action) {
    case 'add_restaurant':
        $name = $_POST['name'];
        $rating = $_POST['rating'];
        $image = $_POST['image'];
        $workTime = $_POST['workTime'];
        $address = $_POST['address'];
        
        $sql = "INSERT INTO restourants (name, rating, img, workTime, adress) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdsss", $name, $rating, $image, $workTime, $address);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => $conn->error]);
        }
        break;
        
    case 'edit_restaurant':
        $id = $_POST['id'];
        $name = $_POST['name'];
        $rating = $_POST['rating'];
        $image = $_POST['image'];
        $workTime = $_POST['workTime'];
        $address = $_POST['address'];
        
        $sql = "UPDATE restourants SET name = ?, rating = ?, img = ?, workTime = ?, adress = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdsssi", $name, $rating, $image, $workTime, $address, $id);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => $conn->error]);
        }
        break;
        
    case 'add_menu_item':
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $image = $_POST['image'];
        $restaurant = $_POST['restaurant'];
        $category = $_POST['category'];
        
        $sql = "INSERT INTO Menu (Name, Opisanie, Price, img, Restoran, Category) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssisis", $name, $description, $price, $image, $restaurant, $category);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => $conn->error]);
        }
        break;
        
    case 'edit_menu_item':
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $image = $_POST['image'];
        $restaurant = $_POST['restaurant'];
        $category = $_POST['category'];
        
        $sql = "UPDATE Menu SET Name = ?, Opisanie = ?, Price = ?, img = ?, Restoran = ?, Category = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssisisi", $name, $description, $price, $image, $restaurant, $category, $id);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => $conn->error]);
        }
        break;
        
    case 'add_user':
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $login = $_POST['login'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $role = $_POST['role'];
        
        $sql = "INSERT INTO Users (fname, lname, login, password, phonenumber, role) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $fname, $lname, $login, $password, $phone, $role);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => $conn->error]);
        }
        break;
        
    case 'edit_user':
        $id = $_POST['id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $login = $_POST['login'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $role = $_POST['role'];
        
        $sql = "UPDATE Users SET fname = ?, lname = ?, login = ?, password = ?, phonenumber = ?, role = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $fname, $lname, $login, $password, $phone, $role, $id);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => $conn->error]);
        }
        break;
        
    case 'delete_restaurant':
        $id = $_POST['id'];
        
        $sql = "DELETE FROM restourants WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => $conn->error]);
        }
        break;
        
    case 'delete_menu_item':
        $id = $_POST['id'];
        
        $sql = "DELETE FROM Menu WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => $conn->error]);
        }
        break;
        
    case 'delete_user':
        $id = $_POST['id'];
        
        $sql = "DELETE FROM Users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => $conn->error]);
        }
        break;
        
    case 'get_restaurant':
        $id = $_POST['id'];
        
        $sql = "SELECT * FROM restourants WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            echo json_encode(['success' => true, 'data' => $result->fetch_assoc()]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Ресторан не найден']);
        }
        break;
        
    case 'get_menu_item':
        $id = $_POST['id'];
        
        $sql = "SELECT * FROM Menu WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            echo json_encode(['success' => true, 'data' => $result->fetch_assoc()]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Позиция меню не найдена']);
        }
        break;
        
    case 'get_user':
        $id = $_POST['id'];
        
        $sql = "SELECT * FROM Users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            echo json_encode(['success' => true, 'data' => $result->fetch_assoc()]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Пользователь не найден']);
        }
        break;
        
    default:
        echo json_encode(['success' => false, 'message' => 'Неизвестное действие']);
}
?>