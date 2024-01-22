<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

$servername = "localhost";
$dbname = "examfedulov";
$username = "root";
$password = "";


if(isset($_POST["api_key"]) && isset($_POST["light_value"]) && isset($_POST["reading_time"])) {
    $api_key_value = "tPmAT5Ab3j7F9";

    $api_key = $_POST["api_key"];
    $light_value = $_POST["light_value"];
    $reading_time = $_POST["reading_time"];


    if ($api_key == $api_key_value) {

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }


        $sql = $conn->prepare("INSERT INTO light_level (light_value, reading_time) VALUES (?, ?)");
        $sql->bind_param("ss", $light_value, $reading_time);


        if ($sql->execute()) {
            echo "Data received and saved successfully";
        } else {
            echo "Error: " . $sql->error;
        }


        $sql->close();
        $conn->close();
    } else {
        echo "Wrong API Key provided.";
    }
} else {
    echo "Incomplete data received.";
}
?>
