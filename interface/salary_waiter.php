<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php
header("Content-Type: text/html; charset=UTF-8");
require_once 'tableShop.php';

$title = "Інформація про зарплатню офіціантів";
echo "<center> Відомість: <b>" . $title . "</b></center><br>";

// Підключення до бази даних
$connect = new mysqli($db_hostname, $db_username, $db_password, $db_database);
if ($connect->connect_error) {
    die("Неможливо підключитися до MySQL: " . $connect->connect_error);
}
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
$admin_id = "";
$waiter_id = "";
$amount = "";

function getPosts() {
    $posts = array();
    $posts[0] = isset($_POST['id']) ? sanitizeInput($_POST['id']) : "";
    $posts[1] = isset($_POST['admin_id']) ? sanitizeInput($_POST['admin_id']) : "";
    $posts[2] = isset($_POST['waiter_id']) ? sanitizeInput($_POST['waiter_id']) : "";
    $posts[3] = isset($_POST['amount']) ? sanitizeInput($_POST['amount']) : "";
    return $posts;
}

// Виведення таблиці
$query = "SELECT admin_id, waiter_id, amount FROM salary_waiter";
$result = $connect->query($query);
if (!$result) {
    die("Збій при доступі до бази даних: " . $connect->error);
}

echo "<center>";
echo "<table border=\"1\">";
echo "<tr><th>admin id</th><th>waiter id</th><th>amount</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["admin_id"] . "</td>";
    echo "<td>" . $row["waiter_id"] . "</td>";
    echo "<td>" . $row["amount"] . "</td>";
    echo "</tr>";
}
echo "</table>";
echo "</center>";

// Insert
if (isset($_POST['insert'])) {
    $data = getPosts();

    $valid = validateInput($data[1], "admin_id") && validateInput($data[2], "waiter_id") && validateInput($data[3], "amount") &&
             validateInteger($data[1], "admin_id") && validateInteger($data[2], "waiter_id") && validateInteger($data[3], "amount");

    if ($valid) {
        $insert_Query = "INSERT INTO salary_waiter (admin_id, waiter_id, amount) VALUES (?, ?, ?)";
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
        $delete_Query = "DELETE FROM salary_waiter WHERE id = ?";
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
    $valid = validateInput($data[0], "id") && validateInput($data[1], "admin_id") && validateInput($data[2], "waiter_id") &&
             validateInput($data[3], "amount") && validateInteger($data[0], "id") && validateInteger($data[1], "admin_id") &&
             validateInteger($data[2], "waiter_id") && validateInteger($data[3], "amount");

    if ($valid) {
        $update_Query = "UPDATE salary_waiter SET admin_id = ?, waiter_id = ?, amount = ? WHERE id = ?";
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

<form action="salary_waiter.php" method="post"><br><br>
    <input type="number" name="id" placeholder="id" value="<?php echo $id; ?>"><br><br>
    <input type="number" name="admin_id" placeholder="admin_id" value="<?php echo $admin_id; ?>"><br><br>
    <input type="number" name="waiter_id" placeholder="waiter_id" value="<?php echo $waiter_id; ?>"><br><br>
    <input type="number" name="amount" placeholder="amount" value="<?php echo $amount; ?>"><br><br>

    <div>
        <input type="submit" name="insert" value="Add">
        <input type="submit" name="update" value="Update">
        <input type="submit" name="delete" value="Delete">
        <input type="submit" name="search" value="Search">
    </div>
</form>

</body>
</html>