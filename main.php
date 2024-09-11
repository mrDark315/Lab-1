<?php
// Инициализация переменных для ошибок
$firstNameError = $lastNameError = $emailError = $passwordError = "";
$firstName = $lastName = $email = $password = "";

// Функция для обработки и очистки входных данных
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Проверка, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Проверка имени
    if (empty($_POST["first_name"])) {
        $firstNameError = "First name is required";
    } else {
        $firstName = test_input($_POST["first_name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $firstName)) {
            $firstNameError = "Only letters and spaces allowed";
        }
    }

    // Проверка фамилии
    if (empty($_POST["last_name"])) {
        $lastNameError = "Last name is required";
    } else {
        $lastName = test_input($_POST["last_name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $lastName)) {
            $lastNameError = "Only letters and spaces allowed";
        }
    }

    // Проверка email
    if (empty($_POST["email"])) {
        $emailError = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format";
        }
    }

    // Проверка пароля
    if (empty($_POST["password"])) {
        $passwordError = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
        if (strlen($password) < 6) {
            $passwordError = "Password must be at least 6 characters";
        }
    }

    // Если нет ошибок, выводим успешное сообщение
    if (empty($firstNameError) && empty($lastNameError) && empty($emailError) && empty($passwordError)) {
        echo "<p>Registration successful!</p>";
        echo "<p>First Name: $firstName</p>";
        echo "<p>Last Name: $lastName</p>";
        echo "<p>Email: $email</p>";
    } else {
        // Выводим ошибки
        echo "<p>$firstNameError</p>";
        echo "<p>$lastNameError</p>";
        echo "<p>$emailError</p>";
        echo "<p>$passwordError</p>";
    }
}
?>
