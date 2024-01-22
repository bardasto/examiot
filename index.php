<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .no-data {
            text-align: center;
            color: #999;
            margin-top: 20px;
        }
    </style>
    <title>Your Page Title</title>
</head>
<body>
    <h1>Light Level Data</h1>

    <?php
    $servername = "localhost";
    $dbname = "examfedulov";
    $username = "root";
    $password = "";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "SELECT id, light_value, reading_time FROM light_level ORDER BY id DESC";

    echo '<table>
            <tr> 
                <th>ID</th> 
                <th>Light Value</th> 
                <th>Timestamp</th> 
            </tr>';
    
    if ($result = $conn->query($sql)) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $row_id = $row["id"];
                $row_light_value = $row["light_value"];
                $row_timestamp = $row["reading_time"];
              
                echo '<tr> 
                        <td>' . $row_id . '</td> 
                        <td>' . $row_light_value . '</td> 
                        <td>' . $row_timestamp . '</td> 
                    </tr>';
            }
            $result->free();
        } else {
            echo '<tr><td colspan="3" class="no-data">No data available</td></tr>';
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    ?> 
    </table>
</body>
</html>
