<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "html_pages";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the HTML content from the form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $html_content = $_POST['editor_content'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO webpages (html_content) VALUES (?)");
    $stmt->bind_param("s", $html_content);

    // Execute the query
    if ($stmt->execute()) {
        $page_id = $stmt->insert_id;
        echo "<script>alert('Webpage saved successfully!'); window.location.href = 'view_page.php?id=$page_id';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
}
$conn->close();
?>
