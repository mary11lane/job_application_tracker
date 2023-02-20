<?php

error_reporting(0);

session_start();

if (!$_SESSION['valid']) {
    echo header("Location: login.php");
}

include_once("connection.php");

$connection = connection();

if (isset($_POST['delete'])) {
    $id = $_POST['ID'];
    $sql = "DELETE FROM jobs_list WHERE id = '$id'";
    $job = $connection->query($sql);
    $job->execute();
}

$sql = "SELECT * FROM jobs_list ORDER BY company";
$jobs = $connection->query($sql);
$jobs->execute();
$row = $jobs->fetch(PDO::FETCH_ASSOC);

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
    <h1>Job Application Tracker</h1>
    <a href="logout.php" class="logout">Logout</a>
    <a href="add.php" class="add">+ Add New</a>
    <?php if (!$row) {
        echo "<p class='nodata'>no data available</p>";
    } ?>

    <table class="<?php echo (!$row) ? 'hidden' : ''; ?>">
        <thead>
            <tr>
                <th>Company</th>
                <th>Position</th>
                <th>Salary</th>
                <th>Status</th>
                <th colspan="2">Actions</td>
            </tr>
        </thead>

        <tbody>
            <?php do { ?>
                <tr>
                    <td><?php echo $row['company']; ?></td>
                    <td><?php echo $row['position']; ?></td>
                    <td><?php echo $row['salary']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><button><a href="edit.php?ID=<?php echo $row['id']; ?> ">Edit</a></button></td>
                    <td>
                        <form method="post" onSubmit="if(!confirm('Are you sure you want to delete?')){return false;}">
                            <button type="submit" name="delete" class="delete">Delete</a>
                                <input type="text" name="ID" value="<?php echo $row['id']; ?>" hidden>
                        </form>
                    </td>
                </tr>
            <?php } while ($row = $jobs->fetch(PDO::FETCH_ASSOC)) ?>


        </tbody>
    </table>

</body>

</html>