<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>PHP example project</title>
</head>
<body class="max-viewport yellow-fill background">
    <h1>Salaah times</h1>
    <main>
        <h2>February</h2>
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
            $headers = [];
            $numFields = pg_num_fields($query_response);
            $numRows = pg_num_rows($query_response);
            echo '<table>';
            echo '<tr>';
            for ($i = 0; $i < $numFields; $i++) {
                $headers[] = pg_field_name($query_response, $i);
                echo '<th>' . $headers[$i] . '</th>';
            }
            echo '</tr>';
            for ($i = 0; $i < $numRows; $i++){
                $row = pg_fetch_assoc($query_response, $i);
                echo "<tr>" . "<td>" . $row['date'] . "</td><td>" . $row['day'] . "</td><td>" . $row['fajr'] . "</td><td>" . $row['zuhr'] . "</td><td>" . $row['asr'] . "</td><td>" . $row['maghrib'] . "</td><td>" . $row['isha'] . "</td></tr>";
                // echo "<tr>";
                // for ($j = 0; $j < $numFields; $j++) {
                //     echo "<td>" . $row[$headers[$j]] . "</td>";
                // }
                // echo "</tr>";
            }

        } catch (Exception $e) {
            echo "Error connecting to database: " . $e->getMessage();
            exit;
        }
        ?>
    </main>
</body>
</html>