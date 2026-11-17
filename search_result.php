<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
    <style>
        table { border-collapse: collapse; width: 60%; margin: 20px auto; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        p { text-align: center; font-size: 18px; }
    </style>
</head>
<body>

<h2 style="text-align: center;">Search Results</h2>

<?php
// Include database connection settings
require_once("settings.php");

// Connect to MySQL database
$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    echo "<p>Database connection failure: " . mysqli_connect_error() . "</p>";
} else {
    // Check if the 'model' parameter exists in the URL
    if (isset($_GET['model'])) {
        // Sanitise input to protect against SQL injection
        $model = mysqli_real_escape_string($conn, $_GET['model']);
        
        // SQL query to search for the model (using LIKE for partial matches)
        $sql = "SELECT car_id, make, model, price, yom FROM cars WHERE model LIKE '%$model%'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            echo "<table border='1' cellpadding='5'>";
            echo "<tr><th>ID</th><th>Make</th><th>Model</th><th>Price</th><th>Year</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['car_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['make']) . "</td>";
                echo "<td>" . htmlspecialchars($row['model']) . "</td>";
                echo "<td>$" . number_format($row['price'], 2) . "</td>";
                echo "<td>" . htmlspecialchars($row['yom']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            mysqli_free_result($result);
        } else {
            echo "<p>🚫 No matching cars found.</p>";
        }
    } else {
        echo "<p>Please enter a model to search.</p>";
    }

    mysqli_close($conn);
}
?>

<div style="text-align: center; margin-top: 20px;">
    <a href="search_form.php">Back to Search</a>
</div>

</body>
</html>