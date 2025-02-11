<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="max-viewport yellow-fill background">
    </div>
    <?php
    // Connect to the PostgreSQL database
    try {
        $conn = pg_connect("host=192.168.1.205 port=5433 dbname=postgres user=postgres");
        if (!$conn) {
            throw new Exception(pg_last_error());
        }
        // Execute the query
        $query_response = pg_query($conn, "SELECT * FROM jamaat_times");
        
        // Close the connection
        pg_close($conn);

        // Display the table
        $numFields = pg_num_fields($query_response);
        $numRows = pg_num_rows($query_response);
        echo '<table border="1">';
        echo '<tr>';
        for ($i = 0; $i < $numFields; $i++) {
            echo '<th>' . pg_field_name($query_response, $i) . '</th>';
        }
        echo '</tr>';
        for ($i = 0; $i < $numRows; $i++){
            $row = pg_fetch_assoc($query_response, $i);
            echo "<tr>" . "<td>" . $row['date'] . "</td><td>" . $row['day'] . "</td><td>" . $row['fajr'] . "</td><td>" . $row['zuhr'] . "</td><td>" . $row['asr'] . "</td><td>" . $row['maghrib'] . "</td><td>" . $row['isha'] . "</td></tr>";
        }

    } catch (Exception $e) {
        echo "Error connecting to database: " . $e->getMessage();
        exit;
    }
    ?>
</body>
</html>