<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Document</title>
</head>
<body class="max-viewport yellow-fill background">
    <h1>Salaah times</h1>
    <main>
    <?php
    // try {
    //     // Connect to the PostgreSQL database using PDO
    //     $pdo = new PDO('pgsql:host=192.168.1.205;port=5433;dbname=postgres', 'postgres', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    //     // $connection = pg_connect("host=192.168.1.205 db_name=postgres user=postgres");
    //     // Define the SQL query to fetch records
    //     $sql = 'SELECT * FROM jamaat_times';

    //     // Execute the query
    //     $stmt = $pdo->query($sql);

    //     // Fetch the records
    //     $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //     // Display the records
    // Display the table headers
    //     $headers = array_keys($records[0]);
    //     echo '<table border="1">';
    //     echo '<tr>';
    //     foreach ($headers as $header) {
    //         echo '<th>' . $header . '</th>';
    //     }
    //     echo '</tr>';
    //     foreach ($records as $record) {
    //         echo 'Record: ' . implode(', ', $record) . "<br>";
    //     }
    // } catch (PDOException $e) {
    //     echo "Error fetching records: " . $e->getMessage();
    // }
    ?>
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
        // $headers = pg_field_name($query_response, 0);
        $numFields = pg_num_fields($query_response);
        $numRows = pg_num_rows($query_response);
        echo '<table>';
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
    <?php
    // // Display the table headers
    // // $headers = pg_field_name($query_response, 0);
    // // $numFields = pg_num_fields($query_response);
    // echo '<br>';
    // echo '<table border="1">';
    // echo '<tr>';
    // for ($i = 0; $i < $numFields; $i++) {
    //     echo '<th>' . pg_field_name($query_response, $i) . '</th>';
    // }
    // echo '</tr>';
    // echo '<br>';
    ?>
    </main>
</body>
</html>