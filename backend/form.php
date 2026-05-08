<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "test";

// Step 1: Connect to MySQL (without DB first)
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}
echo "✅ Connected to MySQL server<br>";

// Step 2: Create Database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS $database";
if ($conn->query($sql) === TRUE) {
    echo "✅ Database ready<br>";
} else {
    die("❌ Error creating database: " . $conn->error);
}

// Step 3: Select Database
$conn->select_db($database);

// Step 4: Create Table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    email VARCHAR(50)
)";

if ($conn->query($sql) === TRUE) {
    echo "✅ Table 'users' created successfully<br>";
} else {
    die("❌ Error creating table: " . $conn->error);
}

// Step 5: Insert sample data
$sql = "INSERT INTO users (name, email) VALUES ('Kaushik', 'kaushik@email.com')";

if ($conn->query($sql) === TRUE) {
    echo "✅ Data inserted<br>";
} else {
    echo "⚠️ Data not inserted (maybe duplicate)<br>";
}

// Step 6: Fetch and display data
$result = $conn->query("SELECT * FROM users");

echo "<h3>📋 Users Table:</h3>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . 
             " | Name: " . $row["name"] . 
             " | Email: " . $row["email"] . "<br>";
    }
} else {
    echo "No records found";
}

// Close connection
$conn->close();
?>