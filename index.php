<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab_1</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>

<?php
// Инициализация переменных для ошибок
$first_name_error = $last_name_error = $email_error = $password_error = "";
$first_name = $last_name = $email = $password = "";

// Если форма отправлена
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем значения полей
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $is_valid = true;

    // Проверка имени
    if (!preg_match("/^[a-zA-Z]+$/", $first_name)) {
        $first_name_error = "First name should only contain letters";
        $is_valid = false;
    }

    // Проверка фамилии
    if (!preg_match("/^[a-zA-Z]+$/", $last_name)) {
        $last_name_error = "Last name should only contain letters";
        $is_valid = false;
    }

    // Проверка email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Invalid email format";
        $is_valid = false;
    }

    // Проверка пароля
    if (strlen($password) < 6) {
        $password_error = "Password should be at least 6 characters";
        $is_valid = false;
    }
}
?>

<div class="container">
    <h2>Sign up</h2>
    <div class="form-grid">
        <form action="" method="POST">
            <div class="input_field">
                <input type="text" name="first_name" placeholder="First Name" value="<?php echo htmlspecialchars($first_name); ?>">
                <div class="error"><?php echo $first_name_error; ?></div>
            </div>
            <div class="input_field">
                <input type="text" name="last_name" placeholder="Last Name" value="<?php echo htmlspecialchars($last_name); ?>">
                <div class="error"><?php echo $last_name_error; ?></div>
            </div>
            <div class="input_field">
                <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>">
                <div class="error"><?php echo $email_error; ?></div>
            </div>
            <div class="input_field">
                <input type="password" name="password" placeholder="Password" value="<?php echo htmlspecialchars($password); ?>">
                <div class="error"><?php echo $password_error; ?></div>
            </div>
            <button type="submit" class="continue-button">Continue</button>
        </form>
    </div>
</div>

</body>
</html>
