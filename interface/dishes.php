<html> 
<head> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
</head> 
<body> 
<?php 
header("Content-Type: text/html; charset=UTF-8"); 
require_once 'tableShop.php'; 

$title = "Інформація про страви";
echo "<center> Відомість: <b>" . $title . "</b></center><br>"; 

$connect = new mysqli($db_hostname, $db_username, $db_password, $db_database);

if ($connect->connect_error) {
    die("Неможливо підключитися до MySQL: " . $connect->connect_error);
}

$connect->set_charset("utf8");

function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function validateInput($field, $fieldName) {
    if (empty($field)) {
        echo "<p style='color:red;'>Поле \"$fieldName\" обов'язкове для заповнення.</p>";
        return false;
    }
    return true;
}

function validateInteger($field, $fieldName) {
    if (!filter_var($field, FILTER_VALIDATE_INT)) {
        echo "<p style='color:red;'>Поле \"$fieldName\" повинно бути цілим числом.</p>";
        return false;
    }
    return true;
}

$id = "";
$cooked_id = "";
$dish_id_Arr = "";

function getPosts() {
    $posts = array();
    $posts[0] = isset($_POST['id']) ? sanitizeInput($_POST['id']) : "";
    $posts[1] = isset($_POST['cooked_id']) ? sanitizeInput($_POST['cooked_id']) : "";
    $posts[2] = isset($_POST['dish_id_Arr']) ? sanitizeInput($_POST['dish_id_Arr']) : "";
    return $posts;
}

$query = "SELECT cooked_id, dish_id_Arr FROM dishes";
$result = $connect->query($query);
if (!$result) {
    die("Збій при доступі до бази даних: " . $connect->error);
}

echo "<center>";
echo "<table border=\"1\">";
echo "<tr><th>cooked id</th><th>dish id Array</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["cooked_id"] . "</td>";
    echo "<td>" . $row["dish_id_Arr"] . "</td>";
    echo "</tr>";
}
echo "</table>";
echo "</center>";

if (isset($_POST['insert'])) {
    $data = getPosts();

    $valid = validateInput($data[1], "cooked_id") && validateInput($data[2], "dish_id_Arr") &&
             validateInteger($data[1], "cooked_id") && validateInteger($data[2], "dish_id_Arr");

    if ($valid) {
        $insert_Query = "INSERT INTO dishes (cooked_id, dish_id_Arr) VALUES (?, ?)";
        $stmt = $connect->prepare($insert_Query);
        $stmt->bind_param("ii", $data[1], $data[2]);

        if ($stmt->execute()) {
            echo '<p style="color:green;">Дані додано успішно!</p>';
        } else {
            echo '<p style="color:red;">Помилка при додаванні даних: ' . $stmt->error . '</p>';
        }
    }
}

if (isset($_POST['delete'])) {
    $data = getPosts();
    $valid = validateInput($data[0], "id") && validateInteger($data[0], "id");

    if ($valid) {
        $delete_Query = "DELETE FROM dishes WHERE id = ?";
        $stmt = $connect->prepare($delete_Query);
        $stmt->bind_param("i", $data[0]);

        if ($stmt->execute()) {
            echo '<p style="color:green;">Дані видалено успішно!</p>';
        } else {
            echo '<p style="color:red;">Помилка при видаленні даних: ' . $stmt->error . '</p>';
        }
    }
}

if (isset($_POST['update'])) {
    $data = getPosts();
    $valid = validateInput($data[0], "id") && validateInput($data[1], "cooked_id") && validateInput($data[2], "dish_id_Arr") &&
             validateInteger($data[0], "id") && validateInteger($data[1], "cooked_id") && validateInteger($data[2], "dish_id_Arr");

    if ($valid) {
        $update_Query = "UPDATE dishes SET cooked_id = ?, dish_id_Arr = ? WHERE id = ?";
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

<form action="dishes.php" method="post"><br><br>
    <input type="number" name="id" placeholder="id" value="<?php echo $id; ?>"><br><br>
    <input type="number" name="cooked_id" placeholder="cooked_id" value="<?php echo $cooked_id; ?>"><br><br>
    <input type="number" name="dish_id_Arr" placeholder="dish_id_Arr" value="<?php echo $dish_id_Arr; ?>"><br><br>

    <div>
        <input type="submit" name="insert" value="Add">
        <input type="submit" name="update" value="Update">
        <input type="submit" name="delete" value="Delete">
        <input type="submit" name="search" value="Search">
    </div>
</form>

</body> 
</html>