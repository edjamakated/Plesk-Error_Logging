<?php

// Get the error details from the server variables
$error_code = $_SERVER["REDIRECT_STATUS"];
$error_uri = $_SERVER["REQUEST_URI"];
$error_method = $_SERVER["REQUEST_METHOD"];
$error_time = date("Y-m-d H:i:s");
$error_message = "Unknown error";

// Determine the error message based on the error code
switch ($error_code) {
    case 400:
        $error_message = "Bad Request";
        break;
    case 401:
        $error_message = "Unauthorized";
        break;
    case 403:
        $error_message = "Forbidden";
        break;
    case 404:
        $error_message = "Not Found";
        break;
    case 500:
        $error_message = "Internal Server Error";
        break;
}

// Open the SQLite database file
$db = new SQLite3('/path/to/database.sqlite');

// Insert the error details into the database
$stmt = $db->prepare('INSERT INTO errors (error_code, error_uri, error_method, error_time, error_message) VALUES (:code, :uri, :method, :time, :message)');
$stmt->bindValue(':code', $error_code, SQLITE3_INTEGER);
$stmt->bindValue(':uri', $error_uri, SQLITE3_TEXT);
$stmt->bindValue(':method', $error_method, SQLITE3_TEXT);
$stmt->bindValue(':time', $error_time, SQLITE3_TEXT);
$stmt->bindValue(':message', $error_message, SQLITE3_TEXT);
$result = $stmt->execute();

// Close the database connection
$db->close();

// Display the error message to the user
echo "<h1>{$error_code} - {$error_message}</h1>";
echo "<p>The server encountered an error while processing your request. Please try again later.</p>";

?>
In this example, the code opens a connection to a SQLite database file and inserts the error details into a table called "errors". The table should have columns named "error_code", "error_uri", "error_method", "error_time", and "error_message" to match the values being inserted. You should replace "/path/to/database.sqlite" with the actual path to your SQLite database file.

After inserting the error details into the database, the code displays a generic error message to the user. You can customize this message as needed.
