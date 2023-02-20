<?php

error_reporting(0);

include_once("connection.php");

$connection = connection();

if (isset($_POST['submit'])) {
    $company = $_POST['company'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];
    $status = $_POST['status'];
    $sql = "INSERT INTO jobs_list(company, position, salary, status) VALUES (?, ?, ?, ?)";
    $job = $connection->prepare($sql);
    $job->execute([$company, $position, $salary, $status]);
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

        <h2>Add Job Opening</h2>

        <form method="post">
            <label>Company</label>
            <input type="text" name="company">

            <label>Position</label>
            <input type="text" name="position">

            <label>Salary</label>
            <input type="number" name="salary">

            <label>Status</label>
            <select name="status">
                <option value="" selected="selected" hidden="hidden">Choose one</option>
                <option>Applied</option>
                <option>HR Interview</option>
                <option>Tech Interview</option>
                <option>Job Offer</option>
            </select>

            <button type="submit" name="submit" value="Submit">Add</button>
            <button><a href="index.php">Cancel</a></button>
        </form>

    </section>

</body>

</html>