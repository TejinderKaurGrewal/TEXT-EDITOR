<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "html_pages";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the page ID from the URL
$page_id = $_GET['id'];

// Retrieve the HTML content from the database
$sql = "SELECT html_content FROM webpages WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $page_id);
$stmt->execute();
$stmt->bind_result($html_content);
$stmt->fetch();
$stmt->close();
$conn->close();

// Display the HTML content
echo $html_content;
?>
