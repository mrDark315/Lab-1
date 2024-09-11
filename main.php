<?php
header('Content-Type: application/json');

// Инициализация переменных для ошибок и значений
$firstNameError = $lastNameError = $emailError = $passwordError = "";
$errors = [];
$successMessage = "";

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
        $errors['first_name'] = "First name is required";
    } else {
        $firstName = test_input($_POST["first_name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $firstName)) {
            $errors['first_name'] = "Only letters and spaces allowed";
        }
    }

    // Проверка фамилии
    if (empty($_POST["last_name"])) {
        $errors['last_name'] = "Last name is required";
    } else {
        $lastName = test_input($_POST["last_name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $lastName)) {
            $errors['last_name'] = "Only letters and spaces allowed";
        }
    }

    // Проверка email
    if (empty($_POST["email"])) {
        $errors['email'] = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email format";
        }
    }

    // Проверка пароля
    if (empty($_POST["password"])) {
        $errors['password'] = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
        if (strlen($password) < 6) {
            $errors['password'] = "Password must be at least 6 characters";
        }
    }

    // Если есть ошибки, отправляем их обратно
    if (!empty($errors)) {
        echo json_encode(['errors' => $errors]);
    } else {
        // Если регистрация успешна
        $successMessage = "Registration successful!";
        echo json_encode(['success' => $successMessage]);
    }
}
?>
