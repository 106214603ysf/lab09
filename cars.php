<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Car Inventory - Lab 09</title>
    <style>
        table { border-collapse: collapse; width: 60%; margin: 20px auto; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

<h2 style="text-align: center;">Used Car Dealership Inventory</h2>

<table>
    <tr>
        <th>Car ID</th>
        <th>Make</th>
        <th>Model</th>
        <th>Price ($)</th>
        <th>Year of Manufacture (YOM)</th>
    </tr>

    <?php
    // Include database connection settings
    require_once("settings.php");

    // Connect to MySQL database
    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

    // Check connection
    if (!$conn) {
        echo "<tr><td colspan='5'>Database connection failure: " . mysqli_connect_error() . "</td></tr>";
    } else {
        // Query to fetch all records from cars table
        $query = "SELECT * FROM cars";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            // Task 7: Read and print data from the database
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['car_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['make']) . "</td>";
                echo "<td>" . htmlspecialchars($row['model']) . "</td>";
                echo "<td>$" . number_format($row['price'], 2) . "</td>";
                echo "<td>" . htmlspecialchars($row['yom']) . "</td>";
                echo "</tr>";
            }
            // Free result set
            mysqli_free_result($result);
        } else {
            echo "<tr><td colspan='5'>There are no cars to display.</td></tr>";
        }

        // Close database connection
        mysqli_close($conn);
    }
    ?>

</table>

</body>
</html>