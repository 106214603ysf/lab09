<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Car Model</title>
</head>
<body>

    <h2 style="text-align: center;">Search for a Car Model</h2>

    <!-- Using GET method to send the search term to search_result.php -->
    <form action="search_result.php" method="GET" style="text-align: center;">
        <label for="model">Car Model:</label>
        <input type="text" id="model" name="model" required>
        <button type="submit">Search</button>
    </form>

</body>
</html>