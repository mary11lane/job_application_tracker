<?php

error_reporting(0);

include_once("connection.php");

$connection = connection();

$id = $_GET['ID'];
$sql = "SELECT * FROM jobs_list WHERE id = '$id'";
$job = $connection->query($sql);
$row = $job->fetch(PDO::FETCH_ASSOC);
$job = null;

if (isset($_POST['submit'])) {
    $company = $_POST['company'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];
    $status = $_POST['status'];
    $sql = "UPDATE jobs_list SET company = ?, position = ?, salary = ?, status = ? WHERE id = ?";
    $job = $connection->prepare($sql);
    $job->execute([$company, $position, $salary, $status, $id]);
    $job = null;

    echo header("Location: index.php");
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

    <section class="form-employee-info">

        <h2>Edit Job Details</h2>

        <form method="post">

            <label>Company</label>
            <input type="text" name="company" value="<?php echo $row['company']; ?>">

            <label>Position</label>
            <input type="text" name="position" value="<?php echo $row['position']; ?>">

            <label>Salary</label>
            <input type="text" name="salary" value="<?php echo $row['salary']; ?>">

            <label>Status</label>
            <select name="status" value="<?php echo $row['status']; ?>">
                <option <?php echo ($row['status'] === "Applied") ? 'selected' : ''; ?>>Applied</option>
                <option <?php echo ($row['status'] === "HR Interview") ? 'selected' : ''; ?>>HR Interview</option>
                <option <?php echo ($row['status'] === "Tech Interview") ? 'selected' : ''; ?>>Tech Interview</option>
                <option <?php echo ($row['status'] === "Job Offer") ? 'selected' : ''; ?>>Job Offer</option>
            </select>

            <button type="submit" name="submit" value="Submit">Update</button>
            <button><a href="index.php">Cancel</a></button>

        </form>

    </section>

</body>

</html>