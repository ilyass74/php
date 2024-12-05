<?php
include("connection.php");
$connection = new Connection();
include("client.php");
$connection->selectDatabase("poog4");

$clients = [];

// Check if the form was submitted to filter by city
if (isset($_POST['submitB'])) {
    $clients = Client::selectClientsByCity('clients', $connection->conn, $_POST['cities']);
} else {
    // Get all clients if no city is selected
    $clients = Client::selectAllClients('clients', $connection->conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container my-5">
    <h2>List of users from database</h2>
    <a class="btn btn-primary" href="create.php" role="button">Signup</a>

    <br><br>
    <form method="post">
        <div class="input-group">
            <span class="input-group-btn">
                <button class="btn btn-success" type="submit" name="submitB">Search</button>
            </span>
            <div class="row mb-3">
                <label class="col-form-label col-sm-1" for="cities">Cities:</label>
                <div class="col-sm-6">
                    <select name="cities" class="form-select">
                        <option selected>Select your city</option>
                        <?php
                        $cities = City::selectAllCities('Cities', $connection->conn);
                        foreach ($cities as $city) {
                            echo "<option value='$city[id]'>$city[cityName]</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </form>

    <table class="table">
        <thead>
            <
