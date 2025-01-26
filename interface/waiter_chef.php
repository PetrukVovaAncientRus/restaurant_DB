<html> 
<head> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
</head> 
<body> 
<?php 
header("Content-Type: text/html; charset=UTF-8"); 
require_once 'tableShop.php'; 

$title = "Інформація про офіціантів і кухарів"; 
echo "<center> Відомість: <b>" . $title . "</b></center><br>"; 

// Підключення до бази даних
$connect = new mysqli($db_hostname, $db_username, $db_password, $db_database);

// Перевірка підключення
if ($connect->connect_error) {
    die("Неможливо підключитися до MySQL: " . $connect->connect_error);
}

// Встановлення кодування
$connect->set_charset("utf8");

// Функція для очищення даних
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Перевірка заповнення полів
function validateInput($field, $fieldName) {
    if (empty($field)) {
        echo "<p style='color:red;'>Поле \"$fieldName\" обов'язкове для заповнення.</p>";
        return false;
    }
    return true;
}

// Перевірка числових значень
function validateInteger($field, $fieldName) {
    if (!filter_var($field, FILTER_VALIDATE_INT)) {
        echo "<p style='color:red;'>Поле \"$fieldName\" повинно бути цілим числом.</p>";
        return false;
    }
    return true;
}

$id = "";
$waiter_id = "";
$chef_id = "";

// Отримання значень з POST-запиту
function getPosts() {
    $posts = array();
    $posts[0] = isset($_POST['id']) ? sanitizeInput($_POST['id']) : "";
    $posts[1] = isset($_POST['waiter_id']) ? sanitizeInput($_POST['waiter_id']) : "";
    $posts[2] = isset($_POST['chef_id']) ? sanitizeInput($_POST['chef_id']) : "";
    return $posts;
}

// Виведення таблиці
$query = "SELECT waiter_id, chef_id FROM waiter_chef";
$result = $connect->query($query);
if (!$result) {
    die("Збій при доступі до бази даних: " . $connect->error);
}

echo "<center>";
echo "<table border=\"1\">";
echo "<tr><th>waiter id</th><th>chef id</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["waiter_id"] . "</td>";
    echo "<td>" . $row["chef_id"] . "</td>";
    echo "</tr>";
}
echo "</table>";
echo "</center>";

// Insert
if (isset($_POST['insert'])) {
    $data = getPosts();
    $valid = validateInput($data[1], "waiter_id") && validateInput($data[2], "chef_id") &&
             validateInteger($data[1], "waiter_id") && validateInteger($data[2], "chef_id");

    if ($valid) {
        $insert_Query = "INSERT INTO waiter_chef (waiter_id, chef_id) VALUES (?, ?)";
        $stmt = $connect->prepare($insert_Query);
        $stmt->bind_param("ii", $data[1], $data[2]);

        if ($stmt->execute()) {
            echo '<p style="color:green;">Дані додано успішно!</p>';
        } else {
            echo '<p style="color:red;">Помилка при додаванні даних: ' . $stmt->error . '</p>';
        }
    }
}

// Delete
if (isset($_POST['delete'])) {
    $data = getPosts();
    $valid = validateInput($data[0], "id") && validateInteger($data[0], "id");

    if ($valid) {
        $delete_Query = "DELETE FROM waiter_chef WHERE id = ?";
        $stmt = $connect->prepare($delete_Query);
        $stmt->bind_param("i", $data[0]);

        if ($stmt->execute()) {
            echo '<p style="color:green;">Дані видалено успішно!</p>';
        } else {
            echo '<p style="color:red;">Помилка при видаленні даних: ' . $stmt->error . '</p>';
        }
    }
}

// Update
if (isset($_POST['update'])) {
    $data = getPosts();
    $valid = validateInput($data[0], "id") && validateInput($data[1], "waiter_id") && validateInput($data[2], "chef_id") &&
             validateInteger($data[0], "id") && validateInteger($data[1], "waiter_id") && validateInteger($data[2], "chef_id");

    if ($valid) {
        $update_Query = "UPDATE waiter_chef SET waiter_id = ?, chef_id = ? WHERE id = ?";
        $stmt = $connect->prepare($update_Query);
        $stmt->bind_param("iii", $data[1], $data[2], $data[0]);

        if ($stmt->execute()) {
            echo '<p style="color:green;">Дані оновлено успішно!</p>';
        } else {
            echo '<p style="color:red;">Помилка при оновленні даних: ' . $stmt->error . '</p>';
        }
    }
}
?>

<form action="waiter_chef.php" method="post"><br><br>
    <input type="number" name="id" placeholder="id" value="<?php echo $id; ?>"><br><br>
    <input type="number" name="waiter_id" placeholder="waiter_id" value="<?php echo $waiter_id; ?>"><br><br>
    <input type="number" name="chef_id" placeholder="chef_id" value="<?php echo $chef_id; ?>"><br><br>

    <div>
        <input type="submit" name="insert" value="Add">
        <input type="submit" name="update" value="Update">
        <input type="submit" name="delete" value="Delete">
    </div>
</form>

</body> 
</html>