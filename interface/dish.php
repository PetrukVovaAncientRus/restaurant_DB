<html> 
<head> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
</head> 
<body> 
<?php 
header("Content-Type: text/html; charset=UTF-8"); 
require_once 'tableShop.php'; 

$title = "Інформація про страву";
echo "<center> Відомість: <b>" . $title . "</b></center><br>"; 

// Підключення до бази даних за допомогою mysqli
$connect = new mysqli($db_hostname, $db_username, $db_password, $db_database);

// Перевірка підключення
if ($connect->connect_error) {
    die("Неможливо підключитися до MySQL: " . $connect->connect_error);
}

// Встановлення кодування
$connect->set_charset("utf8");

// Функція для очищення введених даних
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Перевірка на заповнення полів
function validateInput($field, $fieldName) {
    if (empty($field)) {
        echo "<p style='color:red;'>Поле \"$fieldName\" обов'язкове для заповнення.</p>";
        return false;
    }
    return true;
}

// Перевірка на коректність числових значень
function validateInteger($field, $fieldName) {
    if (!filter_var($field, FILTER_VALIDATE_INT)) {
        echo "<p style='color:red;'>Поле \"$fieldName\" повинно бути цілим числом.</p>";
        return false;
    }
    return true;
}

$id = "";
$from_what_food = "";
$name = "";
$price = "";

function getPosts() {
    $posts = array();
    $posts[0] = isset($_POST['id']) ? sanitizeInput($_POST['id']) : "";
    $posts[1] = isset($_POST['from_what_food']) ? sanitizeInput($_POST['from_what_food']) : "";
    $posts[2] = isset($_POST['name']) ? sanitizeInput($_POST['name']) : "";
    $posts[3] = isset($_POST['price']) ? sanitizeInput($_POST['price']) : "";
    return $posts;
}

// Виведення таблиці
$query = "SELECT from_what_food, name, price FROM dish";
$result = $connect->query($query);
if (!$result) {
    die("Збій при доступі до бази даних: " . $connect->error);
}

// Виведення даних
echo "<center>";
echo "<table border=\"1\">";
echo "<tr><th>from what food</th><th>name</th><th>price</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["from_what_food"] . "</td>";
    echo "<td>" . $row["name"] . "</td>";
    echo "<td>" . $row["price"] . "</td>";
    echo "</tr>";
}
echo "</table>";
echo "</center>";

// Insert
if (isset($_POST['insert'])) {
    $data = getPosts();

    $valid = validateInput($data[1], "from_what_food") && validateInput($data[2], "name") && validateInput($data[3], "price") &&
             validateInteger($data[3], "price");

    if ($valid) {
        $insert_Query = "INSERT INTO dish (from_what_food, name, price) VALUES (?, ?, ?)";
        $stmt = $connect->prepare($insert_Query);
        $stmt->bind_param("ssi", $data[1], $data[2], $data[3]);

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
        $delete_Query = "DELETE FROM dish WHERE id = ?";
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
    $valid = validateInput($data[0], "id") && validateInput($data[1], "from_what_food") &&
             validateInput($data[2], "name") && validateInput($data[3], "price") &&
             validateInteger($data[0], "id") && validateInteger($data[3], "price");

    if ($valid) {
        $update_Query = "UPDATE dish SET from_what_food = ?, name = ?, price = ? WHERE id = ?";
        $stmt = $connect->prepare($update_Query);
        $stmt->bind_param("ssii", $data[1], $data[2], $data[3], $data[0]);

        if ($stmt->execute()) {
            echo '<p style="color:green;">Дані оновлено успішно!</p>';
        } else {
            echo '<p style="color:red;">Помилка при оновленні даних: ' . $stmt->error . '</p>';
        }
    }
}
?>

<form action="dish.php" method="post"><br><br>
    <input type="number" name="id" placeholder="id" value="<?php echo $id; ?>"><br><br>
    <input type="text" name="from_what_food" placeholder="from_what_food" value="<?php echo $from_what_food; ?>"><br><br>
    <input type="text" name="name" placeholder="name" value="<?php echo $name; ?>"><br><br>
    <input type="number" name="price" placeholder="price" value="<?php echo $price; ?>"><br><br>

    <div>
        <input type="submit" name="insert" value="Add">
        <input type="submit" name="update" value="Update">
        <input type="submit" name="delete" value="Delete">
        <input type="submit" name="search" value="Search">
    </div>
</form>

</body> 
</html>