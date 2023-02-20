<?php

error_reporting(0);

include_once("connection.php");

$connection = connection();

if (isset($_POST['submit'])) {
    $email_address = $_POST['email_address'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE email_address = ?";
    $user = $connection->prepare($query);
    $user->execute([$email_address]);
    $result = $user->rowCount();

    if ($result > 0) {
        $warning = true;
        $user = null;
    } else {
        $sql = "INSERT INTO users(email_address, password) VALUES (?, ?)";
        $new_user = $connection->prepare($sql);
        $new_user->execute([$email_address, $password]);
        $new_user = null;
        echo header("Location: login.php");
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
        <h2>Register</h1>

            <form method="post">
                <label>Email:</label>
                <input type="email" name="email_address" value="<?php echo $email_address ?>">
                <label>Password</label>
                <input type="password" name="password" value="<?php echo $password ?>">
                <button type="submit" name="submit" value="Register">Register</button>
            </form>
            <div class="<?php echo ($warning) ? '' : 'hidden' ?>">Email is already registered</div>
            <div>Already have an account?<a href="login.php" class="button-link"> Login</a></div>
    </section>
</body>

</html>