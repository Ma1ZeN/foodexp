<?php
session_start();
require_once("controllers/db.php");

// Проверка авторизации пользователя
if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'Необходимо авторизоваться']);
    exit();
}

$user_id = $_SESSION['id'];

// Начинаем транзакцию
$conn->begin_transaction();

try {
    // 1. Получаем все товары из корзины пользователя
    $sql = "SELECT product_id FROM cart WHERE user_id = $user_id";
    $result = $conn->query($sql);
    
    if ($result->num_rows === 0) {
        throw new Exception("Корзина пуста");
    }
    
    // 2. Переносим товары в таблицу заказов
    while ($row = $result->fetch_assoc()) {
        $product_id = $row['product_id'];
        
        $insert_sql = "INSERT INTO orders (product_id, user_id) VALUES (?, ?)";
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("ii", $product_id, $user_id);
        
        if (!$stmt->execute()) {
            throw new Exception("Ошибка при оформлении заказа: " . $conn->error);
        }
    }
    
    // 3. Очищаем корзину пользователя
    $delete_sql = "DELETE FROM cart WHERE user_id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $user_id);
    
    if (!$stmt->execute()) {
        throw new Exception("Ошибка при очистке корзины: " . $conn->error);
    }
    
    // Если все успешно - коммитим транзакцию
    $conn->commit();
    
    echo json_encode([
        'success' => true,
        'message' => 'Заказ успешно оформлен!'
    ]);
    
} catch (Exception $e) {
    // Откатываем транзакцию при ошибке
    $conn->rollback();
    
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>