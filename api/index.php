<?php
// Database connection
$host = 'localhost';
$dbname = 'roster_db';
$user = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $day = $_POST['day'];
    $time = $_POST['time'];
    $subject = $_POST['subject'];
    $room = $_POST['room'];
    $extra = $_POST['extra'];

    $stmt = $conn->prepare("INSERT INTO schedule (day, time, subject, room, extra) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$day, $time, $subject, $room, $extra]);

    echo "Schedule entry added successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Schedule Entry</title>
    <style>
        /* General Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
    color: #333;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

/* Form Container */
form {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    max-width: 400px;
    width: 100%;
}

h1 {
    text-align: center;
    color: #4CAF50;
    font-size: 24px;
    margin-bottom: 20px;
}

/* Form Fields */
label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    color: #555;
}

input, select, button {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
}

/* Submit Button */
button {
    background-color: #4CAF50;
    color: white;
    border: none;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #45a049;
}

/* Responsive Design */
@media (max-width: 400px) {
    form {
        padding: 15px;
    }

    h1 {
        font-size: 20px;
    }
}
</style>
</head>
<body>
    <h1>Add Schedule Entry</h1>
    <form method="POST" action="">
        <label for="day">Day:</label>
        <select id="day" name="day" required>
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
        </select><br><br>
        
        <label for="time">Time:</label>
        <input type="time" id="time" name="time" required><br><br>

        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required><br><br>

        <label for="room">Room:</label>
        <input type="text" id="room" name="room" required><br><br>

        <label for="extra">Extra Info:</label>
        <input type="text" id="extra" name="extra"><br><br>

        <button type="submit">Add Entry</button>
    </form>
</body>
</html>
