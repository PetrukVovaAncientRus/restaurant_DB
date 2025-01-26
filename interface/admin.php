<html> 
<head> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
</head> 
<body> 
<?php 
header("Content-Type: text/html; charset=UTF-8"); 
require_once 'tableShop.php'; 

$title = "Інформація кількість співробітників"; 
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
$bank_id = "";
$amount_of_chefs = "";
$amount_of_waiters = "";

function getPosts() {
    $posts = array();
    $posts[0] = isset($_POST['id']) ? sanitizeInput($_POST['id']) : "";
    $posts[1] = isset($_POST['bank_id']) ? sanitizeInput($_POST['bank_id']) : "";
    $posts[2] = isset($_POST['amount_of_chefs']) ? sanitizeInput($_POST['amount_of_chefs']) : "";
    $posts[3] = isset($_POST['amount_of_waiters']) ? sanitizeInput($_POST['amount_of_waiters']) : "";
    return $posts;
}

// Виведення таблиці
$query = "SELECT bank_id, amount_of_chefs, amount_of_waiters FROM admin";
$result = $connect->query($query);
if (!$result) {
    die("Збій при доступі до бази даних: " . $connect->error);
}

// Виведення даних
echo "<center>";
echo "<table border=\"1\">";
echo "<tr><th>bank id</th><th>amount of chefs</th><th>amount of waiters</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["bank_id"] . "</td>";
    echo "<td>" . $row["amount_of_chefs"] . "</td>";
    echo "<td>" . $row["amount_of_waiters"] . "</td>";
    echo "</tr>";
}
echo "</table>";
echo "</center>";

// Insert
if (isset($_POST['insert'])) {
    $data = getPosts();

    $valid = validateInput($data[1], "bank_id") && validateInput($data[2], "amount_of_chefs") && validateInput($data[3], "amount_of_waiters") &&
             validateInteger($data[1], "bank_id") && validateInteger($data[2], "amount_of_chefs") && validateInteger($data[3], "amount_of_waiters");

    if ($valid) {
        $insert_Query = "INSERT INTO `admin` (`bank_id`, `amount_of_chefs`, `amount_of_waiters`) VALUES (?, ?, ?)";
        $stmt = $connect->prepare($insert_Query);
        $stmt->bind_param("iii", $data[1], $data[2], $data[3]);

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
        $delete_Query = "DELETE FROM `admin` WHERE `id` = ?";
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
    $valid = validateInput($data[0], "id") && validateInput($data[1], "bank_id") && validateInput($data[2], "amount_of_chefs") &&
             validateInput($data[3], "amount_of_waiters") && validateInteger($data[0], "id") && validateInteger($data[1], "bank_id") &&
             validateInteger($data[2], "amount_of_chefs") && validateInteger($data[3], "amount_of_waiters");

    if ($valid) {
        $update_Query = "UPDATE `admin` SET `bank_id` = ?, `amount_of_chefs` = ?, `amount_of_waiters` = ? WHERE `id` = ?";
        $stmt = $connect->prepare($update_Query);
        $stmt->bind_param("iiii", $data[1], $data[2], $data[3], $data[0]);

        if ($stmt->execute()) {
            echo '<p style="color:green;">Дані оновлено успішно!</p>';
        } else {
            echo '<p style="color:red;">Помилка при оновленні даних: ' . $stmt->error . '</p>';
        }
    }
}
?>

<form action="admin.php" method="post"><br><br>
    <input type="number" name="id" placeholder="id" value="<?php echo $id; ?>"><br><br>
    <input type="number" name="bank_id" placeholder="bank_id" value="<?php echo $bank_id; ?>"><br><br>
    <input type="number" name="amount_of_chefs" placeholder="amount_of_chefs" value="<?php echo $amount_of_chefs; ?>"><br><br>
    <input type="number" name="amount_of_waiters" placeholder="amount_of_waiters" value="<?php echo $amount_of_waiters; ?>"><br><br>

    <div>
        <input type="submit" name="insert" value="Add">
        <input type="submit" name="update" value="Update">
        <input type="submit" name="delete" value="Delete">
        <input type="submit" name="search" value="Search">
    </div>
</form>

</body> 
</html>