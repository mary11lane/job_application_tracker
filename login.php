<?php

error_reporting(0);

if (!isset($_SESSION)) {
    session_start();
}

include_once("connection.php");
$connection = connection();

if (isset($_POST['login'])) {
    $email_address = $_POST['email_address'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE email_address = ? AND password = ?";
    $user = $connection->prepare($sql);
    $user->execute([$email_address, $password]);
    $result = $user->rowCount();
    $user = null;

    if ($result > 0) {
        $_SESSION['valid'] = true;
        echo header("Location: index.php");
    } else {
        $warning = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css" type="text/css">
    <title>Job Application Tracker</title>
</head>

<body>
    <section class="form-user">
        <h2>Login</h2>

        <form method="post">
            <label>email address:</label>
            <input type="email" name="email_address" id="email_address" value="<?php echo $email_address ?>">
            <label>password</label>
            <input type="password" name="password" id="password" value="<?php echo $password ?>">
            <button type=" submit" name="login">Login</button>
        </form>
        <div class="<?php echo ($warning) ? '' : 'hidden' ?>">Email / Password is incorrect</div>
        <div>Don't have an account yet? <a href="register.php" class="button-link"> Register</a></div>
    </section>
</body>

</html>